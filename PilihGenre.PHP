<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["genre"])) {
        $genre = $_POST["genre"];

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
        if(isset($_POST["genre"])) {
            $genre = implode(", ", $_POST["genre"]); // Mengubah array menjadi string

        // Query SQL untuk menyimpan data
        $sql = "UPDATE data_user SET genre='$genre' WHERE username='".$_SESSION['username']."'";

        if ($conn->query($sql) === TRUE) {
            header("Location: http://localhost/project-sastraku/Homepage.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Silahkan pilih setidaknya satu genre!";
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
        .kotak_genre{
            width: 350px;
            background: white;
            /*Meletakkan form ke tengah */
            margin : 80px auto;
            padding : 30px 20px;
        }
        .kotak_genre p {
            text-align: center;
            margin-bottom: 20px;
        }
        .kotak_genre input[type="checkbox"] {
            margin-right: 10px;
        }
        .kotak_genre label {
            cursor: pointer;
        }
        .kotak_genre input[type="submit"] {
            background-color: #46DE4B;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>GENRE BUKU</h2>
<div class="kotak_genre">
    <p>Silahkan Pilih Genre Buku Yang Anda Sukai</p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
        <input type="submit" name="submit" value="Mulai Membaca">
</div>
</form>
</body>
</html>