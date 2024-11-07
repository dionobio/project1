<?php
include_once __DIR__ . '/../controllers/UserController.php';

$controller = new UserController();

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'add':
        $controller->showAddUserForm();
        break;
    case 'addUser':
        $controller->addUser();
        break;
    case 'edit':
        $controller->showEditUserForm();
        break;
    case 'updateUser':
        $controller->updateUser();
        break;
    case 'delete':
        if (isset($_GET['id'])) {
            $controller->deleteUser($_GET['id']);
        }
        break;
    default:
        $controller->showUserList();
        break;
}
?>
