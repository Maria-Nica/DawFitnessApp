<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/TestHelper.php';
require_once __DIR__ . '/../app/Core/Escaper.php';

class SecurityTest extends TestCase {

    public function testSqlInjectionInCreateUserIsHandled() {
        $um = new UserModel();
        $email = "inject+'; DROP TABLE users; --" . time() . "@example.com";
        $name = 'SQLi Test';
        $password = 'Password123!';

        // Should not throw and should store the exact email string
        $res = $um->createUser($name, $email, $password);
        $this->assertTrue($res['success']);

        // Verify user exists with exact email
        $db = test_db_connect();
        $stmt = $db->prepare('SELECT email FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $res['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->assertEquals($email, $row['email']);

        // Cleanup
        $stmt = $db->prepare('DELETE FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $res['user_id']);
        $stmt->execute();
        $db->close();
    }

    public function testXssEscaping() {
        $raw = '<script>alert("xss")</script>';
        $escaped = Escaper::escape($raw);
        $this->assertStringNotContainsString('<script>', $escaped);
        $this->assertStringContainsString('&lt;script&gt;', $escaped);
    }
}
