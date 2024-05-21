<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_sastraku";


// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);


// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


// Mendapatkan ID karya sastra yang dipilih dari halaman sebelumnya
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $id = trim($_GET['id']);
   
    // Mengambil data karya sastra berdasarkan ID
    $sql = "SELECT judul, jenis_sastra, sampul_buku, sinopsis FROM data_buku WHERE id = ?";
   
    if($stmt = $conn->prepare($sql)){
        // Bind parameter ke pernyataan
        $stmt->bind_param("i", $param_id);
       
        // Set parameter
        $param_id = $id;
       
        // Mengeksekusi pernyataan
        if($stmt->execute()){
            // Menyimpan hasil
            $stmt->store_result();
           
            // Memeriksa apakah ID tersebut ada dalam database
            if($stmt->num_rows == 1){                    
                // Mengikat variabel hasil
                $stmt->bind_result($judul, $jenis_sastra, $sampul_buku, $sinopsis);
                $stmt->fetch();
            } else{
                // Jika ID tidak valid, redirect ke halaman error
                header("location: error.php");
                exit();
            }
        } else{
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }
   
    // Menutup pernyataan
    $stmt->close();
   
    // Menutup koneksi
    $conn->close();
} else{
    // Jika ID tidak ada, redirect ke halaman error
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Baca</title>
    <style>
        /* Tambahkan CSS sesuai kebutuhan Anda */
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $judul; ?></h2>
        <p>Jenis Sastra: <?php echo $jenis_sastra; ?></p>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($sampul_buku); ?>" alt="Sampul Buku">
        <p><?php echo $sinopsis; ?></p>
        <form action="proses-rating.php" method="post">
            <label for="rating">Rating (1-10):</label>
            <input type="number" id="rating" name="rating" min="1" max="10" required>
            <input type="hidden" name="id_buku" value="<?php echo $id; ?>">
            <input type="submit" value="Beri Rating">
        </form>
        <a href="baca.php">Kembali</a>
    </div>
</body>
</html>