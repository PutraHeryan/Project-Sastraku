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
            background-color: #FEE6A8;
        }
        header {
            background-color: #a0af4c;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        .kotak_login{
            width: 350px;
            background: white;
            margin : 80px auto;
            padding : 30px 20px;
        }


        .tulisan_signup{
            text-align: center;
            text-transform: uppercase;
        }


        label{
            font-size : 11pt;
        }


        .form_signup{
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            font-size: 11pt;
            margin-bottom: 15px;
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


<header>
    <h1>Halaman Sign Up</h1>
</header>


<div class="kotak_login">
    <p class="tulisan_signup">Silahkan Sign-Up</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label>Username</label>
    <br/>
    <input type="text" name="username" class="form_signup" placeholder="">
    <br><br>
    <label>Password</label>
    <br/>
    <input type="password" name="password" class="form_signup">
    <br><br>
    <label>Konfirmasi Password</label>
    <br/>
    <input type="password" name="confirm_password" class="form_signup">
    <br><br>
    <input type="submit" name="submit" value="Daftar" class="button_signup">
</form>
</div>
</body>
</html>