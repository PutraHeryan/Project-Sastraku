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
        <h1>Writing List</h1>
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
    <footer>
        <p>&copy; 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>

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