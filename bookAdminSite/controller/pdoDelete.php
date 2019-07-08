<?php
session_start();

require ("../model/db.php");
require ("../model/dbFunctions.php");

// get data for changelog table
$BookID = $_GET['BookID'];
$_SESSION['BookID'] = $_GET['BookID'];


    try {
        if($_GET['action_type'] == 'delete'){
            $deleteQuery = deleteBook($BookID);
            // , $usertrack, $changeType
            if ($deleteQuery == true){
                header('location:../view/pages/displayBook.php?message=The BookID '.'<b>'.$_SESSION['BookID'].'</b>'.' is deleted by '.'<b>'.$_SESSION["username"].'</b>'.' successfully.');
                // echo $bootitle.'deleted by'.$username;
                $_SESSION['BookID'] = '';
                exit;
            }  
        } 
        else { 
                header ('location:../view/pages/displayBook.php?message=Deleting has been canceled.');
        }
    }
    catch (PDOException $e) {
        echo "Deleting book problems:".'<br>'.$e -> getMessage();
        die();
    }
?>