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
    $judul = $_POST["judul"];
    $jenis_sastra = $_POST["jenis_sastra"];
    $genre = implode(", ", $_POST["genre"]);
    $sinopsis = $_POST["sinopsis"];


    // Handle file upload
    $sampul_buku = '';
    if (isset($_FILES['sampul_buku']) && $_FILES['sampul_buku']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['sampul_buku']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $sampul_buku = $imgContent;
    }


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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Penulis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FEE6A8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }


        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }


        h2 {
            text-align: center;
            color: #4CAF50;
        }


        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }


        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }


        input[type="radio"] {
            margin-right: 10px;
        }


        .selected {
            background-color: #ddd;
        }


        .genre-container {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }


        .genre-container label {
            margin-right: 15px;
        }


        input[type="checkbox"] {
            margin-right: 10px;
        }


        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }


        input[type="submit"]:hover {
            background-color: #45a049;
        }


        .preview-container {
            text-align: center;
            margin-bottom: 15px;
        }


        .preview-container img {
            max-width: 100%;
            border-radius: 4px;
        }
    </style>
</head>
<body>


<div class="container">
    <h2>Halaman Penulis</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" required><br>


        <label for="sampul_buku">Sampul Buku:</label>
        <input type="file" name="sampul_buku" accept="image/*" onchange="previewImage(event)" required><br>
        <div class="preview-container">
            <img id="preview_sampul" src="" alt="Preview Sampul Buku" style="max-width: 200px;">
        </div>


        <label for="jenis_sastra">Kategori Sastra:</label>
        <input type="radio" name="jenis_sastra" value="Puisi" required>Puisi
        <input type="radio" name="jenis_sastra" value="Drama" required>Drama
        <input type="radio" name="jenis_sastra" value="Novel" required>Novel
        <input type="radio" name="jenis_sastra" value="Cerpen" required>Cerpen
        <input type="radio" name="jenis_sastra" value="Biografi" required>Biografi
        <input type="radio" name="jenis_sastra" value="Legenda" required>Legenda
        <input type="radio" name="jenis_sastra" value="Fabel" required>Fabel
        <br><br>


        <label for="genre">Genre:</label>
        <div class="genre-container">
            <input type="checkbox" id="fantasi" name="genre[]" value="Fantasi">
            <label for="fantasi"> Fantasi</label>


            <input type="checkbox" id="petualangan" name="genre[]" value="Petualangan">
            <label for="petualangan"> Petualangan</label>


            <input type="checkbox" id="romantis" name="genre[]" value="Romantis">
            <label for="romantis"> Romantis</label>


            <input type="checkbox" id="distopia" name="genre[]" value="Distopia">
            <label for="distopia"> Distopia</label>


            <input type="checkbox" id="misteri" name="genre[]" value="Misteri">
            <label for="misteri"> Misteri</label>


            <input type="checkbox" id="horor" name="genre[]" value="Horor">
            <label for="horor"> Horor</label>


            <input type="checkbox" id="thriller" name="genre[]" value="Thriller">
            <label for="thriller"> Thriller</label>


            <input type="checkbox" id="paranormal" name="genre[]" value="Paranormal">
            <label for="paranormal"> Paranormal</label>


            <input type="checkbox" id="fiksi_ilmiah" name="genre[]" value="Fiksi Ilmiah (Sci-Fi)">
            <label for="fiksi_ilmiah"> Fiksi Ilmiah (Sci-Fi)</label>
        </div>


        <label for="sinopsis">Sinopsis:</label>
        <textarea name="sinopsis" required></textarea><br><br>
       
        <input type="submit" value="Mulai Menulis!">
    </form>
</div>


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