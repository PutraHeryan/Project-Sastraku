<?php
session_start();

$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "project_sastraku";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM data_admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: http://localhost/project-sastraku/HomepageAdmin.php");
        exit;
    }

    $sql = "SELECT * FROM data_user WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_unset();
        
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["id_user"] = $row["id_user"];

        if (empty($row['kategori']) || empty($row['genre'])) {
            if (empty($row['kategori'])) {
                header("Location: http://localhost/project-sastraku/pilihkategori.php");
            } else {
                header("Location: http://localhost/project-sastraku/pilihgenre.php");
            }
        } else {
            header("Location: http://localhost/project-sastraku/Homepage.php");
        }
        exit;
    } else {
        echo "Username atau password salah!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        body{
            font-family : sans-serif;
            background : #FEE6A8;
        }

        h2{
            text-align : center;
            font-weight: 700;
        }

        .kotak_login{
            width: 350px;
            background: white;
            margin : 80px auto;
            padding : 30px 20px;
        }

        .tulisan_login{
            text-align: center;
            text-transform: uppercase;
        }

        label{
            font-size : 11pt;
        }

        .form_login{
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            font-size: 11pt;
            margin-bottom: 20px;
        }

        .button_login{
            background: #46DE4B;
            color: white;
            font-size: 11pt;
            width: 100%;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
        }

        .link{
            color: #0000FF;
            text-decoration : none;
            font-size: 10pt;
        }
    </style>
</head>
<body>

<h2>Halaman Login</h2>
<div class="kotak_login">
    <p class="tulisan_login">Silahkan Login</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Username</label>
        <br/>
        <input type="text" name="username" class="form_login" placeholder="Username">
        <br></br>
        <label>Password</label>
        <br/>
        <input type="password" name="password" class="form_login" placeholder="Password">
        <br></br>
    <input type="submit" name="submit" value="Login" class="button_login">
    </form>

    <p>Belum punya akun? Silahkan daftar disini</p>
    <a class="link" href="http://localhost/project-sastraku/halamansignup.php">Sign-up</a>
</div>

</body>
</html>