<?php
// /app/Controllers/RecipeController.php

require_once __DIR__ . '/../Models/RecipeModel.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Core/Exceptions/ValidationException.php';
require_once __DIR__ . '/../Core/Exceptions/DatabaseException.php';
require_once __DIR__ . '/../Core/CSRF.php';

class RecipeController {

    private $recipeModel;
    private $userModel;

    public function __construct() {
        $this->recipeModel = new RecipeModel();
        $this->userModel = new UserModel();
    }

    /**
     * Display all recipes
     */
    public function index() {
        $recipes = $this->recipeModel->getAllRecipes();
        $viewPath = __DIR__ . '/../Views/retete.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Recipes view file not found.";
        }
    }

    /**
     * Show form to create a new recipe (admin only)
     */
    public function create() {
        // Check if user is logged in and is admin
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Trebuie sa fii autentificat pentru a accesa aceasta pagina.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'));
            exit;
        }

        $userRole = $this->userModel->getUserRole($_SESSION['user_id']);
        if ($userRole !== 'admin') {
            $_SESSION['error_message'] = 'Nu ai permisiunea sa accesezi aceasta pagina.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }

        $viewPath = __DIR__ . '/../Views/recipe_form.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Recipe form view file not found.";
        }
    }

    /**
     * Store a new recipe (admin only)
     */
    public function store() {
        // Check if user is logged in and is admin
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Trebuie sa fii autentificat.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'));
            exit;
        }

        $userRole = $this->userModel->getUserRole($_SESSION['user_id']);
        if ($userRole !== 'admin') {
            $_SESSION['error_message'] = 'Nu ai permisiunea sa adaugi retete.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }

        // Validate POST data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF validation
            if (!CSRF::validateRequest()) {
                $_SESSION['error_message'] = 'CSRF validation failed.';
                header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
                exit;
            }
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $steps = trim($_POST['steps'] ?? '');
            $total_calories = intval($_POST['total_calories'] ?? 0);
            $is_public = isset($_POST['is_public']) ? true : false;

            try {
                $result = $this->recipeModel->createRecipe(
                    $title,
                    $description,
                    $steps,
                    $_SESSION['user_id'],
                    $total_calories,
                    $is_public
                );

                $_SESSION['success_message'] = $result['message'];
                
            } catch (ValidationException $e) {
                // Validation error - user-friendly message
                $_SESSION['error_message'] = $e->getFormattedMessage();
                
            } catch (DatabaseException $e) {
                // Database error
                $_SESSION['error_message'] = 'Eroare la salvarea rețetei. Vă rugăm încercați din nou.';
                
            } catch (Exception $e) {
                // Generic error
                $_SESSION['error_message'] = 'A apărut o eroare neașteptată. Vă rugăm încercați din nou.';
            }

            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }
    }

    /**
     * Show form to edit a recipe (creator only)
     */
    public function edit($recipe_id) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Trebuie sa fii autentificat pentru a accesa aceasta pagina.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'));
            exit;
        }

        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        
        if (!$recipe) {
            $_SESSION['error_message'] = 'Reteta nu a fost gasita.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }
        
        // Check if user is the creator
        if ($recipe['created_by'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Nu ai permisiunea sa editezi aceasta reteta.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }

        $viewPath = __DIR__ . '/../Views/recipe_form.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(500);
            echo "Error 500: Recipe form view file not found.";
        }
    }

    /**
     * Update a recipe (creator only)
     */
    public function update($recipe_id) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Trebuie sa fii autentificat.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'));
            exit;
        }

        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        
        if (!$recipe || $recipe['created_by'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Nu ai permisiunea sa modifici aceasta reteta.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }

        // Validate POST data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF validation
            if (!CSRF::validateRequest()) {
                $_SESSION['error_message'] = 'CSRF validation failed.';
                header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
                exit;
            }
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $steps = trim($_POST['steps'] ?? '');
            $total_calories = intval($_POST['total_calories'] ?? 0);
            $is_public = isset($_POST['is_public']) ? true : false;

            $result = $this->recipeModel->updateRecipe(
                $recipe_id,
                $title,
                $description,
                $steps,
                $total_calories,
                $is_public
            );

            if ($result['success']) {
                $_SESSION['success_message'] = $result['message'];
            } else {
                $_SESSION['error_message'] = $result['message'];
            }

            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }
    }

    /**
     * Delete a recipe (creator only)
     */
    public function delete($recipe_id) {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error_message'] = 'Trebuie sa fii autentificat.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/'));
            exit;
        }

        $recipe = $this->recipeModel->getRecipeById($recipe_id);
        
        if (!$recipe || $recipe['created_by'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = 'Nu ai permisiunea sa stergi aceasta reteta.';
            header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
            exit;
        }

        $result = $this->recipeModel->deleteRecipe($recipe_id);

        if ($result['success']) {
            $_SESSION['success_message'] = $result['message'];
        } else {
            $_SESSION['error_message'] = $result['message'];
        }

        header('Location: ' . (defined('Config::BASE_URL') ? Config::BASE_URL : '/fitnessapp/public/') . 'retete');
        exit;
    }
}
