<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

$id_user = $_SESSION['id_user'];
$query = "SELECT kategori, genre FROM data_user WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$query = "SELECT judul, sampul_buku FROM data_buku WHERE jenis_sastra = ? AND genre = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $user['kategori'], $user['genre']);
$stmt->execute();
$books = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        header {
            background-color: #a0af4c;
            color: white;
            text-align: center;
            padding: 1rem;
        }


        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #333;
            overflow: hidden;
        }


        nav ul li {
            float: left;
        }


        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }


        nav ul li a:hover {
            background-color: #111;
        }


        .content {
            padding: 20px;
        }


        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        </style>
</head>
<body>
    <header>
        <h1>SastraKu</h1>
    </header>
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="http://localhost/project-sastraku/latest.php">Latest</a></li>
            <li><a href="search.PHP">Search</a></li>
            <li><a href="#">History</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/halamanpenulis.php">Writing</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/RiwayatTulis.php">Writing List</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Selamat Datang di Beranda Kami</h1>
        <h2>Rekomendasi Buku</h2>
        <?php while($book = $books->fetch_assoc()): ?>
            <div class="book">
                <h3><?php echo $book['judul']; ?></h3>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($book['sampul_buku']); ?>" width='200' height='300' />
            </div>
        <?php endwhile; ?>
    </div>
    <footer>
        <p>© 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
