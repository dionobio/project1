<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Sửa người dùng</h2>
    <form action="index.php?action=updateUser" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['nguoi_dung_id']; ?>">

        <!-- Trường ẩn lưu lại ảnh cũ -->
        <input type="hidden" name="old_image" value="<?php echo htmlspecialchars($user['nguoi_dung_image']); ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['nguoi_dung_ten']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['nguoi_dung_email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Liên hệ</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['nguoi_dung_contact']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea class="form-control" id="address" name="address" required><?php echo htmlspecialchars($user['nguoi_dung_address']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image">
            <?php if ($user['nguoi_dung_image']): ?>
                <img src="../uploads/<?php echo htmlspecialchars($user['nguoi_dung_image']); ?>" alt="Hình ảnh" width="100" class="img-thumbnail">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

</body>
</html>
