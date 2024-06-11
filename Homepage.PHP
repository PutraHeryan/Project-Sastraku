<?php
session_start();
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project_sastraku";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_user = $_SESSION['id_user'];

$query = "SELECT kategori, genre, buku_favorit FROM data_user WHERE id_user = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$query = "SELECT id, judul, sampul_buku FROM data_buku WHERE jenis_sastra = ? AND genre = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $user['kategori'], $user['genre']);
$stmt->execute();
$books = $stmt->get_result();

$fav_books = [];
$fav_books_ordered = [];
if (!empty($user['buku_favorit'])) {
    $favorite_ids = explode(',', $user['buku_favorit']);
    $placeholders = implode(',', array_fill(0, count($favorite_ids), '?'));
    $types = str_repeat('i', count($favorite_ids));
    $query = "SELECT id, judul, sampul_buku FROM data_buku WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$favorite_ids);
    $stmt->execute();
    $fav_books_result = $stmt->get_result();
    while ($row = $fav_books_result->fetch_assoc()) {
        $fav_books[$row['id']] = $row;
    }

    foreach ($favorite_ids as $id) {
        if (isset($fav_books[$id])) {
            $fav_books_ordered[] = $fav_books[$id];
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus"])) {
    $id_buku = $_POST["id_buku"];
    $index = array_search($id_buku, $favorite_ids);
    if ($index !== false) {
        unset($favorite_ids[$index]);
        $user['buku_favorit'] = implode(',', $favorite_ids);
        $query = "UPDATE data_user SET buku_favorit = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $user['buku_favorit'], $id_user);
        $stmt->execute();
        header("Location: http://localhost/project-sastraku/Homepage.php");
        exit;
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #a0af4c;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #333;
            overflow: hidden;
        }
        nav ul li {
            float: left;
        }
        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: #111;
        }
        .content {
            padding: 20px;
            flex: 1 0 auto;
        }
        .book-list {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 10px;
        }
        .book {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex: 0 0 200px;
            text-align: center;
        }
        .book img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px auto;
            border-radius: 10px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            width: 97,8%;
        }
    </style>
</head>
<body>
    <header>
        <h1>SastraKu</h1>
    </header>
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="http://localhost/project-sastraku/latest.php">Latest</a></li>
            <li><a href="search.PHP">Search</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/halamanpenulis.php">Writing</a></li>
            <li style="float: right;"><a href="http://localhost/project-sastraku/RiwayatTulis.php">Writing List</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Selamat Datang di Beranda Kami</h1>
        <h2>Rekomendasi Buku</h2>
        <div class="book-list">
            <?php
            $nomor = 1;
            while($book = $books->fetch_assoc()): ?>
                <div class="book">
                    <h3><?php echo $nomor . '. ' . htmlspecialchars($book['judul']); ?></h3>
                    <a href="tampilanbaca.php?id=<?php echo $book['id']; ?>" style="text-decoration: none; color: inherit;">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($book['sampul_buku']); ?>" alt="Sampul Buku">
                    </a>
                </div>
            <?php $nomor++; endwhile; ?>
        </div>


        <?php if (!empty($fav_books_ordered)): ?>
            <h2>Buku Favorit Anda</h2>
            <div class="book-list">
                <?php
                $nomor = 1;
                foreach ($fav_books_ordered as $fav_book): ?>
                    <div class="book">
                        <h3><?php echo $nomor . '. ' . htmlspecialchars($fav_book['judul']); ?></h3>
                        <a href="tampilanbaca.php?id=<?php echo $fav_book['id']; ?>" style="text-decoration: none; color: inherit;">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($fav_book['sampul_buku']); ?>" alt="Sampul Buku">
                        </a>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <input type="hidden" name="id_buku" value="<?php echo $fav_book['id']; ?>">
                            <input type="submit" name="hapus" value="Hapus">
                        </form>
                    </div>
                <?php $nomor++; endforeach; ?>
            </div>
        <?php else: ?>
            <h2>Belum Menambahkan Buku Favorit</h2>
        <?php endif; ?>
    </div>
    <footer>
        <p>© 2024 SastraKu. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>