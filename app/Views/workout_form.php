<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title><?php echo isset($workout) ? 'Editare Antrenament' : 'Adaugare Antrenament'; ?> - Fitness Studio</title>

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

    <!-- ***** Workout Form Section Start ***** -->
    <div class="container" style="width: 100%; max-width: 1000px; padding: 20px;">
          <form action="<?php echo isset($workout) ? (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'antrenamente/update/' . $workout['workout_id'] : (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'antrenamente/store'; ?>" 
              method="POST" 
              style="background: linear-gradient(145deg, #232d39 0%, #1a242f 100%); padding: 50px; border-radius: 15px; border: 2px solid #ed563b; box-shadow: 0 10px 30px rgba(237, 86, 59, 0.3);">
            <?php echo CSRF::getTokenInput(); ?>
            
            <h2 style="color: #ed563b; text-align: center; margin-bottom: 40px; font-size: 28px; font-weight: bold;">
                <?php echo isset($workout) ? 'Editare Antrenament' : 'Adaugare Antrenament'; ?>
            </h2>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="workout_type_id" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Tip Antrenament *
                </label>
                <select class="form-control" 
                        id="workout_type_id" 
                        name="workout_type_id" 
                        required
                        style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
                    <option value="">Selecteaza tipul de antrenament</option>
                    <?php foreach ($workoutTypes as $type): ?>
                        <option value="<?php echo $type['workout_type_id']; ?>" 
                                <?php echo (isset($workout) && $workout['workout_type_id'] == $type['workout_type_id']) ? 'selected' : ''; ?>>
                            <?php echo ucfirst(htmlspecialchars($type['name'])); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="description" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Descriere
                </label>
                <textarea class="form-control" 
                          id="description" 
                          name="description" 
                          rows="4"
                          placeholder="O descriere scurta a antrenamentului..."
                          style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; resize: vertical; text-align: center; width: 100%; max-width: 100%;"><?php echo isset($workout) ? htmlspecialchars($workout['description']) : ''; ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="date" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Data *
                </label>
                <input type="date" 
                       class="form-control" 
                       id="date" 
                       name="date" 
                       value="<?php echo isset($workout) ? htmlspecialchars($workout['date']) : date('Y-m-d'); ?>"
                       required
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="duration_min" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Durata (minute) *
                </label>
                <input type="number" 
                       class="form-control" 
                       id="duration_min" 
                       name="duration_min" 
                       placeholder="45"
                       value="<?php echo isset($workout) ? htmlspecialchars($workout['duration_min']) : ''; ?>"
                       min="1"
                       required
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="intensity" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Intensitate (1-10) *
                </label>
                <input type="number" 
                       class="form-control" 
                       id="intensity" 
                       name="intensity" 
                       placeholder="7"
                       value="<?php echo isset($workout) ? htmlspecialchars($workout['intensity']) : ''; ?>"
                       min="1"
                       max="10"
                       required
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="calories_burned" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Calorii Arse (kcal) *
                </label>
                <input type="number" 
                       class="form-control" 
                       id="calories_burned" 
                       name="calories_burned" 
                       placeholder="350"
                       value="<?php echo isset($workout) ? htmlspecialchars($workout['calories_burned']) : '0'; ?>"
                       min="0"
                       required
                       style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; text-align: center; width: 100%; max-width: 100%;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="notes" style="color: #ed563b; font-weight: bold; font-size: 15px; margin-bottom: 8px; display: block; text-align: center;">
                    Notite
                </label>
                <textarea class="form-control" 
                          id="notes" 
                          name="notes" 
                          rows="4"
                          placeholder="Adauga notite despre antrenament (optional)..."
                          style="background-color: #1a242f; color: #fff; border: 2px solid #ed563b; padding: 12px; font-size: 14px; border-radius: 8px; resize: vertical; text-align: center; width: 100%; max-width: 100%;"><?php echo isset($workout) ? htmlspecialchars($workout['notes']) : ''; ?></textarea>
            </div>

            <div class="text-center" style="margin-top: 30px; padding-top: 25px; border-top: 2px solid #ed563b;">
                <button type="submit" class="main-button" style="margin-right: 15px; padding: 12px 40px; font-size: 15px; font-weight: bold;">
                    <?php echo isset($workout) ? 'Actualizeaza' : 'Adauga'; ?>
                </button>
                <a href="<?php echo defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'; ?>antrenamente" 
                   class="btn btn-secondary" style="padding: 12px 40px; font-size: 15px; font-weight: bold; background-color: #6c757d; border: none;">
                    Anuleaza
                </a>
            </div>
        </form>
    </div>
    <!-- ***** Workout Form Section End ***** -->

    <!-- jQuery -->
    <script src="./../../assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="./../../assets/js/popper.js"></script>
    <script src="./../../assets/js/bootstrap.min.js"></script>

</body>
</html>
