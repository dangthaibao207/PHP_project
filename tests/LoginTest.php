<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testSuccessfulLogin() {
        // Include the connection file
        include('server/connection.php');

        // Simulate a POST request with correct credentials
        $_POST['email'] = 'dpisindahouse@gmail.com';
        $_POST['password'] = '123456';

        ob_start(); // Capture the output (headers sent by header() function)
        include('../login.php'); // Execute the login script
        $output = ob_get_contents(); // Get the output
        ob_end_clean(); // Clean the buffer

        // Assert that the session variable 'logged_in' is set
        $this->assertTrue(isset($_SESSION['logged_in']));
        // Assert that the user is redirected to account.php with a success message
        $this->assertStringContainsString('location: account.php?login_success=Logged in successfully', $output);
    }

    public function testFailedLogin() {
        // Include the connection file
        include('server/connection.php');

        // Simulate a POST request with incorrect credentials
        $_POST['email'] = 'invalidemail@example.com';
        $_POST['password'] = 'invalidpassword';

        ob_start(); // Capture the output (headers sent by header() function)
        include('../login.php'); // Execute the login script
        $output = ob_get_contents(); // Get the output
        ob_end_clean(); // Clean the buffer

        // Assert that the session variable 'logged_in' is not set
        $this->assertFalse(isset($_SESSION['logged_in']));
        // Assert that the user is not redirected to account.php
        $this->assertStringNotContainsString('location: account.php', $output);
    }

    public function testEmptyCredentials() {
        // Simulate a POST request with empty credentials
        $_POST['email'] = '';
        $_POST['password'] = '';
    
        ob_start();
        include('../login.php');
        $output = ob_get_contents();
        ob_end_clean();
    
        // Assert that the session variable 'logged_in' is not set
        $this->assertFalse(isset($_SESSION['logged_in']));
        // Assert that the user is not redirected to account.php
        $this->assertStringNotContainsString('location: account.php', $output);
    }
    
    public function testInvalidEmail() {
        // Simulate a POST request with invalid email format
        $_POST['email'] = 'invalidemail';
        $_POST['password'] = '123456';
    
        ob_start();
        include('../login.php');
        $output = ob_get_contents();
        ob_end_clean();
    
        // Assert that the session variable 'logged_in' is not set
        $this->assertFalse(isset($_SESSION['logged_in']));
        // Assert that the user is not redirected to account.php
        $this->assertStringNotContainsString('location: account.php', $output);
    }

    public function testIncorrectPassword() {
        // Simulate a POST request with incorrect password
        $_POST['email'] = 'dpisindahouse@gmail.com';
        $_POST['password'] = 'incorrectpassword';
    
        ob_start();
        include('../login.php');
        $output = ob_get_contents();
        ob_end_clean();
    
        // Assert that the session variable 'logged_in' is not set
        $this->assertFalse(isset($_SESSION['logged_in']));
        // Assert that the user is not redirected to account.php
        $this->assertStringNotContainsString('location: account.php', $output);
    }
}
?>
