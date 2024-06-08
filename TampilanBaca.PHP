<?php
session_start();
if (isset($_GET["id"])) {
    $id_buku = intval($_GET["id"]); // Sanitasi input


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


    // Mendapatkan data buku berdasarkan ID
    $sql = "SELECT judul, sinopsis, sampul_buku FROM data_buku WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    // Menutup koneksi
    $stmt->close();
    $conn->close();


    // Periksa apakah data ditemukan
    if (!$row) {
        header("Location: error.php");
        exit();
    }
} else {
    header("Location: error.php");
    exit();
}


// Menambahkan buku ke daftar favorit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["favorit"])) {
    $username = $_SESSION['username'];


    // Membuat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);


    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }


    // Menambahkan buku ke daftar favorit pengguna
    $sql = "INSERT INTO favorit (username, id_buku) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $id_buku);
    $stmt->execute();


    // Menutup koneksi
    $stmt->close();
    $conn->close();


    header("Location: homepage.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row["judul"]); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .book img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 10px;
        }
        .book p {
            color: #666;
            text-align: justify;
            margin-top: 20px;
            line-height: 1.6;
        }
        .favorite {
            text-align: center;
            margin-top: 20px;
        }
        .favorite form {
            display: inline-block;
        }
        .favorite input[type="submit"] {
            background-color: #46de4b;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .favorite input[type="submit"]:hover {
            background-color: #3cb43c;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #46de4b;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="book">
            <h1><?php echo htmlspecialchars($row["judul"]); ?></h1>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row["sampul_buku"]); ?>" alt="Sampul Buku" width='200' height='300' >
            <p><?php echo nl2br(htmlspecialchars($row["sinopsis"])); ?></p>
            <a href="TextBuku.php?id=<?php echo $id_buku; ?>" class="back-link">Mulai Baca</a>
        </div>
        <div class="favorite">
            <h2>Tambahkan ke Favorit:</h2>
            <form method="post" action="">
                <input type="hidden" name="favorit" value="1">
                <input type="submit" value="Tambahkan ke Favorit">
            </form>
        </div>
    </div>
</body>
</html>