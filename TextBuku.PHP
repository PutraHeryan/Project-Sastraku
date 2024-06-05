<?php
if (isset($_GET["id"])) {
    $id_buku = $_GET["id"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT isi_buku FROM data_buku WHERE id = '$id_buku'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row["isi_buku"]. "<br>";
        }
    } else {
        echo "";
    }
    $conn->close();
}
?>
