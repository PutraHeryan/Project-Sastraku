<!DOCTYPE html>
<html>
<head>
    <style>
        header {
            background-color: #a0af4c;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        #text_editor {
            width: 80%;
            height: 400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin-top: 30px;
            margin-left: 120px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #FEE6A8;
        }
        h1{
            text-align: center;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
    }
    </style>
</head>
<body>
<header>
    <h1>Tulis Buku</h1>
</header>
<?php
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project_sastraku";

        
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $_GET['id'];
        $sql = "SELECT isi_buku FROM data_buku WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $text = $row['isi_buku'];

        $stmt->close();
        $conn->close();
    ?>

    <form action="save_text.php" method="post">
        <textarea id="text_editor" name="text" placeholder="Mulailah menulis di sini..."><?php echo $text; ?></textarea>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" value="Selesai Menulis">
    </form>
    <a href="http://localhost/project-sastraku/homepage.php">Kembali</a>
</body>
</html>
</div>
<script>
    function saveText() {
        var writtenText = document.getElementById('text_editor').value;
        var Id = <?php echo $_GET['id']; ?>;

        alert('Teks berhasil disimpan!');
    }
</script>

</body>
</html>