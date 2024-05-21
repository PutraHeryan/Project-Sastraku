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
<textarea id="text_editor" placeholder="Mulailah menulis di sini..."></textarea>
<br>
<div class="button-container">  
    <button onclick="saveText()">Selesai Menulis</button>
    <a href="http://localhost/project-sastraku/homepage.php">Kembali</a>
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