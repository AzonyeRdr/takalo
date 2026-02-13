<?php
namespace controllers;

use Flight;
use models\Echange;
use models\EchangeObjet;
use models\Objet;
use models\User;
use models\StatutEchange;

class EchangeController
{
    private $db;

    public function __construct()
    {
        $this->db = Flight::db();
    }

    private function getUser()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        return $_SESSION['user'] ?? null;
    }

    // Page: mes échanges
    public function mesEchanges()
    {
        $user = $this->getUser();
        if (!$user) { Flight::redirect('/login'); return; }

        $pdo = $this->db;
        $echanges = Echange::getByUser($pdo, $user->getId());

        Flight::render('echanges/list', [
            'echanges' => $echanges,
            'userId' => $user->getId()
        ]);
    }

    // API: proposer un échange
    public function proposerEchange()
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $req = Flight::request();

        $objetOffertId = $req->data->objet_offert_id ?? null;
        $objetDemandeId = $req->data->objet_demande_id ?? null;

        if (!$objetOffertId || !$objetDemandeId) {
            Flight::json(['success' => false, 'message' => 'Veuillez sélectionner les objets'], 400);
            return;
        }

        // Vérifier que l'objet offert appartient au demandeur
        $objetOffert = new Objet();
        $objetOffert->setId($objetOffertId);
        $objetOffert->findById($pdo);

        if (!$objetOffert->getTitre() || $objetOffert->getProprietaire()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Cet objet ne vous appartient pas'], 403);
            return;
        }

        // Vérifier que l'objet demandé existe et appartient à quelqu'un d'autre
        $objetDemande = new Objet();
        $objetDemande->setId($objetDemandeId);
        $objetDemande->findById($pdo);

        if (!$objetDemande->getTitre() || $objetDemande->getProprietaire()->getId() === $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Objet demandé invalide'], 400);
            return;
        }

        $pdo->beginTransaction();
        try {
            // Créer l'échange
            $echange = new Echange();
            $demandeur = new User();
            $demandeur->setId($user->getId());
            $echange->setDemandeur($demandeur);

            $receveur = new User();
            $receveur->setId($objetDemande->getProprietaire()->getId());
            $echange->setReceveur($receveur);

            $statut = new StatutEchange();
            $statut->setId(1); // EN_ATTENTE
            $echange->setStatut($statut);

            $echange->create($pdo);

            // Objets de l'échange
            $eoOffert = new EchangeObjet();
            $eoOffert->setEchangeId($echange->getId());
            $eoOffert->setObjetId($objetOffertId);
            $eoOffert->setDirection('OFFERT');
            $eoOffert->create($pdo);

            $eoDemande = new EchangeObjet();
            $eoDemande->setEchangeId($echange->getId());
            $eoDemande->setObjetId($objetDemandeId);
            $eoDemande->setDirection('DEMANDE');
            $eoDemande->create($pdo);

            // Réserver les objets
            $stReserve = $pdo->prepare('UPDATE objets SET statut_id = 2 WHERE id = :id1');
            $stReserve->execute(['id1' => $objetOffertId]);
            $stReserve2 = $pdo->prepare('UPDATE objets SET statut_id = 2 WHERE id = :id2');
            $stReserve2->execute(['id2' => $objetDemandeId]);

            $pdo->commit();
            Flight::json(['success' => true, 'message' => 'Proposition d\'échange envoyée']);
        } catch (\Exception $e) {
            $pdo->rollBack();
            Flight::json(['success' => false, 'message' => 'Erreur: ' . $e->getMessage()], 500);
        }
    }

    // API: accepter un échange
    public function accepterEchange($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $echange = new Echange();
        $echange->setId($id);
        $echange->findById($pdo);

        if (!$echange->getReceveur() || $echange->getReceveur()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return;
        }

        if ($echange->accepter($pdo)) {
            Flight::json(['success' => true, 'message' => 'Échange accepté']);
        } else {
            Flight::json(['success' => false, 'message' => 'Erreur lors de l\'acceptation'], 500);
        }
    }

    // API: refuser un échange
    public function refuserEchange($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $echange = new Echange();
        $echange->setId($id);
        $echange->findById($pdo);

        if (!$echange->getReceveur() || $echange->getReceveur()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return;
        }

        if ($echange->refuser($pdo)) {
            Flight::json(['success' => true, 'message' => 'Échange refusé']);
        } else {
            Flight::json(['success' => false, 'message' => 'Erreur lors du refus'], 500);
        }
    }

    // API: annuler un échange (par le demandeur)
    public function annulerEchange($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $echange = new Echange();
        $echange->setId($id);
        $echange->findById($pdo);

        if (!$echange->getDemandeur() || $echange->getDemandeur()->getId() !== $user->getId()) {
            Flight::json(['success' => false, 'message' => 'Non autorisé'], 403);
            return;
        }

        if ($echange->annuler($pdo)) {
            Flight::json(['success' => true, 'message' => 'Échange annulé']);
        } else {
            Flight::json(['success' => false, 'message' => 'Erreur lors de l\'annulation'], 500);
        }
    }

    // API: détail d'un échange
    public function detailEchange($id)
    {
        $user = $this->getUser();
        if (!$user) { Flight::json(['success' => false, 'message' => 'Non connecté'], 401); return; }

        $pdo = $this->db;
        $echange = new Echange();
        $echange->setId($id);
        $echange->findById($pdo);

        if (!$echange->getDemandeur()) {
            Flight::json(['success' => false, 'message' => 'Échange non trouvé'], 404);
            return;
        }

        $eo = new EchangeObjet();
        $eo->setEchangeId($id);
        $items = $eo->findByEchangeId($pdo);

        Flight::json([
            'success' => true,
            'echange' => [
                'id' => $echange->getId(),
                'demandeur' => $echange->getDemandeur()->getNom(),
                'demandeur_id' => $echange->getDemandeur()->getId(),
                'receveur' => $echange->getReceveur()->getNom(),
                'receveur_id' => $echange->getReceveur()->getId(),
                'statut' => $echange->getStatut()->getLibelle(),
                'statut_code' => $echange->getStatut()->getCode(),
                'date_demande' => $echange->getDateDemande(),
                'date_reponse' => $echange->getDateReponse()
            ],
            'objets' => $items
        ]);
    }
}
