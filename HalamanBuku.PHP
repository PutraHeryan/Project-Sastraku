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

$id_buku = $_SESSION['id_buku'];

$sql = "SELECT * FROM data_buku WHERE id='$id_buku'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Buku tidak ditemukan!";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<body>

<h2><?php echo $row['judul']; ?></h2>
<img src="data:image/jpeg;base64,<?php echo base64_encode($row['sampul_gambar']); ?>" />
<p>Kategori Sastra: <?php echo $row['jenis_sastra']; ?></p>
<p>Genre: <?php echo $row['genre']; ?></p>
<p>Sinopsis: <?php echo $row['sinopsis']; ?></p>

<button onclick="alert('Selamat membaca!')">Mulai Membaca</button>

</body>
</html>