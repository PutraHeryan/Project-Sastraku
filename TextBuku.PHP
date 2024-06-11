<?php
if (isset($_GET["id"])) {
    $id_buku = intval($_GET["id"]);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT isi_buku FROM data_buku WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    if (!$row) {
        header("Location: error.php");
        exit();
    }
} else {
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Buku</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content {
            padding: 20px;
            text-align: justify;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #555;
        }
        p {
            margin: 0;
            padding: 0;
        }
        .content p {
            margin-bottom: 1em;
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
        <div class="content">
            <?php echo nl2br(htmlspecialchars($row["isi_buku"])); ?>
        </div>
        <a href="tampilanbaca.php?id=<?php echo $id_buku; ?>" class="back-link">Kembali</a>
    </div>
</body>
</html>