<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["kategori"])) {
        $kategori = implode(", ", $_POST["kategori"]);

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project_sastraku";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "UPDATE data_user SET kategori='$kategori' WHERE username='" . $_SESSION['username'] . "'";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/project-sastraku/pilihgenre.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Silahkan pilih kategori terlebih dahulu!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kategori Sastra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: linear-gradient(to right, #FEE6A8, #F6C28B);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .kotak_kategori {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .kotak_kategori h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        .kotak_kategori p {
            color: #555;
            margin-bottom: 1.5rem;
        }
        .form-group {
            text-align: left;
            margin-bottom: 1rem;
        }
        .form-group label {
            display: inline-block;
            margin-left: 0.5rem;
            color: #555;
        }
        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
            transform: scale(1.2);
        }
        .button-next {
            background: #46DE4B;
            color: white;
            font-size: 1rem;
            width: 100%;
            border: none;
            border-radius: 5px;
            padding: 0.75rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .button-next:hover {
            background: #3cb83a;
        }
    </style>
</head>
<body>
<div class="kotak_kategori">
        <h2>KATEGORI SASTRA</h2>
        <p>Silahkan Pilih Kategori Sastra Yang Anda Sukai</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <input type="radio" id="puisi" name="kategori[]" value="Puisi">
                <label for="puisi">Puisi</label>
            </div>
            <div class="form-group">
                <input type="radio" id="drama" name="kategori[]" value="Drama">
                <label for="drama">Drama</label>
            </div>
            <div class="form-group">
                <input type="radio" id="novel" name="kategori[]" value="Novel">
                <label for="novel">Novel</label>
            </div>
            <div class="form-group">
                <input type="radio" id="cerpen" name="kategori[]" value="Cerpen">
                <label for="cerpen">Cerpen</label>
            </div>
            <div class="form-group">
                <input type="radio" id="biografi" name="kategori[]" value="Biografi">
                <label for="biografi">Biografi</label>
            </div>
            <div class="form-group">
                <input type="radio" id="legenda" name="kategori[]" value="Legenda">
                <label for="legenda">Legenda</label>
            </div>
            <div class="form-group">
                <input type="radio" id="fabel" name="kategori[]" value="Fabel">
                <label for="fabel">Fabel</label>
            </div>
            <button type="submit" class="button-next">Selanjutnya</button>
        </form>
    </div>
</body>
</html>