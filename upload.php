<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["file"]["name"];
        $file_name = preg_replace("/[^A-Za-z0-9 ._-]/", '', $file_name); // Sanitize filename
        
        $upload_dir = __DIR__ . "/uploaded files/";
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if not exists
        }
        
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $upload_dir . $file_name)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error: No file uploaded or an error occurred during upload.";
    }
} else {
    echo "Invalid request.";
}
?>
