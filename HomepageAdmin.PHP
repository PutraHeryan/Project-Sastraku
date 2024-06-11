<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

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
            <li><a href="HomepageAdmin.php">Home</a></li>
            <li><a href="DataBuku.PHP">Book Data</a></li>
            <li><a href="AturBuku.PHP">Manage Book</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Selamat Datang Admin</h1>
    </div>
    <footer>
        <p>&copy; 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>