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

$sql = "SELECT id, judul, sampul_buku FROM data_buku WHERE penulis = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $penulis);
$stmt->execute();
$result = $stmt->get_result();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Writing List</title>
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
        .book-list {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            justify-content: space-between;
        }
        .book {
            margin: 10px;
            width: calc(33% - 20px);
            box-sizing: border-box;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: relative;
            width: 97,8%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>List Buku</h1>
    </header>
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="latest.php">Latest</a></li>
            <li><a href="search.php">Search</a></li>
            <li style="float: right;"><a href="halamanpenulis.php">Writing</a></li>
            <li style="float: right;"><a href="RiwayatTulis.php">Writing List</a></li>
        </ul>
    </nav>
    <div class="content">
       
        <div class="book-list">
            <?php
            if ($result->num_rows > 0) {
                $nomor = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="book">';
                    echo '<h3>' . $nomor . '. ' . htmlspecialchars($row['judul']) . '</h3>';
                    echo '<a href="TulisBuku.php?id=' . htmlspecialchars($row['id']) . '">';
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['sampul_buku']) . "' width='200' height='300' />";
                    echo '</a>';
                    echo '</div>';
                    $nomor++;
                }
            } else {
                echo 'Anda belum menulis buku.';
            }
            ?>
        </div>
        <a href="homepage.php">Kembali</a>
    </div>
    <footer>
        <p>© 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>