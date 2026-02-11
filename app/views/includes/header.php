<?php
function getCateg() {
    return [
        ['nom_categorie' => 'Men'],
        ['nom_categorie' => 'Women'],
        ['nom_categorie' => 'Kids'],
        ['nom_categorie' => 'Accessories']
    ];
}
?>
<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <img src="<?php echo $baseurl ?>/assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <!-- <li class="scroll-to-section"><a href="#men">Men's</a></li>
                            <li class="scroll-to-section"><a href="#women">Women's</a></li>
                            <li class="scroll-to-section"><a href="#kids">Kid's</a></li> -->
                            <!-- <?php 
                                $categ = getCateg();
                                foreach($categ as $c) { ?>
                                    <li class="scroll-to-section"><a href="#<?= $c['nom_categorie']?>"><?= $c['nom_categorie']?>'s</a></li>
                                <?php }
                            ?> -->
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="about.php">About Us</a></li>
                                    <li><a href="products.php">Products</a></li>
                                    <li><a href="single-product.php">Single Product</a></li>
                                    <li><a href="contact.php">Contact Us</a></li>
                                </ul>
                            </li>
                            <!-- <li class="submenu">
                                <a href="javascript:;">Features</a>
                                <ul>
                                    <li><a href="#">Features Page 1</a></li>
                                    <li><a href="#">Features Page 2</a></li>
                                    <li><a href="#">Features Page 3</a></li>
                                    <li><a rel="nofollow" href="https://templatemo.com/page/4" target="_blank">Template Page 4</a></li>
                                </ul>
                            </li> -->
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
                            <li class="scroll-to-section"><a href="list-produit.php">List Products</a></li>
                            <li class="scroll-to-section"><a href="upload-product.php">Upload Product</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Login</a>
                                <ul>
                                    <li><a href="<?php echo $baseurl; ?>/login">User Login</a></li>
                                    <li><a href="<?php echo $baseurl; ?>/login-admin">Admin Login</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="<?php echo $baseurl; ?>/inscription">Inscrivez-vous</a></li>

                            
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
