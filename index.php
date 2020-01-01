<!DOCTYPE html>
<html>
<head>
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<h1>Camagru</h1>

<?php
include "config/database.php";
try {
    $conn = new PDO("mysql:host=127.0.0.1", $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Connected successfully</p><br>";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
include 'config/setup.php';
try{
    $conn = new PDO("mysql:host=127.0.0.1", $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql =
        'use camagru;
CREATE TABLE IF NOT EXISTS Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )';

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Users created successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>
<form>
    Ім'я:<input type="text" name="name"><br>
    Прізвище:<input type="text" name="surname"><br>
    Логін:<input type="text" name="login"><br>
    Пошта:<input type="email" name="email"><br>
    Пароль:<input type="password" name="password"><br>
    Повторіть пароль:<input name="password"><br>
    <input type="submit" value="Готово"><br>
</form>

<?php
try {
    $conn = new PDO("mysql:host=127.0.0.1", $DB_USER, $DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $sql = "use camagru;
INSERT INTO Users (id, firstname, lastname) VALUES ($id, $name, $surname)";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
</body>
</html>