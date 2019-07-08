<?php
session_start();

require ("../model/db.php");
require ("../model/dbFunctions.php");
require ("../model/testInput.php");

if (!empty([$_POST])) {
//input sanitation via testUserInput function
    $booktitle = !empty($_POST['BookTitle'])? testUserInput(($_POST['BookTitle'])): null;
    $originaltitle = !empty($_POST['OriginalTitle'])? testUserInput(($_POST['OriginalTitle'])): null;
    $yearofpublication = !empty($_POST['YearofPublication']) ? testUserInput(($_POST['YearofPublication'])): null;
    $genre = !empty($_POST['Genre'])? testUserInput(($_POST['Genre'])): null;
    $millionsold = !empty($_POST['MillionsSold']) ? testUserInput(($_POST['MillionsSold'])): null;
    $languagewritten = !empty($_POST['LanguageWritten']) ? testUserInput(($_POST['LanguageWritten'])): null;
    $coverimagepath= !empty($_POST['coverImagePath']) ? testUserInput(($_POST['coverImagePath'])): null;
    $name = !empty($_POST['Name'])? testUserInput(($_POST['Name'])): null;
    $surname = !empty($_POST['Surname'])? testUserInput(($_POST['Surname'])): null;
    $nationality = !empty($_POST['Nationality']) ? testUserInput(($_POST['Nationality'])): null;
    $birthyear = !empty($_POST['BirthYear'])? testUserInput(($_POST['BirthYear'])): null;
    $deathyear = !empty($_POST['DeathYear']) ? testUserInput(($_POST['DeathYear'])): null;

// getting data using session variables and post variable for update function
    $usertrack = $_SESSION["loginID"];
    $changeType = $_POST['action_type'];
    $bookId = $_POST['BookID'];
    $authorId = $_POST['AuthorID'];
    $username = $_SESSION["username"];

    try {
        if($_POST['action_type'] == 'update'){
                
                // update the book and author table and insert log in changelog table
                $querySuccess = updateBook($name, $surname, $nationality, $birthyear, $deathyear, $authorId, $booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $bookId, $usertrack, $changeType);

                if ($querySuccess == true){
                    header('location:../view/pages/displayBook.php?message=The BookID '.'<b>'.$_POST['BookID'].'</b>'.' is updated by '.'<b>'.$_SESSION["username"].'</b>'.' successfully.');
                    exit;
                }  
        } 
        // user canceled the updating process
        else {  
            header ('location:../view/pages/displayBook.php?message=Updating has been canceled.');            }
        }
    
    // something went wrong
    catch (PDOException $e) {
        echo "Updating book problems".'<br>'.$e -> getMessage();
        die();
    }
}
?>