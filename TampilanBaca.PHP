<?php
if (isset($_GET["id"])) {
    $id_buku = $_GET["id"];
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT judul, sinopsis, sampul_buku FROM data_buku WHERE id = '$id_buku'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $conn->close();
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
    <title><?php echo $row["judul"]; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .book img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            margin-top: 10px;
        }
        .book p {
            color: #666;
        }
        .rating {
            text-align: center;
            margin-top: 20px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #f5b301;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="book">
            <h1><?php echo $row["judul"]; ?></h1>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($row["sampul_buku"]); ?>" alt="Sampul Buku" width='200' height='300' >
            <p><?php echo $row["sinopsis"]; ?></p>
        </div>
        <div class="rating">
            <h2>Beri Rating:</h2>
            <form method="post" action="rating.php">
                <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                    <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>">
                    <label for="star<?php echo $i; ?>">★</label>
                <?php endfor; ?>
                <br><br>
                <input type="submit" value="Kirim">
            </form>
        </div>
    </div>
</body>
</html>