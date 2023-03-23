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
<div class="container">
		<form method="post" >
			<h3>Login Form</h3>
			<label for="name2"><b>Login</b></label>
			<input name="name2" type="text" placeholder="Enter Login" required>

			<label for="password"><b>Password</b></label>
			<input name="password2" type="password" placeholder="Enter Password" required>

			<button name = "add2" type="submit">Login</button>
		</form>

		<form method="post">
			<h3>Registration Form</h3>
			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Name" name="name" required>

			<label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" name="email" required>

			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" required>

			<button name="add" type="submit">Register</button>
		</form>
	</div>
<?php 
    session_start();
    $servername ="localhost";
    $username = "root";
    $password = "";
    $dbname = "pizzeria";
    $conn =mysqli_connect($servername,$username,$password,$dbname);

    if(isset($_POST['add'])){

        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $hash = sha1($password);
        $sql = "INSERT INTO user (name,password,email) VALUES ('$name','$hash','$email')";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Invalid Email!")';  
            echo '</script>'; 
        } else {
        if (mysqli_query($conn,$sql)) {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Account created!")';  
            echo '</script>';
        } else {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Cannot create an account!")';  
            echo '</script>';  
        }
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
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Invalid Password!")';  
        echo '</script>';  
    }
    }

    mysqli_close($conn);
    
?>
</body>
</html>