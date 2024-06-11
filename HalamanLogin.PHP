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
       
        $row = $result->fetch_assoc();
        $_SESSION["username"] = $username;
        $_SESSION["id_user"] = $row["id_user"];

        header("Location: http://localhost/project-sastraku/pilihkategori.php");
        exit;
    } else {
        echo "<div class='error'>Username atau password salah!</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
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
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 1rem;
            color: #333;
        }
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        .form-group label {
            display: inline-block;
            width: 30%;
            margin-bottom: 0.5rem;
            color: #555;
        }
        .form-group input {
            width: 100%;
            display: inline-block;
            box-sizing: border-box;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .button-login {
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
        .button-login:hover {
            background: #3cb83a;
        }
        .link {
            color: #0000FF;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-top: 1rem;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Halaman Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="button-login">Login</button>
        </form>
        <a class="link" href="http://localhost/project-sastraku/halamansignup.php">Belum punya akun? Sign-up disini</a>
    </div>
</body>
</html>