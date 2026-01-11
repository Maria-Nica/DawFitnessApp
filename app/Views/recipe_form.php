<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title><?php echo isset($recipe) ? 'Editare Reteta' : 'Adaugare Reteta'; ?> - Fitness Studio</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="./../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="./../../assets/css/templatemo-training-studio.css">
    
    <style>
        body {
            background-color: #232d39;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <!-- ***** Recipe Form Section Start ***** -->
    <div class="container" style="width: 100%; max-width: 1000px; padding: 20px;">
          <form action="<?php echo isset($recipe) ? (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete/update/' . $recipe['recipe_id'] : (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete/store'; ?>" 
              method="POST" 
              style="background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); padding: 50px; border-radius: 15px; border: 2px solid #ed563b; box-shadow: 0 10px 30px rgba(237, 86, 59, 0.3);">
            
            <h2 style="color: #ed563b; text-align: center; margin-bottom: 40px; font-size: 28px; font-weight: bold;">
                <?php echo isset($recipe) ? 'Editare Reteta' : 'Adaugare Reteta'; ?>
            </h2>

            <?php echo CSRF::getTokenInput(); ?>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="title" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Titlu Reteta *
                </label>
                <input type="text" 
                       class="form-control" 
                       id="title" 
                       name="title" 
                       placeholder="Ex: Salata de pui cu quinoa"
                       value="<?php echo isset($recipe) ? htmlspecialchars($recipe['title']) : ''; ?>"
                       maxlength="150"
                       required
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="description" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Descriere
                </label>
                <textarea class="form-control" 
                          id="description" 
                          name="description" 
                          rows="4"
                          placeholder="O descriere scurta si atragatoare a retetei..."
                          style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; resize: vertical; text-align: center; width: 100%; max-width: 100%;"><?php echo isset($recipe) ? htmlspecialchars($recipe['description']) : ''; ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="steps" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Pasi de Preparare
                </label>
                <textarea class="form-control" 
                          id="steps" 
                          name="steps" 
                          rows="10"
                          placeholder="Pas 1: Incalzeste tigaia...&#10;Pas 2: Adauga ingredientele...&#10;Pas 3: Gateste timp de 10 minute..."
                          style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; line-height: 1.6; resize: vertical; text-align: center; width: 100%; max-width: 100%;"><?php echo isset($recipe) ? htmlspecialchars($recipe['steps']) : ''; ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="total_calories" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Calorii Totale (kcal)
                </label>
                <input type="number" 
                       class="form-control" 
                       id="total_calories" 
                       name="total_calories" 
                       placeholder="420"
                       value="<?php echo isset($recipe) ? htmlspecialchars($recipe['total_calories']) : '0'; ?>"
                       min="0"
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Vizibilitate
                </label>
                <div style="padding: 12px 0; text-align: center;">
                    <label style="color: #fff; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center;">
                        <input type="checkbox" 
                               id="is_public" 
                               name="is_public"
                               <?php echo (!isset($recipe) || $recipe['is_public'] == 1) ? 'checked' : ''; ?>
                               style="width: 18px; height: 18px; margin-right: 10px;">
                        Reteta publica
                    </label>
                </div>
            </div>

            <div class="text-center" style="margin-top: 30px; padding-top: 25px; border-top: 2px solid #ed563b;">
                <button type="submit" class="main-button" style="margin-right: 15px; padding: 12px 40px; font-size: 15px; font-weight: bold;">
                    <?php echo isset($recipe) ? 'Actualizeaza' : 'Adauga'; ?>
                </button>
                <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>retete" 
                   class="btn btn-secondary" style="padding: 12px 40px; font-size: 15px; font-weight: bold; background-color: #6c757d; border: none;">
                    Anuleaza
                </a>
            </div>
        </form>
    </div>
    <!-- ***** Recipe Form Section End ***** -->

    <!-- jQuery -->
    <script src="./../../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="./../../assets/js/popper.js"></script>
    <script src="./../../assets/js/bootstrap.min.js"></script>

</body>
</html>
