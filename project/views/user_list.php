<!-- File: views/user_list.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Danh sách người dùng</h2>
    <a href="index.php?action=add" class="btn btn-primary mb-3">Thêm người dùng mới</a>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Liên hệ</th>
                <th>Địa chỉ</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($users) && count($users) > 0) {
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user["nguoi_dung_id"] . "</td>";
                    echo "<td>" . $user["nguoi_dung_ten"] . "</td>";
                    echo "<td>" . $user["nguoi_dung_email"] . "</td>";
                    echo "<td>" . $user["nguoi_dung_contact"] . "</td>";
                    echo "<td>" . $user["nguoi_dung_address"] . "</td>";
                    echo "<td><img src='" . $user["nguoi_dung_image"] . "' alt='Hình ảnh' width='100' class='img-thumbnail'></td>";
                    echo "<td>";
                    echo "<a href='index.php?action=edit&id=" . $user["nguoi_dung_id"] . "' class='btn btn-warning btn-sm me-1'>Sửa</a>";
                    echo "<a href='index.php?action=delete&id=" . $user["nguoi_dung_id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Bạn có chắc chắn muốn xóa người dùng này không?\")'>Xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
