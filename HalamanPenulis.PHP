<?php
session_start();

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT MAX(id) AS max_id FROM data_buku";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1;
$id_buku = str_pad($next_id, 4, '0', STR_PAD_LEFT);

$penulis = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sampul_buku = $_POST["sampul_buku"];
    $jenis_sastra = $_POST["jenis_sastra"];
    $genre = implode(", ", $_POST["genre"]);
    $sinopsis = $_POST["sinopsis"];
    $judul = $_POST["judul"];

    $sql = "INSERT INTO data_buku (id, penulis, sampul_buku, jenis_sastra, genre, sinopsis, judul)
            VALUES ('$id_buku', '$penulis', '$sampul_buku', '$jenis_sastra', '$genre', '$sinopsis', '$judul')";

   if ($conn->query($sql) === TRUE) {
        header("Location: http://localhost/project-sastraku/TulisBuku.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Halaman Penulis</h2>
<form method="post">
    <label for="judul">Judul Buku:</label>
    <input type="text" name="judul"><br><br>
    <label for="sampul_buku">Sampul Buku:</label>
    <input type="file" name="sampul_buku" accept="image/*" onchange="previewImage(event)"><br>
    <img id="preview_sampul" src="" alt="Preview Sampul Buku" style="max-width: 200px;"><br><br>
    <label for="jenis_sastra">Kategori Sastra:</label>
    <input  type="radio" name="jenis_sastra" value="puisi" onclick="toggleButton(this)">Puisi
    <input  type="radio" name="jenis_sastra" value="drama" onclick="toggleButton(this)">Drama
    <input  type="radio" name="jenis_sastra" value="Novel" onclick="toggleButton(this)">Novel
    <input  type="radio" name="jenis_sastra" value="Cerpen" onclick="toggleButton(this)">Cerpen
    <input  type="radio" name="jenis_sastra" value="Biografi" onclick="toggleButton(this)">Biografi
    <input  type="radio" name="jenis_sastra" value="Legenda" onclick="toggleButton(this)">Legenda
    <input  type="radio" name="jenis_sastra" value="fabel" onclick="toggleButton(this)">fabel
    <br><br>
    <label for="genre">Genre:</label><br>
    <input type="checkbox" id="fantasi" name="genre[]" value="Fantasi">
    <label for="fantasi"> Fantasi</label><br>
    <input type="checkbox" id="petualangan" name="genre[]" value="Petualangan">
    <label for="petualangan"> Petualangan</label><br>
    <input type="checkbox" id="romantis" name="genre[]" value="Romantis">
    <label for="romantis"> Romantis</label><br>
    <input type="checkbox" id="distopia" name="genre[]" value="Distopia">
    <label for="distopia"> Distopia</label><br>
    <input type="checkbox" id="misteri" name="genre[]" value="Misteri">
    <label for="misteri"> Misteri</label><br>
    <input type="checkbox" id="horor" name="genre[]" value="Horor">
    <label for="horor"> Horor</label><br>
    <input type="checkbox" id="thriller" name="genre[]" value="Thriller">
    <label for="thriller"> Thriller</label><br>
    <input type="checkbox" id="paranormal" name="genre[]" value="Paranormal">
    <label for="paranormal"> Paranormal</label><br>
    <input type="checkbox" id="fiksi_ilmiah" name="genre[]" value="Fiksi Ilmiah (Sci-Fi)">
    <label for="fiksi_ilmiah"> Fiksi Ilmiah (Sci-Fi)</label><br>
    <br>
    <label for="sinopsis">Sinopsis:</label>
    <textarea name="sinopsis"></textarea><br><br>
    <input type="submit" value="Mulai Menulis!">
</form>
<script>
    function toggleButton(button) {
        button.classList.toggle("selected");
    }

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var preview = document.getElementById('preview_sampul');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>