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
    $genre = $_POST["genre"];
    $sinopsis = $_POST["sinopsis"];
    $judul = $_POST["judul"];

    $sql = "INSERT INTO data_buku (id, penulis, sampul_buku, jenis_sastra, genre, sinopsis, judul)
            VALUES ('$id_buku', '$penulis', '$sampul_buku', '$jenis_sastra', '$genre', '$sinopsis', '$judul')";

    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
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

<h2>Halaman Penulis</h2>
<form method="post">
    <label for="judul">Judul Buku:</label>
    <input type="text" name="judul"><br>
    <label for="sampul_buku">Sampul Buku:</label>
    <input type="file" name="sampul_buku" accept="image/*"><br>
    <label for="jenis_sastra">Kategori Sastra:</label>
    <input  type="radio" name="jenis_sastra" value="puisi" onclick="toggleButton(this)">Puisi
    <input  type="radio" name="jenis_sastra" value="drama" onclick="toggleButton(this)">Drama
    <input  type="radio" name="jenis_sastra" value="Novel" onclick="toggleButton(this)">Novel
    <input  type="radio" name="jenis_sastra" value="Cerpen" onclick="toggleButton(this)">Cerpen
    <input  type="radio" name="jenis_sastra" value="Biografi" onclick="toggleButton(this)">Biografi
    <input  type="radio" name="jenis_sastra" value="Legenda" onclick="toggleButton(this)">Legenda
    <input  type="radio" name="jenis_sastra" value="fabel" onclick="toggleButton(this)">fabel
    <br>
    <label for="genre">Genre:</label>
    <button type="button" name="genre" value="fantasi" onclick="toggleButton(this)">Fantasi</button>
    <button type="button" name="genre" value="petualangan" onclick="toggleButton(this)">Petualangan</button>
    <button type="button" name="genre" value="Romantis" onclick="toggleButton(this)">Romantis</button>
    <button type="button" name="genre" value="Distopia" onclick="toggleButton(this)">Distopia</button>
    <button type="button" name="genre" value="Misteri" onclick="toggleButton(this)">Misteri</button>
    <button type="button" name="genre" value="Horor" onclick="toggleButton(this)">Horor</button>
    <button type="button" name="genre" value="Thriller" onclick="toggleButton(this)">Thriller</button>
    <button type="button" name="genre" value="Paranormal" onclick="toggleButton(this)">Paranormal</button>
    <button type="button" name="genre" value="Fiksi Ilmiah (Sci-Fi)" onclick="toggleButton(this)">Fiksi Ilmiah (Sci-Fi)</button>
    <br>
    <label for="sinopsis">Sinopsis:</label>
    <textarea name="sinopsis"></textarea><br>
    <input type="submit" value="Mulai Menulis!">
</form>

<script>
    function toggleButton(button) {
        button.classList.toggle("selected");
    }
</script>

</body>
</html>