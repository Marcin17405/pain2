<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<?php
    session_start();
        if (isset($_SESSION['username'])){
    $username2 = $_SESSION['username'];
 }
 else {
    header('Location: index.php');
 }
?>
<div id="forms">
<h2>Wprowadz swoje dane</h2>
<form method="post">
        <input type="text" name="name" id="Name" placeholder="Name">
        <input type="text" name="email" id="email" placeholder="E-mail">
        <input type="text" name="password" id="Password" placeholder="Password">
        <button type="submit" name="add_userdata">Ustaw</button>
</form>

<br>
    <?php 



    $servername ="localhost";
    $username = "root";
    $password = "";
    $dbname = "Pizzeria";
    $conn =mysqli_connect($servername,$username,$password,$dbname);

    if(isset($_POST['add_userdata'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE user SET name = '$name', email = '$email', password = '$password' WHERE name = '$username2'";
        if(mysqli_query($conn, $sql)){  
            echo "Dodano! <br>";   
        }else{
            echo "Nie Dodano! <br>";
        }
    }
    $sql = "SELECT * FROM Products";
    $result = mysqli_query($conn, $sql);
    echo "<div><table><thead><tr><th>Name</th><th>Price</th><th>Description</th></tr></thead><tbody>";
    while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>" . $row["name"] . "</td>
    <td>" . $row["price"] . "zł" ."</td>
    <td>" . $row["description"] ."</td>
        </tr>";
    }
    echo "</tbody></table></div><br>";
 ?> 
<button>Capriciosa</button>
<button>Gyros</button>
<button>Margharita</button>
<button>Hawaii</button>

</div>
 
 
 
 
 
 
 
 <a href="logout.php" id="log">Logout</a>
</body>
</html>