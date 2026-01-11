<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Orar - Fitness Studio</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="./../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./../assets/css/font-awesome.css">
    <link rel="stylesheet" href="./../assets/css/templatemo-training-studio.css">
    
    <!-- Custom CSS Files -->
    <link rel="stylesheet" type="text/css" href="./../public/css/base.css">
    <link rel="stylesheet" type="text/css" href="./../public/css/components.css">
</head>

<body>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>" class="logo">Fitness<em> Studio</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>">Home</a></li>
                            <li><a href="#" class="active">Orar</a></li>
                            <li class="main-button">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>logout">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
                                <?php else: ?>
                                    <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>">Log In</a>
                                <?php endif; ?>
                            </li>
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
    <!-- ***** Header Area End ***** -->

    <!-- ***** Orar Section Start ***** -->
    <section class="section" id="orar" style="margin-top: 120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Program de <em>Deschidere</em></h2>
                        <img src="./../assets/images/line-dec.png" alt="waves">
                        <p>Verifica programul de deschidere a salii noastre de antrenamente.</p>
                    </div>
                </div>
            </div>

            <!-- Luni - Vineri Schedule -->
            <div class="row" style="margin-bottom: 40px;">
                <div class="col-lg-8 offset-lg-2">
                    <h3 style="text-align: center; color: #ed563b; margin-bottom: 30px; font-size: 28px;">
                        <strong>Luni - Vineri</strong>
                    </h3>
                    
                    <div style="background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); border-radius: 15px; padding: 40px; border: 2px solid #ed563b; box-shadow: 0 5px 15px rgba(237, 86, 59, 0.2);">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 3px solid #ed563b;">
                                    <th style="padding: 15px; text-align: left; color: #ed563b; font-size: 18px; font-weight: bold;">Ziua</th>
                                    <th style="padding: 15px; text-align: center; color: #ed563b; font-size: 18px; font-weight: bold;">Programul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #444;">
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Luni</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>06:00 - 22:00</strong></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #444;">
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Marti</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>06:00 - 22:00</strong></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #444;">
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Miercuri</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>06:00 - 22:00</strong></td>
                                </tr>
                                <tr style="border-bottom: 1px solid #444;">
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Joi</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>06:00 - 22:00</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Vineri</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>06:00 - 22:00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sambata - Duminica Schedule -->
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h3 style="text-align: center; color: #ed563b; margin-bottom: 30px; font-size: 28px;">
                        <strong>Weekend</strong>
                    </h3>
                    
                    <div style="background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); border-radius: 15px; padding: 40px; border: 2px solid #ed563b; box-shadow: 0 5px 15px rgba(237, 86, 59, 0.2);">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 3px solid #ed563b;">
                                    <th style="padding: 15px; text-align: left; color: #ed563b; font-size: 18px; font-weight: bold;">Ziua</th>
                                    <th style="padding: 15px; text-align: center; color: #ed563b; font-size: 18px; font-weight: bold;">Programul</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #444;">
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Sambata</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>08:00 - 20:00</strong></td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; color: #fff; font-size: 16px;">Duminica</td>
                                    <td style="padding: 15px; text-align: center; color: #fff; font-size: 16px;"><strong>08:00 - 20:00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="row" style="margin-top: 60px;">
                <div class="col-lg-8 offset-lg-2">
                    <div style="background: linear-gradient(145deg, #ed563b 0%, #d93f1a 100%); border-radius: 15px; padding: 30px; text-align: center;">
                        <h4 style="color: #fff; font-size: 20px; margin-bottom: 15px;">
                            <strong>SALA DESCHISA PENTRU TOTI!</strong>
                        </h4>
                        <p style="color: #fff; font-size: 16px; margin-bottom: 0;">
                            Studentii pot accesa sala de antrenamente in orice moment, fara restrictii de timp. 
                            Asigura-te ca respecti regulamentul salii si intorci echipamentul dupa utilizare.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ***** Orar Section End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2025 M.N.C. SoftwareStudio - Designed with <a rel="nofollow" href="https://templatemo.com" class="tm-text-link" target="_parent">TemplateMo</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="./../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="./../assets/js/popper.js"></script>
    <script src="./../assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="./../assets/js/scrollreveal.min.js"></script>
    <script src="./../assets/js/waypoints.min.js"></script>
    <script src="./../assets/js/jquery.counterup.min.js"></script>
    <script src="./../assets/js/imgfix.min.js"></script>
    <script src="./../assets/js/mixitup.js"></script>
    <script src="./../assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="./../assets/js/custom.js"></script>

</body>

</html>
