<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book</title>
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
            position: relative;
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


        .book form {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }


        .book input[type="submit"] {
            background-color: #ff4b4b;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }


        .book input[type="submit"]:hover {
            background-color: #e43b3b;
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
        <h1>Manage Book</h1>
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


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM data_buku WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
        }


        $sql = "SELECT id, judul, sampul_buku FROM data_buku";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            $counter = 1;
            while($row = $result->fetch_assoc()) {
                echo "<div class='book'>";
                echo "<p>" . $counter . ". " . $row["judul"] . "</p>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['sampul_buku']) . "' alt='Sampul Buku' />";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'/>";
                echo "<input type='submit' value='Hapus'/>";
                echo "</form>";
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