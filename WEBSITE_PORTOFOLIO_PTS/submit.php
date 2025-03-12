<?php
$host     = "localhost";
$username = "root";
$password = "";
$dbname   = "ariyadi_data";

$connection = mysqli_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO contacts (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
        
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "suwun";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error dalam menyiapkan query.";
        }
    } else {
        echo "Wajib di isi semua";
    }
}

mysqli_close($connection);
?>