<?php
// 设置允许上传的最大文件大小
define('MAX_FILE_SIZE', 1000 * 1024 * 1024); // 10MB
$upload_dir = 'uploads/'; // 文件上传的目录

// 创建上传目录（如果不存在）
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// 检查文件是否通过 POST 方法上传
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = basename($file['name']);
    $file_tmp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // 检查上传是否成功
    if ($file_error !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => '文件上传失败，错误代码: ' . $file_error]);
        exit;
    }

    // // 检查文件大小
    // if ($file_size > MAX_FILE_SIZE) {
    //     echo json_encode(['success' => false, 'message' => '文件太大，最大允许上传10MB']);
    //     exit;
    // }

    // // 检查文件类型（可根据需要调整）
    // $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/zip'];
    // if (!in_array($file['type'], $allowed_types)) {
    //     echo json_encode(['success' => false, 'message' => '不支持的文件类型']);
    //     exit;
    // }

    // 生成文件保存路径
    $upload_path = $upload_dir . $file_name;

    // 移动文件到目标目录
    if (move_uploaded_file($file_tmp_name, $upload_path)) {
        // 文件上传成功，返回成功信息
        echo json_encode([
            'success' => true,
            'message' => '文件上传成功',
            'file_name' => $file_name,
            'file_path' => $upload_path
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => '文件上传失败']);
    }
} else {
    echo json_encode(['success' => false, 'message' => '没有文件上传']);
}
?>
