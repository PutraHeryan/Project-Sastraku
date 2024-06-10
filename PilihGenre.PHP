<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["genre"])) {
        $genre = implode(", ", $_POST["genre"]);

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project_sastraku";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }
        if(isset($_POST["genre"])) {
            $genre = implode(", ", $_POST["genre"]);

        $sql = "UPDATE data_user SET genre='$genre' WHERE username='" . $_SESSION['username'] . "'";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Genre Buku</title>
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
        .kotak_genre {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .kotak_genre h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        .kotak_genre p {
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
    <div class="kotak_genre">
        <h2>GENRE BUKU</h2>
        <p>Silahkan Pilih Genre Buku Yang Anda Sukai</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <input type="checkbox" id="fantasi" name="genre[]" value="Fantasi">
                <label for="fantasi">Fantasi</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="petualangan" name="genre[]" value="Petualangan">
                <label for="petualangan">Petualangan</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="romantis" name="genre[]" value="Romantis">
                <label for="romantis">Romantis</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="distopia" name="genre[]" value="Distopia">
                <label for="distopia">Distopia</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="misteri" name="genre[]" value="Misteri">
                <label for="misteri">Misteri</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="horor" name="genre[]" value="Horor">
                <label for="horor">Horor</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="thriller" name="genre[]" value="Thriller">
                <label for="thriller">Thriller</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="paranormal" name="genre[]" value="Paranormal">
                <label for="paranormal">Paranormal</label>
            </div>
            <div class="form-group">
                <input type="checkbox" id="fiksi_ilmiah" name="genre[]" value="Fiksi Ilmiah (Sci-Fi)">
                <label for="fiksi_ilmiah">Fiksi Ilmiah (Sci-Fi)</label>
            </div>
            <button type="submit" class="button-next">Mulai Membaca</button>
        </form>
    </div>
</body>
</html>