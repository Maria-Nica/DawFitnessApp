<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/TestHelper.php';

class UserModelTest extends TestCase {

    public function testCreateUserInvalidEmailThrowsValidationException() {
        $this->expectException(ValidationException::class);
        $um = new UserModel();
        $um->createUser('Test User', 'invalid-email', 'password123');
    }

    public function testCreateUserAndVerifyLoginSuccess() {
        $email = 'test+' . time() . '@example.com';
        $name = 'PHPUnit Test';
        $password = 'Secret123!';

        $um = new UserModel();
        $res = $um->createUser($name, $email, $password);
        $this->assertTrue($res['success']);
        $this->assertArrayHasKey('user_id', $res);

        // Verify login
        $login = $um->verifyLogin($email, $password);
        $this->assertTrue($login['success']);
        $this->assertEquals($login['user']['email'], $email);

        // Cleanup: delete created user
        $db = test_db_connect();
        $stmt = $db->prepare('DELETE FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }

    public function testVerifyLoginWithWrongPasswordFails() {
        $email = 'test+' . time() . '@example.com';
        $name = 'PHPUnit Test 2';
        $password = 'CorrectPass1!';

        $um = new UserModel();
        $res = $um->createUser($name, $email, $password);
        $this->assertTrue($res['success']);

        $login = $um->verifyLogin($email, 'WrongPassword');
        $this->assertFalse($login['success']);

        // Cleanup
        $db = test_db_connect();
        $stmt = $db->prepare('DELETE FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}
