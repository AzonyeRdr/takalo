
<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="/index" class="logo">
                            <img src="<?php echo $baseurl ?>/assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/index" class="active">Accueil</a></li>
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/objets">Objets</a></li>
                            <?php if (!isset($_SESSION['session_type'])): ?>
                            <!-- Show login/signup when NOT logged in -->
                            <li class="submenu">
                                <a href="javascript:;">Se connecter</a>
                                <ul>
                                    <li><a href="<?php echo $baseurl; ?>/login">Connexion Utilisateur</a></li>
                                    <li><a href="<?php echo $baseurl; ?>/login-admin">Connexion Admin</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/inscription">S'inscrire</a></li>
                            <?php else: ?>
                            <!-- Show user menu when logged in -->
                            <?php if ($_SESSION['session_type'] === 'user'): ?>
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/mes-objets">Mes Objets</a></li>
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/echanges">Échanges</a></li>
                            <?php endif; ?>
                            <li class="submenu">
                                <a href="javascript:;">
                                    <i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['user']->getNom()); ?>
                                </a>
                                <ul>
                                    <?php if ($_SESSION['session_type'] === 'admin'): ?>
                                        <li><a href="<?php echo $baseurl; ?>/backoffice">
                                            <i class="fa fa-dashboard"></i> Administration
                                        </a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo $baseurl; ?>/logout">
                                        <i class="fa fa-sign-out"></i> Déconnexion
                                    </a></li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
