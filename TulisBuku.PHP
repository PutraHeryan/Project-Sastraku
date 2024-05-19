<!DOCTYPE html>
<html>
<head>
    <style>
        #text_editor {
            width: 80%;
            height: 400px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h2>Tulis Buku</h2>

<textarea id="text_editor" placeholder="Mulailah menulis di sini..."></textarea>

<a href="http://localhost/project-sastraku/homepage.php">Kembali</a>

<button onclick="saveText()">Selesai Menulis</button>

<script>
    function saveText() {
        var writtenText = document.getElementById('text_editor').value;
        var Id = <?php echo $_GET['id']; ?>;

        alert('Teks berhasil disimpan!');
    }
</script>

</body>
</html>