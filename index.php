<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="box">
<div id="registration-form">

    <form method="post">
        <h2>Register</h2><br>
        <input name="name" type="text" placeholder="Login"/><br>
        <input name="email" type="text" placeholder="E-mail"/><br>
        <input name="password" type="password" placeholder="Password"/><br>
        <button name = "add" type = "submit" id = "add" >Register</button>
    </form>
</div>
<div id="login-form">

    <form method="post">
            <h2>login</h2><br>
        <input name="name2" type="text" placeholder="Login"/><br>
        <input name="password2" type="password" placeholder="Password"/><br>
        <button name = "add2" type = "submit" id = "add" >Login</button>
    </form>
</div>
</div>
<?php 
    session_start();
    $servername ="localhost";
    $username = "root";
    $password = "";
    $dbname = "Pizzeria";

    $conn =mysqli_connect($servername,$username,$password,$dbname);

    if(isset($_POST['add'])){

        if(!$conn){
            echo "baza nie dziaua!";
        }

        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $hash = sha1($password);
        $sql = "INSERT INTO user (name,password,email) VALUES ('$name','$hash','$email')";
        $test = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';

        if(preg_match($test,$email)){ 
            if(mysqli_query($conn, $sql)){
                echo "Zarejestrowano!";
            }
        }else{
            echo 'Adres e-mail nieprawidłowy';
        }
    }
        if (isset($_POST['add2'])){
            $username2 = $_POST['name2'];
            $password2 = $_POST['password2'];
            $hash2 = sha1($password2);
            $query = "SELECT * FROM user WHERE name='$username2' and password='$hash2'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
        if ($count==1 ){
            $_SESSION['username']= $username2;
            header('Location: main.php');
        }
        else {
            echo "Złe haslo!";
        }
        }
    
?>
</body>
</html>