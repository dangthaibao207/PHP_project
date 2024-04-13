<?php
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase {
    public function testConnection() {
        $conn = mysqli_connect("localhost", "root", "", "doanphp");

        // Kiểm tra xem kết nối có thành công không
        $this->assertNotFalse($conn);

        // Đóng kết nối
        mysqli_close($conn);
    }
}
?>
