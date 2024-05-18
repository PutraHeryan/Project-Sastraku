<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["kategori"])) {
        $kategori = $_POST["kategori"];

        // Koneksi ke database
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project_sastraku";

        // Membuat koneksi
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        if(isset($_POST["kategori"])) {
            $kategori = implode(", ", $_POST["kategori"]); // Mengubah array menjadi string
        // Query SQL untuk menyimpan data
        $sql = "UPDATE data_user SET kategori='$kategori' WHERE username='".$_SESSION['username']."'";

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
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        h2{
            text-align: center;
            font-weight: 700;
        }
        body{
            font-family : sans-serif;
            background: #FEE6A8;
        }
        .kotak_kategori{
            width: 350px;
            background: white;
            /*Meletakkan form ke tengah */
            margin : 80px auto;
            padding : 30px 20px;
        }
        .kotak_kategori p {
        text-align: center;
        margin-bottom: 20px;
        }
        .kotak_kategori input[type="checkbox"] {
        margin-right: 10px;
        }
        .kotak_kategori label {
        cursor: pointer;
        }
        .kotak_kategori input[type="submit"] {
        background-color: #46DE4B;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        }
    </style>
</head>
<body>

<h2>KATEGORI SASTRA</h2>

<div class="kotak_kategori">
    <p>Silahkan Pilih Kategori Sastra Yang Anda Sukai</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="checkbox" id="puisi" name="kategori[]" value="Puisi">
  <label for="puisi"> Puisi</label><br>
  <input type="checkbox" id="drama" name="kategori[]" value="Drama">
  <label for="drama"> Drama</label><br>
  <input type="checkbox" id="novel" name="kategori[]" value="Novel">
  <label for="novel"> Novel</label><br>
  <input type="checkbox" id="cerpen" name="kategori[]" value="Cerpen">
  <label for="cerpen"> Cerpen</label><br>
  <input type="checkbox" id="biografi" name="kategori[]" value="Biografi">
  <label for="biografi"> Biografi</label><br>
  <input type="checkbox" id="legenda" name="kategori[]" value="Legenda">
  <label for="legenda"> Legenda</label><br>
  <input type="checkbox" id="fabel" name="kategori[]" value="Fabel">
  <label for="fabel"> Fabel</label><br>
  <input type="submit" name="submit" value="Selanjutnya">
    </form>
</div>
</body>
</html>