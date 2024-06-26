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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            flex: 1 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }


        .book {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }


        .book img {
            max-width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }


        .book p {
            margin: 5px 0;
        }


        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Book Data</h1>
    </header>
    <nav>
        <ul>
            <li><a href="HomepageAdmin.php">Home</a></li>
            <li><a href="DataBuku.PHP">Book Data</a></li>
            <li><a href="AturBuku.PHP">Manage Book</a></li>
        </ul>
    </nav>
    <div class="content">
        <?php
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project_sastraku";


        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);


        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }


        $sql = "SELECT judul, sampul_buku, jenis_sastra, genre, penulis FROM data_buku";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $counter = 1;
            while($row = $result->fetch_assoc()) {
                echo "<div class='book'>";
                echo "<p>" . $counter . ". " . $row["judul"] . "</p>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['sampul_buku']) . "' alt='Sampul Buku' />";
                echo "<p>Kategori: " . $row["jenis_sastra"] . "</p>";
                echo "<p>Genre: " . $row["genre"] . "</p>";
                echo "<p>Penulis: " . $row["penulis"] . "</p>";
                echo "</div>";
                $counter++;
            }
        } else {
            echo "Tidak ada buku yang ditemukan.";
        }


        $conn->close();
        ?>
    </div>
    <footer>
        <p>&copy; 2023 Project Sastraku. All rights reserved.</p>
    </footer>
</body>
</html>