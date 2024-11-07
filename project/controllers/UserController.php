<?php
include_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Hiển thị danh sách người dùng
    public function showUserList() {
        $users = $this->userModel->getAllUsers();
        include_once __DIR__ . '/../views/user_list.php';  // Gọi view danh sách người dùng
    }

    // Hiển thị form thêm người dùng
    public function showAddUserForm() {
        include_once __DIR__ . '/../views/add_user.php';
    }

    // Thêm người dùng mới
    public function addUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $image = $_FILES['image']['name'];

            if ($image) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
            }

            $added = $this->userModel->addUser($name, $email, $contact, $address, $image);

            if ($added) {
                header('Location: index.php?action=list');
                exit;
            } else {
                echo "Thêm người dùng thất bại!";
            }
        }
    }

    // Hiển thị form sửa người dùng
    public function showEditUserForm() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $user = $this->userModel->getUserById($id);
            if ($user) {
                include_once __DIR__ . '/../views/edit_user.php';
            } else {
                echo "Không tìm thấy người dùng.";
            }
        }
    }

    // Cập nhật thông tin người dùng
    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $image = $_FILES['image']['name'];

            if ($image) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
            } else {
                $image = $_POST['old_image'];  // Nếu không có ảnh mới, giữ ảnh cũ
            }

            $updated = $this->userModel->updateUser($id, $name, $email, $contact, $address, $image);

            if ($updated) {
                header('Location: index.php?action=list');  // Quay lại danh sách người dùng
                exit;
            } else {
                echo "Cập nhật người dùng thất bại!";
            }
        }
    }

    // Xóa người dùng
    public function deleteUser($id) {
        $deleted = $this->userModel->deleteUser($id);
        if ($deleted) {
            header('Location: index.php?action=list');  // Quay lại danh sách người dùng sau khi xóa
            exit;
        } else {
            echo "Xóa người dùng thất bại!";
        }
    }
}
?>
