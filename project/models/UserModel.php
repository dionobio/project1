<?php
class UserModel {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "nguoi_dung";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    // Lấy tất cả người dùng
    public function getAllUsers() {
        $sql = "SELECT * FROM nguoi_dung";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Thêm người dùng mới
    public function addUser($name, $email, $contact, $address, $image) {
        $sql = "INSERT INTO nguoi_dung (nguoi_dung_ten, nguoi_dung_email, nguoi_dung_contact, nguoi_dung_address, nguoi_dung_image) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $contact, $address, $image);
        return $stmt->execute();
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        $sql = "SELECT * FROM nguoi_dung WHERE nguoi_dung_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Cập nhật người dùng
    public function updateUser($id, $name, $email, $contact, $address, $image) {
        if (empty($image)) {
            $sql = "UPDATE nguoi_dung SET nguoi_dung_ten = ?, nguoi_dung_email = ?, nguoi_dung_contact = ?, nguoi_dung_address = ? WHERE nguoi_dung_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $email, $contact, $address, $id);
        } else {
            $sql = "UPDATE nguoi_dung SET nguoi_dung_ten = ?, nguoi_dung_email = ?, nguoi_dung_contact = ?, nguoi_dung_address = ?, nguoi_dung_image = ? WHERE nguoi_dung_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssi", $name, $email, $contact, $address, $image, $id);
        }

        return $stmt->execute();
    }

    // Xóa người dùng
    public function deleteUser($id) {
        $sql = "DELETE FROM nguoi_dung WHERE nguoi_dung_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    
        // Reset lại AUTO_INCREMENT
        $this->conn->query("ALTER TABLE nguoi_dung AUTO_INCREMENT = 1");
    
        return $stmt->affected_rows > 0;
    }
    
}
?>
