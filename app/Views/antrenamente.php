<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Antrenamente - Fitness Studio</title>

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
                            <li><a href="#" class="active">Antrenamente</a></li>
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

    <!-- ***** Antrenamente Section Start ***** -->
    <section class="section" id="antrenamente" style="margin-top: 120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Programe de <em>Antrenament</em></h2>
                        <img src="./../assets/images/line-dec.png" alt="waves">
                        <p>Descopera programe de antrenament personalizate pentru toate nivelurile de pregatire.</p>
                    </div>
                </div>
            </div>
            
            <?php
            // Display success/error messages
            if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['success_message']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_SESSION['error_message']); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            
            <?php 
            // Show add button for admin
            if (isset($_SESSION['user_id']) && $isAdmin): 
            ?>
            <div class="row">
                <div class="col-lg-12 text-center" style="margin-bottom: 30px;">
                    <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>antrenamente/create" 
                       style="display: inline-block; background-color: #ed563b; color: #fff; padding: 15px 40px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px;">
                        Adauga Antrenament Nou
                    </a>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($workouts)): ?>
            <div class="row">
                <?php foreach ($workouts as $workout): ?>
                <div class="col-lg-4 col-md-6" style="margin-bottom: 30px;">
                    <div class="trainer-item" style="background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); border-radius: 15px; padding: 25px; border: 2px solid #ed563b; box-shadow: 0 5px 15px rgba(237, 86, 59, 0.2);">
                        <div class="image-thumb">
                            <h4 style="color: #ed563b; margin-bottom: 15px; font-size: 20px; font-weight: bold; text-transform: capitalize;">
                                <?php echo htmlspecialchars($workout['workout_type_name']); ?>
                            </h4>
                        </div>
                        <div class="down-content">
                            <?php if (!empty($workout['description'])): ?>
                            <p style="color: #fff; margin-bottom: 15px; font-style: italic;">
                                <?php echo htmlspecialchars($workout['description']); ?>
                            </p>
                            <?php endif; ?>
                            <p style="color: #fff; margin-bottom: 10px;">
                                <strong style="color: #ed563b;">Data:</strong> <?php echo date('d.m.Y', strtotime($workout['date'])); ?>
                            </p>
                            <p style="color: #fff; margin-bottom: 10px;">
                                <strong style="color: #ed563b;">Durata:</strong> <?php echo htmlspecialchars($workout['duration_min']); ?> minute
                            </p>
                            <p style="color: #fff; margin-bottom: 10px;">
                                <strong style="color: #ed563b;">Intensitate:</strong> <?php echo htmlspecialchars($workout['intensity']); ?>/10
                            </p>
                            <p style="color: #fff; margin-bottom: 10px;">
                                <strong style="color: #ed563b;">Calorii:</strong> <?php echo htmlspecialchars($workout['calories_burned']); ?> kcal
                            </p>
                            <?php if (!empty($workout['notes'])): ?>
                            <p style="color: #fff; margin-bottom: 10px;">
                                <strong style="color: #ed563b;">Notite:</strong> <?php echo htmlspecialchars($workout['notes']); ?>
                            </p>
                            <?php endif; ?>
                            <p style="color: #999; font-size: 12px; margin-bottom: 15px;">
                                <em>Adaugat de: <?php echo htmlspecialchars($workout['user_name']); ?></em>
                            </p>
                            
                            <?php 
                            // Show edit/delete buttons if user is the creator
                            if (isset($_SESSION['user_id']) && $workout['user_id'] == $_SESSION['user_id']): 
                            ?>
                            <div style="margin-top: 15px; text-align: center;">
                                <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>antrenamente/edit/<?php echo $workout['workout_id']; ?>" 
                                   class="btn btn-warning" style="margin-right: 10px; padding: 8px 20px; font-size: 14px;">
                                    Editeaza
                                </a>
                                <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>antrenamente/delete/<?php echo $workout['workout_id']; ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Esti sigur ca vrei sa stergi acest antrenament?');"
                                   style="padding: 8px 20px; font-size: 14px;">
                                    Sterge
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content text-center" style="padding: 60px 20px; background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); border-radius: 15px; border: 2px solid #ed563b;">
                        <h3 style="color: #fff;">Nu exista antrenamente disponibile momentan</h3>
                        <p style="color: #999; margin-top: 20px;">
                            <?php if ($isAdmin): ?>
                                Adauga primul antrenament!
                            <?php else: ?>
                                Revino curand pentru antrenamente noi!
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- ***** Antrenamente Section End ***** -->

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
