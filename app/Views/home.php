<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Training Studio - Free CSS Template</title>
<!--

TemplateMo 548 Training Studio

https://templatemo.com/tm-548-training-studio

-->
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="./../assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="./../assets/css/font-awesome.css">

    <link rel="stylesheet" href="./../assets/css/templatemo-training-studio.css">

    <!-- Custom CSS Files -->
    <link rel="stylesheet" type="text/css" href="./../public/css/base.css">
    <link rel="stylesheet" type="text/css" href="./../public/css/components.css">

    </head>

    <body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="" class="logo">Fitness<em> Studio</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">About</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Classes</a></li>

                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                            <li class="main-button">
                                <?php if (isset($_SESSION['user_id'])): ?>
                                   <li class="main-button">
                                       <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>logout">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>

                                   </li>
                                <?php else: ?>
                                     <li class="main-button">
                                         <a href="#" data-toggle="modal" data-target="#loginModal">Log In</a>
                                     </li>
                                     <li class="main-button">
                                         <a href="#" data-toggle="modal" data-target="#signupModal">Sign Up</a>
                                     </li>
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

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="./../assets/images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>work smarter, get stronger</h6>
                <h2>easy with our <em>gym</em></h2>

            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Features Item Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Fintess <em>Studio</em></h2>
                        <img src="./../assets/images/line-dec.png" alt="waves">
                        <h5>Training Studio first gym and fitness center free for students !<br>
                        You are allowed to use any time without time restrictions.</h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="First One">
                            </div>
                            <div class="right-content">
                                <h4><a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>retete" style="color: inherit; text-decoration: none;">Vizualizare Retete</a></h4>
                                <p>Descopera o colectie completa de retete sanatoase si nutritive, special create pentru a-ti sustine antrenamentele si stilul de viata activ.</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="second one">
                            </div>
                            <div class="right-content">
                                <h4><a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>antrenamente" style="color: inherit; text-decoration: none;">Vizualizare Antrenamente</a></h4>
                                <p>Acceseaza programele noastre de antrenament personalizate, adaptate tuturor nivelurilor de pregatire fizica.</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="third gym training">
                            </div>
                            <div class="right-content">
                                <h4><a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>orar" style="color: inherit; text-decoration: none;">Vizualizare Orar</a></h4>
                                <p>Verifica programul de deschidere a salii de antrenamente de luni pana vineri si weekend-ul.</p>

                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="fourth muscle">
                            </div>
                            <div class="right-content">
                                <h4>In curand...</h4>
                                <p>Aceasta sectiune va fi disponibila in curand cu functionalitati noi si utile.</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="training fifth">
                            </div>
                            <div class="right-content">
                                <h4>In curand...</h4>
                                <p>Aceasta sectiune va fi disponibila in curand cu functionalitati noi si utile.</p>

                            </div>
                        </li>
                        <li class="feature-item">
                            <div class="left-icon">
                                <img src="./../assets/images/features-first-icon.png" alt="gym training">
                            </div>
                            <div class="right-content">
                                <h4>In curand...</h4>
                                <p>Aceasta sectiune va fi disponibila in curand cu functionalitati noi si utile.</p>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Item End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section" id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Don’t <em>think</em>, begin <em>today</em>!</h2>
                        <p>Recognizing that true health is not merely the absence of disease but a proactive journey
                        towards peak physical and mental wellness, step into our fitness studio today where dedicated coaches,
                        state-of-the-art equipment, and a supportive community stand ready to empower you to shed the sedentary
                         habits of yesterday, fortify your body's defenses, and build the enduring strength and energy required to
                         fully embrace the vibrant life you deserve.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Our <em>Classes</em></h2>
                        <img src="./../assets/images/line-dec.png" alt="">
                        <p>Alege din varietatea noastra de clase - Yoga pentru relaxare, Zumba pentru energie, Fitness pentru forta sau Online Sport Classes pentru flexibilitate maxima. Fiecare clasa este conceputa sa te ajute sa iti atingi obiectivele!</p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
              <div class="col-lg-4">
                <ul>
                  <li><a href='#tabs-1'><img src="./../assets/images/tabs-first-icon.png" alt="">Yoga</a></li>
                  <li><a href='#tabs-2'><img src="./../assets/images/tabs-first-icon.png" alt="">Zumba</a></a></li>
                  <li><a href='#tabs-3'><img src="./../assets/images/tabs-first-icon.png" alt="">Fitness</a></a></li>
                  <li><a href='#tabs-4'><img src="./../assets/images/tabs-first-icon.png" alt="">Online Sport Classes</a></a></li>

                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                  <article id='tabs-1'>
                    <div id="carousel1" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="./../assets/images/images/2/images.jpeg" class="d-block w-100" alt="Yoga Class">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/2/images (1).jpeg" class="d-block w-100" alt="Yoga Image 2">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/2/images (2).jpeg" class="d-block w-100" alt="Yoga Image 3">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <h4>Yoga</h4>
                    <p>Descopera echilibrul perfect intre corp si minte prin clasele noastre de Yoga. Fie ca esti incepator sau avansat, vei gasi pozitii si tehnici adaptate nivelului tau, pentru relaxare profunda si flexibilitate imbunatatita.</p>

                  </article>
                  <article id='tabs-2'>
                    <div id="carousel2" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="./../assets/images/images/1/benefits-of-zumba.webp" class="d-block w-100" alt="Zumba Class">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/1/hq720.jpg" class="d-block w-100" alt="Zumba Image 2">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/1/Zumba-Workout-ClassPass-scaled.jpeg" class="d-block w-100" alt="Zumba Image 3">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <h4>Zumba</h4>
                    <p>Misca-te pe ritmuri latino entuziaste si arde calorii fara sa simti ca te antrenezi! Clasele noastre de Zumba combina dans si fitness intr-o atmosfera plina de energie si distractie, perfecta pentru oricine doreste sa slabeasca si sa se distreze.</p>

                  </article>
                  <article id='tabs-3'>
                    <div id="carousel3" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="./../assets/images/images/3/2023_02_08_SF_GymFloor-860-1024x683-1-qep3pa1r6s1f1ajydt3vni5ytgt0pju0tyjufoufzk.jpg" class="d-block w-100" alt="Fitness Class">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/3/Gym-Floor-Jobs-Header-1200x900-1.jpg" class="d-block w-100" alt="Fitness Image 2">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/3/Hero-12-scaled.jpg" class="d-block w-100" alt="Fitness Image 3">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <h4>Fitness</h4>
                    <p>Construieste-ti forta si rezistenta cu programele noastre complete de fitness. De la antrenamente cardio intense la exercitii de tonifiere musculara, avem echipamentele si ghidarea necesara pentru a-ti atinge obiectivele de fitness.</p>

                  </article>
                  <article id='tabs-4'>
                    <div id="carousel4" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img src="./../assets/images/images/4/5-Things-to-Know-Before-Trying-Online-Workout-Classes-e1442902483107.avif" class="d-block w-100" alt="Online Sport Classes">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/4/Online Group Fitness.webp" class="d-block w-100" alt="Online Classes Image 2">
                        </div>
                        <div class="carousel-item">
                          <img src="./../assets/images/images/4/Online_classes_high_res_menu_buttons_1.png" class="d-block w-100" alt="Online Classes Image 3">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel4" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel4" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <h4>Online Sport Classes</h4>
                    <p>Antreneaza-te de acasa sau de oriunde te afli! Clasele noastre online iti ofera flexibilitatea sa iti mentii rutina de sport oriunde ai fi, cu antrenori profesionisti si sesiuni live interactive sau programari la cerere.</p>

                  </article>
                </section>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->



    <!-- ***** Contact Us Area Starts ***** -->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11270.781682701194!2d25.597980302324965!3d45.6548766158223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b35b7194f83b15%3A0x6b8b0e5138f65839!2sBra%C8%99ov!5e0!3m2!1sro!2sro!4e0" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="contact-form">
                        <form id="contact" action="" method="post">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-12 col-sm-12">
                              <fieldset>
                                <input name="subject" type="text" id="subject" placeholder="Subject">
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2025 M.N.C. SoftwareStudio

                    - Designed with <a rel="nofollow" href="https://templatemo.com" class="tm-text-link" target="_parent">TemplateMo</a>

                </p>

                    <!-- You shall support us a little via PayPal to info@templatemo.com -->

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


    <?php include 'signup_modal.php'; ?>
    <?php include 'login_modal.php'; ?>
    <?php include 'session_messages_modal.php'; ?>
  </body>
</html>