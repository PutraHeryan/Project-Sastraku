<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$penulis = $_SESSION['username'];

$sql = "SELECT id, judul FROM data_buku WHERE penulis = '$penulis'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Daftar Buku Anda</h2>

<?php
if ($result->num_rows > 0) {
    $nomor = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<div>';
        echo '<h3>' . $nomor . '. ' . $row['judul'] . '</h3>';
        echo '</div>';
        $nomor++;
    }
} else {
    echo 'Anda belum menulis buku.';
}
?>

<a href="http://localhost/project-sastraku/homepage.php">Kembali</a>
</body>
</html>