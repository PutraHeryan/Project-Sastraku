<?php
$username = $password = $confirm_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {
        echo "Password tidak sama!";
    } else {
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "Project_Sastraku";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Data_User (username, password) VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            $new_id_user = $conn->insert_id;
            echo "Pendaftaran berhasil!";

            header("Location: http://localhost/project-sastraku/halamanlogin.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
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
        header {
            background-color: #a0af4c;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        .kotak_login{
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .kotak_login h2{
            margin-bottom: 1rem;
            color: #333;
        }

        label{
            font-size : 11pt;
        }

        .form_signup{
            margin-bottom: 1rem;
            text-align: left;
        }

        .form_signup label{
            display: inline-block;
            width: 40%;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .form_signup input{
            width: 100%;
            display: inline-block;
            box-sizing: border-box;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .button_signup{
            background: #46DE4B;
            color: white;
            font-size: 11pt;
            width: 100%;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
        }

    </style>
</head>
<body>
<div class="kotak_login">
    <h2>Silahkan Sign-Up</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form_signup">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="form_signup">
        <label>Password</label>
        <input type="password" name="password" class="form_signup" placeholder="Password" required>
    </div>
    <div class="form_signup">
        <label>Konfirmasi Password</label>
        <input type="password" name="confirm_password" class="form_signup" placeholder="Konfirmasi Password" required>
    </div>
    <input type="submit" name="submit" value="Daftar" class="button_signup">
</form>
</div>
</body>
</html>