
/*
Exemples de transactions SQL pour ajouter un objet et faire un échange.

1. AJOUTER UN OBJET :
   - Insérer dans 'objets'
   - Insérer dans 'photos_objet' (une ou plusieurs photos)
   - Insérer dans 'historique_proprietaire_objet' (acquisition initiale)

   Exemple :
   INSERT INTO objets (proprietaire_id, categorie_id, etat_id, statut_id, titre, description, prix_estime) 
   VALUES (1, 1, 1, 1, 'Nouvel objet', 'Description', 100.00);

   INSERT INTO photos_objet (objet_id, chemin, ordre, est_principale) 
   VALUES (LAST_INSERT_ID(), 'nouvelobjet.jpg', 1, true);

   INSERT INTO historique_proprietaire_objet (objet_id, utilisateur_id, date_acquisition) 
   VALUES (LAST_INSERT_ID(), 1, NOW());

2. FAIRE UN ÉCHANGE :
   - Insérer dans 'echanges' (statut initial 'en_attente' = 1)
   - Insérer dans 'echange_objets' (objets offerts et demandés)
   - Si accepté : UPDATE 'echanges' SET statut_id = 2, date_reponse = NOW()
   - Si accepté : UPDATE 'objets' SET proprietaire_id pour les objets échangés
   - Si accepté : Insérer dans 'historique_proprietaire_objet' pour les transferts
   - Si refusé : UPDATE 'echanges' SET statut_id = 3, date_reponse = NOW()

   Exemple d'échange proposé :
   INSERT INTO echanges (demandeur_id, receveur_id, statut_id) VALUES (1, 2, 1);

   INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (LAST_INSERT_ID(), 1, 'OFFERT');
   INSERT INTO echange_objets (echange_id, objet_id, direction) VALUES (LAST_INSERT_ID(), 3, 'DEMANDE');

   Pour accepter :
   UPDATE echanges SET statut_id = 2, date_reponse = NOW() WHERE id = [echange_id];
   UPDATE objets SET proprietaire_id = 2 WHERE id = 1; -- Objet offert à receveur
   UPDATE objets SET proprietaire_id = 1 WHERE id = 3; -- Objet demandé à demandeur
   INSERT INTO historique_proprietaire_objet (objet_id, utilisateur_id, echange_id, date_acquisition) VALUES (1, 2, [echange_id], NOW());
   INSERT INTO historique_proprietaire_objet (objet_id, utilisateur_id, echange_id, date_acquisition) VALUES (3, 1, [echange_id], NOW());

   Pour refuser :
   UPDATE echanges SET statut_id = 3, date_reponse = NOW() WHERE id = [echange_id];
*/