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

    // using session variable to get the loginID the data for the changelog function
    $usertrack = $_SESSION["loginID"];

    // using the hidden input value to get the data for changelog function
    $changeType = $_POST['action_type'];

    try {
        if($_POST['action_type'] == 'add'){

            // search the database for the entered book title
            $query= $conn->prepare("SELECT BookTitle FROM book WHERE BookTitle=:BookTitle");
            $query->bindValue(":BookTitle",$booktitle);
            $query->execute();

            // search the database for the entered author
            $queryAuthor = $conn->prepare("SELECT Surname FROM author WHERE Surname=:surname");
            $queryAuthor->bindValue(':surname' , $surname);
            $queryAuthor->execute();

            // check if the book exists, if not check the author
            if ($query->rowcount()<1) {

                // check if the author exists
                if ($queryAuthor->rowcount()<1) {
                
                // author doesn't exist,  add book and author and changelog
                $querySuccess = addAuthorBook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $name, $surname, $nationality, $birthyear, $deathyear, $usertrack, $changeType);
                
                    if ($querySuccess == true){
                        header ('location:../view/pages/displayBook.php?message=The '.'<b>'.$booktitle.'</b>'.', written by '.'<b>'.$name." ".$surname.'</b>'.' is added by '.'<b>'.$_SESSION["username"].'</b>');
                        exit;
                    }
                }  
                // if author exists, just add book
                else {
                    // retrive authorID to use as the lastAuthorID var in the funtion for book record
                    $query = $conn->prepare('SELECT AuthorID FROM author WHERE Surname = :surname');
                    $query->bindValue(':surname' , $surname);
                    $query->execute();
                    $author = $query->fetch();
                    $lastAuthorID = $author['AuthorID'];
                    $querySuccess = addBook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $usertrack, $changeType, $lastAuthorID);
                    
                    if ($querySuccess == true){
                        header ('location:../view/pages/displayBook.php?message=The '.$booktitle.'book is added by '.$_SESSION["username"].'. The name of the author already exists.');
                        exit;
                    }
                }
            } 
            // book already exist
            else { 
                header ('location:../view/pages/addBook.php?message='.$booktitle.' exists.');
            }
        } 
        // user cancelled adding book
        else { 
            header ('location:../view/pages/displayBook.php?message=Adding a book has been canceled.');
        }
    }
    catch (PDOException $e) {
        echo "Adding book problems".$e -> getMessage();
        die();
    }
}
?>