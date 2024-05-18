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
        button.selected {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<h2>GENRE BUKU</h2>
<p>Silahkan Pilih Genre Buku Yang Anda Sukai</p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <button type="button" name="genre" value="Fantasi" onclick="toggleButton(this)">Fantasi</button>
    <button type="button" name="genre" value="Petualangan" onclick="toggleButton(this)">Petualangan</button>
    <button type="button" name="genre" value="Romantis" onclick="toggleButton(this)">Romantis</button>
    <button type="button" name="genre" value="Distopia" onclick="toggleButton(this)">Distopia</button>
    <button type="button" name="genre" value="Misteri" onclick="toggleButton(this)">Misteri</button>
    <button type="button" name="genre" value="Horor" onclick="toggleButton(this)">Horor</button>
    <button type="button" name="genre" value="Thriller" onclick="toggleButton(this)">Thriller</button>
    <button type="button" name="genre" value="Paranormal" onclick="toggleButton(this)">Paranormal</button>
    <button type="button" name="genre" value="Fiksi Ilmiah (Sci-Fi)" onclick="toggleButton(this)">Fiksi Ilmiah (Sci-Fi)</button>
    <br>
    <input type="submit" name="submit" value="Mulai Membaca">
</form>

<script>
    function toggleButton(button) {
        button.classList.toggle("selected");
    }
</script>

</body>
</html>