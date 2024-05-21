<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST["id_buku"];
    $rating = $_POST["rating"];
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_sastraku";


    // Membuat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);


    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }


    // Menyimpan rating ke database
    $sql = "INSERT INTO ratings (id_buku, rating) VALUES ('$id_buku', '$rating')";
   
    if ($conn->query($sql) === TRUE) {
        header("Location: tampilanbaca.php?id=$id_buku");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // Menutup koneksi
    $conn->close();
} else {
    header("Location: error.php");
    exit();
}
?>