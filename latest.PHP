<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest</title>
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
        .latest {
            padding: 20px;
        }
        .latest h2 {
            color: #4CAF50;
        }
        .latest p {
            margin-bottom: 20px;
        }
        .latest img {
            max-width: 200px;
            height: auto;
            display: block;
            margin-bottom: 10px;
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
        <h1>Latest</h1>
    </header>
   
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="latest.php">Latest</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">History</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/halamanpenulis.php">Writing</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/RiwayatTulis.php">Writing List</a></li>
        </ul>
    </nav>
    <div class="content">
        <div class="latest">
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
       
        $sql = "SELECT id, judul, jenis_sastra, sampul_buku FROM data_buku ORDER BY id DESC LIMIT 10";
        $result = $conn->query($sql);
       
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        echo "<div class='book'>";
        echo "<h3>" . $row["judul"]. "</h3>";
        echo "<p>" . $row["jenis_sastra"]. "</p>";
        echo "<a href='tampilanbaca.php?id=" . $row["id"] . "'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($row["sampul_buku"]) . "' alt='Sampul Buku'>";
        echo "</a>";
        echo "</div>";
    }
} else {
    echo "Belum ada karya sastra terbaru.";
}
$conn->close();
?>


        </div>
    </div>
    <footer>
        <p>&copy; 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>