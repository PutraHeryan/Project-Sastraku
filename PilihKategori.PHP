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
        button.selected {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<h2>KATEGORI SASTRA</h2>
<p>Silahkan Pilih Kategori Sastra Yang Anda Sukai</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <button type="button" name="kategori[]" value="Puisi" onclick="toggleButton(this)">Puisi</button>
    <button type="button" name="kategori[]" value="Drama" onclick="toggleButton(this)">Drama</button>
    <button type="button" name="kategori[]" value="Novel" onclick="toggleButton(this)">Novel</button>
    <button type="button" name="kategori[]" value="Cerpen" onclick="toggleButton(this)">Cerpen</button>
    <button type="button" name="kategori[]" value="Biografi" onclick="toggleButton(this)">Biografi</button>
    <button type="button" name="kategori[]" value="Legenda" onclick="toggleButton(this)">Legenda</button>
    <button type="button" name="kategori[]" value="Fabel" onclick="toggleButton(this)">Fabel</button>
    <br>
    <input type="submit" name="submit" value="Selanjutnya">
</form>

<script>
    function toggleButton(button) {
        button.classList.toggle("selected");
    }
</script>

</body>
</html>