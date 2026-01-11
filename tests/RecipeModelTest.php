<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/TestHelper.php';

class RecipeModelTest extends TestCase {

    public function testCreateRecipeEmptyTitleThrowsValidationException() {
        $this->expectException(ValidationException::class);
        $rm = new RecipeModel();
        $rm->createRecipe('', 'desc', 'steps', 1, 100, true);
    }

    public function testCreateRecipeSuccessAndCleanup() {
        // Ensure there is a valid user to reference
        $email = 'test+' . time() . '@example.com';
        $um = new UserModel();
        $resUser = $um->createUser('Recipe Author', $email, 'Password1!');
        $this->assertTrue($resUser['success']);
        $user_id = $resUser['user_id'];

        $rm = new RecipeModel();
        $title = 'Test Recipe ' . time();
        $res = $rm->createRecipe($title, 'Description', 'Step1', $user_id, 250, true);
        $this->assertTrue($res['success']);
        $this->assertArrayHasKey('recipe_id', $res);

        // Cleanup: delete recipe and user
        $db = test_db_connect();
        $stmt = $db->prepare('DELETE FROM recipes WHERE recipe_id = ?');
        $stmt->bind_param('i', $res['recipe_id']);
        $stmt->execute();
        $stmt->close();

        $stmt = $db->prepare('DELETE FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}
