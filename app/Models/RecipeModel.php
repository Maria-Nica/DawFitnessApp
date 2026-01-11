<?php
// /app/Models/RecipeModel.php

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../Core/Exceptions/ValidationException.php';
require_once __DIR__ . '/../Core/Exceptions/DatabaseException.php';

class RecipeModel extends BaseModel {

    public function __construct() {
        // Call parent constructor to establish database connection
        parent::__construct();
    }

    /**
     * Get all public recipes
     * @return array Array of recipes
     */
    public function getAllRecipes(): array {
        $recipes = [];
        
        $sql = "SELECT r.*, r.created_by_user_id as created_by, u.name as author_name 
                FROM recipes r 
                LEFT JOIN users u ON r.created_by_user_id = u.user_id 
                WHERE r.is_public = 1 
                ORDER BY r.created_at DESC";

        if ($result = $this->db->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $recipes[] = $row;
            }
            $result->free();
        }

        return $recipes;
    }

    /**
     * Get a single recipe by ID
     * @param int $recipe_id
     * @return array|null Recipe data or null if not found
     */
    public function getRecipeById(int $recipe_id): ?array {
        $sql = "SELECT r.*, r.created_by_user_id as created_by, u.name as author_name 
                FROM recipes r 
                LEFT JOIN users u ON r.created_by_user_id = u.user_id 
                WHERE r.recipe_id = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $recipe_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $recipe = $result->fetch_assoc();
                $stmt->close();
                return $recipe;
            }
            
            $stmt->close();
        }

        return null;
    }

    /**
     * Create a new recipe
     * @param string $title
     * @param string $description
     * @param string $steps
     * @param int $created_by_user_id
     * @param int $total_calories
     * @param bool $is_public
     * @return array Operation result
     */
    public function createRecipe(
        string $title, 
        string $description, 
        string $steps, 
        int $created_by_user_id,
        int $total_calories = 0,
        bool $is_public = true
    ): array {
        
        // Validation
        if (empty(trim($title))) {
            throw new ValidationException(
                'Titlul este obligatoriu',
                'title',
                $title
            );
        }

        if (strlen($title) > 150) {
            throw new ValidationException(
                'Titlul nu poate depasi 150 de caractere',
                'title',
                $title
            );
        }

        $sql = "INSERT INTO recipes (title, description, steps, created_by_user_id, total_calories, is_public) 
                VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->db->prepare($sql)) {
            $is_public_int = $is_public ? 1 : 0;
            $stmt->bind_param("sssiii", $title, $description, $steps, $created_by_user_id, $total_calories, $is_public_int);

            if ($stmt->execute()) {
                $recipe_id = $stmt->insert_id;
                $stmt->close();
                return ['success' => true, 'message' => 'Reteta a fost creata cu succes!', 'recipe_id' => $recipe_id];
            } else {
                $stmt->close();
                return ['success' => false, 'message' => 'Eroare la crearea retetei.'];
            }
        }

        return ['success' => false, 'message' => 'Eroare la pregatirea interogarii.'];
    }

    /**
     * Update an existing recipe
     * @param int $recipe_id
     * @param string $title
     * @param string $description
     * @param string $steps
     * @param int $total_calories
     * @param bool $is_public
     * @return array Operation result
     */
    public function updateRecipe(
        int $recipe_id,
        string $title, 
        string $description, 
        string $steps,
        int $total_calories = 0,
        bool $is_public = true
    ): array {
        
        // Validation
        if (empty(trim($title))) {
            return ['success' => false, 'message' => 'Titlul este obligatoriu.'];
        }

        if (strlen($title) > 150) {
            return ['success' => false, 'message' => 'Titlul nu poate depasi 150 de caractere.'];
        }

        $sql = "UPDATE recipes 
                SET title = ?, description = ?, steps = ?, total_calories = ?, is_public = ? 
                WHERE recipe_id = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $is_public_int = $is_public ? 1 : 0;
            $stmt->bind_param("sssiii", $title, $description, $steps, $total_calories, $is_public_int, $recipe_id);

            if ($stmt->execute()) {
                $affected_rows = $stmt->affected_rows;
                $stmt->close();
                
                if ($affected_rows > 0) {
                    return ['success' => true, 'message' => 'Reteta a fost actualizata cu succes!'];
                } else {
                    return ['success' => false, 'message' => 'Nicio modificare efectuata sau reteta nu exista.'];
                }
            } else {
                $stmt->close();
                return ['success' => false, 'message' => 'Eroare la actualizarea retetei.'];
            }
        }

        return ['success' => false, 'message' => 'Eroare la pregatirea interogarii.'];
    }

    /**
     * Delete a recipe
     * @param int $recipe_id
     * @return array Operation result
     */
    public function deleteRecipe(int $recipe_id): array {
        $sql = "DELETE FROM recipes WHERE recipe_id = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $recipe_id);

            if ($stmt->execute()) {
                $affected_rows = $stmt->affected_rows;
                $stmt->close();
                
                if ($affected_rows > 0) {
                    return ['success' => true, 'message' => 'Reteta a fost stearsa cu succes!'];
                } else {
                    return ['success' => false, 'message' => 'Reteta nu exista.'];
                }
            } else {
                $stmt->close();
                return ['success' => false, 'message' => 'Eroare la stergerea retetei.'];
            }
        }

        return ['success' => false, 'message' => 'Eroare la pregatirea interogarii.'];
    }

}
