<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST["id_buku"];
    $rating = $_POST["rating"];
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO ratings (id_buku, rating) VALUES ('$id_buku', '$rating')";
   
    if ($conn->query($sql) === TRUE) {
        header("Location: tampilanbaca.php?id=$id_buku");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: error.php");
    exit();
}
?>