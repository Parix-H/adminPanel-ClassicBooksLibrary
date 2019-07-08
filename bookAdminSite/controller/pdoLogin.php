<?php

session_start();

require ("../model/db.php");
require ("../model/testInput.php");


if (!empty([$_POST]))
{
    $username = !empty($_POST['username'])? testUserInput(($_POST['username'])): null;
    $password = !empty($_POST['password'])? testUserInput(($_POST['password'])): null;
    try {
        // check if the username and password is in the database
        $stmt = $conn->prepare("SELECT loginID,password, accessRights FROM login WHERE username=:user");
        $stmt->bindParam(':user', $username);
        $stmt->execute();
        $rows = $stmt -> fetch();

        if (password_verify($password, $rows['password'])){
            // assign session variables
            $_SESSION["username"] = $username;
            $_SESSION["loginID"] = $rows['loginID'];
            $_SESSION["accessRights"] = $rows['accessRights'];
            $_SESSION["login"] = true;

            header('location:../view/pages/displayBook.php?message=Welcome '.'<b>'.$username.'</b>'.'! You are here as '.'<b>'.$_SESSION['accessRights'].'</b>');

        } 
        else {
            header('location:../index.php?message=Invalid username or password!');
        }
    }
    catch(PDOException $e)
    {
    echo "Account creation problems".$e -> getMessage();
    die();
    }
}
?>


