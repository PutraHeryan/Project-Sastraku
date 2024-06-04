<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$searchTerm = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST['search'];
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 60%;
            padding: 10px;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .book {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        .book h3 {
            margin-top: 0;
            color: #333;
        }
        .book p {
            color: #666;
        }
        .book img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
    <h1>Search</h1>
</header>
<nav>
    <ul>
        <li><a href="HomePage.php">Home</a></li>
        <li><a href="http://localhost/project-sastraku/latest.php">Latest</a></li>
        <li><a href="search.php">Search</a></li>
        <li><a href="#">History</a></li>
        <li style="float: right;"><a href="http://localhost/project-sastraku/halamanpenulis.php">Writing</a></li>
        <li style="float: right;"><a href="http://localhost/project-sastraku/RiwayatTulis.php">Writing List</a></li>
    </ul>
</nav>
<div class="container">
    <h1></h1>
    <form method="post" action="search.php">
        <input type="text" name="search" placeholder="Cari judul karya sastra" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <input type="submit" value="Cari">
    </form>


    <?php
    if ($searchTerm) {
        $sql = "SELECT id, judul, jenis_sastra, sampul_buku FROM data_buku WHERE judul LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT id, judul, jenis_sastra, sampul_buku FROM data_buku ORDER BY id DESC LIMIT 5";
    }
    $result = $conn->query($sql);


    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<h3>' . $row['judul'] . '</h3>';
            echo '<p>' . $row['jenis_sastra'] . '</p>';
            echo '<a href="tampilanbaca.php?id=' . $row['id'] . '">';
            echo "<img src='data:image/jpeg;base64," . base64_encode($row['sampul_buku']) . "' width='200' height='300' />";
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo "Tidak ada karya sastra yang ditemukan.";
    }


    $conn->close();
    ?>
</div>
</body>
</html>