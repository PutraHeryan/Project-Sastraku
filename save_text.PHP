<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $text = $_POST['text'];
    $id = $_POST['id'];

    $sql = "UPDATE data_buku SET isi_buku = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $text, $id);

    if ($stmt->execute()) {
        echo "Berhasil Tersimpan";
        header("Location: http://localhost/project-sastraku/homepage.php");
    } else {
        echo "Error" . $conn->error;
    }

    $stmt->close();
    $conn->close();
?>