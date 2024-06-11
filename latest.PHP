<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT id, judul, jenis_sastra, genre, penulis, sampul_buku FROM data_buku ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
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
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .book {
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
            transition: box-shadow 0.3s ease;
        }
        .book:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .book img {
            max-width: 150px;
            height: auto;
            margin-right: 20px;
        }
        .book-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .book-details h3 {
            margin: 0 0 10px;
            color: #333;
        }
        .book-details p {
            margin: 5px 0 0;
            color: #666;
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
        <h1>Latest Books</h1>
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
    <div class="container">
        <h2>Karya Sastra Terbaru</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<a href="tampilanbaca.php?id=' . $row['id'] . '" style="text-decoration: none; color: inherit;">';
                echo '<div class="book">';
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['sampul_buku']) . "' alt='Sampul Buku' />";
                echo '<div class="book-details">';
                echo '<h3>' . htmlspecialchars($row['judul']) . '</h3>';
                echo '<p>Jenis Sastra : ' . htmlspecialchars($row['jenis_sastra']) . '</p>';
                echo '<p>Genre        : ' . htmlspecialchars($row['genre']) . '</p>';
                echo '<p>Penulis      : ' . htmlspecialchars($row['penulis']) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo '<p>Belum ada karya sastra yang tersedia.</p>';
        }
        ?>
    </div>
    <footer>
        <p>© 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>