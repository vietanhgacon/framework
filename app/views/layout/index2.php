<?php

use framework\core\View;
$view = new View();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sport</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Custom CSS-->
        <?= $view->registerCss() ?>
        <!--javascript-->
        <?= $view->registerJs() ?>

    </head>
    <body>

        <section id="content">
            <div class="main">
                <header>
                    <div class="header-ad">
                        <img src="web/images/header-ad.png"/>
                    </div>
                    <div class="header-top main-content">
                        <div class="header-logo">
                            <img src="web/images/header-logo.png"/>
                        </div>
                        <div class="header-search">
                            <input type="text" name="txtSearch" class="header-search-box" placeholder="Search product..."/>
                            <input type="button" name="btnSearch" class="header-search-button"/>
                        </div>
                        <div class="header-minimenu">
                            <h3>
                                <a href="#">Login</a> / <a href="#">Register</a>
                            </h3>
                            <div class="cart-cover">
                                <a href="#" class="minimenu-cart">
                                    <i class="icon-cart"></i>
                                    <span class="cart-number">0</span>
                                </a>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="main-menu">
                            <ul class="menu-cover">
                                <li><a href="#">NRL</a></li>
                                <li>
                                    <a href="#">AFL</a>
                                    <ul class="menu-submenu">
                                        <li><a href="#">RUGBY UNION</a></li>
                                        <li><a href="#">A-LEAGUE</a></li>
                                        <li><a href="#">FOOTBALL</a></li>
                                        <li><a href="#">SAVVY SALES</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">RUGBY UNION</a></li>
                                <li><a href="#">A-LEAGUE</a></li>
                                <li><a href="#">FOOTBALL</a></li>
                                <li><a href="#">SAVVY SALES</a></li>
                            </ul>
                            <div class="menu-info">
                                <div class="menu-info-icon">
                                    <a href="#"><img src="web/images/icon-email.png"/></a>
                                    <a href="#"><img src="web/images/icon_call.png"/></a>
                                </div>
                                <div class="menu-info-detail">
                                    <b>1300 275 728</b><br/>
                                    <span>8am - 4pm   Mon - Fri</span>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </header>
                <?= $content ?>
            </div>
            <footer>
                <div class="footer-banner">
                    <div class="footer-join">
                        <h3 class="join-title">JOIN OUR ELITE CLUB TO RECEIVE LATEST UPDATES & GREAT OFFERS</h3>
                        <div>
                            <input type="text" class="input-text-join" name="txtJoinusEmail" placeholder="Enter your email address"/>
                            <input type="button" class="input-button-join" name="btnSubmit" value="Join now" />
                        </div>
                    </div>
                </div>
                <div class="main footer">

                    <div class="footer-description">
                        <img src="web/images/footer_logo.png"/>
                        <p>
                            Unlike most sellers, Savvy Supporter grew out of the general love of Australian Sport. We have both been passionate Rugby League fans since childhood, and the growth of Savvy Supporter over the past couple of years has enabled them to spend their time focusing on what they love most
                        </p>
                        <div class="footer-needhelp">
                            <div class="needhelp-title">
                                <img src="web/images/icon_call.png"/>
                                <span>Need Help?</span>
                            </div>
                            <div class="clear"></div>
                            <div class="needhelp-phone"><span>1300 275 728</span></div>
                        </div>
                    </div>
                    <div class="footer-menu">
                        <div class="menu-column">
                            <h3 class="column-title">INFORMATION</h3>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About Savvy</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="menu-column">
                            <h3 class="column-title">Product</h3>
                            <ul>
                                <li><a href="#">NRL</a></li>
                                <li><a href="#">AFL</a></li>
                                <li><a href="#">Rugby Union</a></li>
                                <li><a href="#">A-League</a></li>
                                <li><a href="#">Football</a></li>
                                <li><a href="#">Savvy Sales</a></li>
                            </ul>
                        </div>
                        <div class="menu-column">
                            <h3 class="column-title">Support centre</h3>
                            <ul>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Delevery & Returns</a></li>
                                <li><a href="#">Exchange Plicy</a></li>
                                <li><a href="#">Warranty</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <p class="footer-copyright">© 2016, Savvy Supporter - All rights reserved.</p>
            </footer>
        </section>

    </body>
</html>

