<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Retete - Fitness Studio</title>

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
                            <li><a href="#" class="active">Retete</a></li>
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

    <!-- ***** Retete Section Start ***** -->
    <section class="section" id="retete" style="margin-top: 120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Retete <em>Sanatoase</em></h2>
                        <img src="./../assets/images/line-dec.png" alt="waves">
                        <p>Descopera retete delicioase si nutritive pentru un stil de viata sanatos.</p>
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
            // Check if user is admin
            $isAdmin = false;
            if (isset($_SESSION['user_id'])) {
                require_once __DIR__ . '/../Models/UserModel.php';
                $userModel = new UserModel();
                $isAdmin = $userModel->isAdmin($_SESSION['user_id']);
            }
            ?>

            <?php if ($isAdmin): ?>
            <div class="row mb-4">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>retete/create" class="main-button">
                        Adauga Reteta Noua
                    </a>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row">
                <?php if (!empty($recipes)): ?>
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100" style="background-color: #232d39; border: 1px solid #ed563b;">
                                <div class="card-body">
                                    <h4 class="card-title" style="color: #ed563b;"><?php echo htmlspecialchars($recipe['title']); ?></h4>
                                    <p class="card-text" style="color: #fff;">
                                        <?php 
                                        $desc = htmlspecialchars($recipe['description']);
                                        echo strlen($desc) > 150 ? substr($desc, 0, 150) . '...' : $desc;
                                        ?>
                                    </p>
                                    <div style="color: #fff; font-size: 14px; margin-top: 10px;">
                                        <p><strong>Calorii:</strong> <?php echo htmlspecialchars($recipe['total_calories']); ?> kcal</p>
                                        <p><strong>Autor:</strong> <?php echo htmlspecialchars($recipe['author_name'] ?? 'Necunoscut'); ?></p>
                                        <p><strong>Data:</strong> <?php echo date('d.m.Y', strtotime($recipe['created_at'])); ?></p>
                                    </div>
                                    
                                    <?php if (isset($_SESSION['user_id']) && $recipe['created_by'] == $_SESSION['user_id']): ?>
                                        <div class="mt-3">
                                            <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>retete/edit/<?php echo $recipe['recipe_id']; ?>" 
                                               class="btn btn-sm" style="background-color: #ed563b; color: #fff;">
                                                Editeaza
                                            </a>
                                            <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>retete/delete/<?php echo $recipe['recipe_id']; ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Esti sigur ca vrei sa stergi aceasta reteta?');">
                                                sterge
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="card-footer" style="background-color: #1a242f; border-top: 1px solid #ed563b;">
                                    <button class="btn btn-sm" style="background-color: #ed563b; color: #fff; width: 100%;" 
                                            data-toggle="modal" data-target="#recipeModal<?php echo $recipe['recipe_id']; ?>">
                                        Vezi Reteta
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal pentru fiecare reteta -->
                        <div class="modal fade" id="recipeModal<?php echo $recipe['recipe_id']; ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="background-color: #232d39; color: #fff;">
                                    <div class="modal-header" style="border-bottom: 1px solid #ed563b;">
                                        <h5 class="modal-title" style="color: #ed563b;"><?php echo htmlspecialchars($recipe['title']); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 style="color: #ed563b;">Descriere:</h6>
                                        <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
                                        
                                        <h6 style="color: #ed563b; margin-top: 20px;">Pasi de preparare:</h6>
                                        <p><?php echo nl2br(htmlspecialchars($recipe['steps'])); ?></p>
                                        
                                        <div style="margin-top: 20px;">
                                            <p><strong>Calorii totale:</strong> <?php echo htmlspecialchars($recipe['total_calories']); ?> kcal</p>
                                            <p><strong>Creat de:</strong> <?php echo htmlspecialchars($recipe['author_name'] ?? 'Necunoscut'); ?></p>
                                            <p><strong>Data:</strong> <?php echo date('d.m.Y H:i', strtotime($recipe['created_at'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="border-top: 1px solid #ed563b;">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">inchide</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-lg-12 text-center">
                        <div class="main-content" style="padding: 50px;">
                            <h3 style="color: #fff;">Nu exista retete disponibile momentan</h3>
                            <p style="color: #fff;">
                                <?php if ($isAdmin): ?>
                                    Adauga prima reteta folosind butonul de mai sus!
                                <?php else: ?>
                                    Revino curand pentru retete noi si delicioase!
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- ***** Retete Section End ***** -->

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
