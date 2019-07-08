<?php
    // add user function 
    function addUser($username, $password, $email, $firstname, $lastname, $accessRights){
        global $conn;
        try {
            $conn->beginTransaction();

            // insert login's data in login table as a parent table for user table
            $stmt = $conn->prepare("INSERT INTO login(username, password, accessRights) VALUES (:username, :password, :accessRights)");
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':accessRights', $accessRights);
            $stmt->execute();

            // last insertd = loginID
            $lastLoginID = $conn->lastInsertID();
            
            // insert user's information in user table 
            $stmt = $conn->prepare("INSERT INTO users(firstName, lastName, email, loginID ) VALUES (:firstName, :lastName, :email, :loginID)");
            $stmt->bindValue(':firstName', $firstname);
            $stmt->bindValue(':lastName', $lastname);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':loginID', $lastLoginID);
            $stmt->execute();
            $conn->commit();
            return true;
        }

        //if something goes wrong roll back
        catch(PDOException $ex){
            $conn->rollback();
            throw $ex;
        }
    }

    // add author, book and changelog at the same time 
    function addAuthorBook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $name, $surname, $nationality, $birthyear, $deathyear, $usertrack, $changeType){
        global $conn;
        try {
            $conn->beginTransaction();

            // add author to the Author table
            $stmt = $conn->prepare("INSERT INTO author(Name, Surname, Nationality, BirthYear, DeathYear) VALUES (:Name, :Surname, :Nationality, :BirthYear, :DeathYear)");
            $stmt->bindValue(':Name', $name);
            $stmt->bindValue(':Surname', $surname);
            $stmt->bindValue(':Nationality', $nationality);
            $stmt->bindValue(':BirthYear', $birthyear);
            $stmt->bindValue(':DeathYear', $deathyear);
            $stmt->execute();            
            // last insertid = loginID
            $lastAuthorID = $conn->lastInsertID();

            // add book to the book tab
            $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, coverImagePath, AuthorID) VALUES (:BookTitle, :OriginalTitle, :YearofPublication, :Genre, :MillionsSold, :LanguageWritten, :CoverImagePath, :AuthorID)");
            $stmt->bindValue(':BookTitle', $booktitle);
            $stmt->bindValue(':OriginalTitle', $originaltitle);
            $stmt->bindValue(':YearofPublication', $yearofpublication);
            $stmt->bindValue(':Genre', $genre);
            $stmt->bindValue(':MillionsSold', $millionsold);
            $stmt->bindValue(':LanguageWritten', $languagewritten);
            $stmt->bindValue(':CoverImagePath', $coverimagepath);
            $stmt->bindValue(':AuthorID', $lastAuthorID);
            $stmt->execute();
            // last insertd = BookID
            $lastBookID = $conn->lastInsertID();

            // add a log to the changelog table
            $datecreate = date('d-m-y');
            $datechange = date('d-m-y');
            $stmt = $conn->prepare("INSERT INTO changelog(dateChanged, dateCreated, BookID, userID, changeType) VALUES (:dateChanged, :dateCreated, :BookID, :userID, :changeType)");
            $stmt->bindParam(':dateChanged', $datechange);
            $stmt->bindParam(':dateCreated', $datecreate);
            $stmt->bindParam(':BookID', $lastBookID);
            $stmt->bindParam(':userID', $usertrack);
            $stmt->bindParam(':changeType', $changeType);
            $stmt->execute();
            $conn->commit();
            return true;
        }

        //something goes wrong roll back
        catch(PDOException $ex){
            $conn->rollback();
            throw $ex;
            return false;
        }
    }

    // add book and changelog at the same time 
    function addBook($booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $usertrack, $changeType, $lastAuthorID){
        global $conn;
        try {
            $conn->beginTransaction();

            // add book to the book tab
            $stmt = $conn->prepare("INSERT INTO book(BookTitle, OriginalTitle, YearofPublication, Genre, MillionsSold, LanguageWritten, coverImagePath, AuthorID) VALUES (:BookTitle, :OriginalTitle, :YearofPublication, :Genre, :MillionsSold, :LanguageWritten, :CoverImagePath, :AuthorID)");
            $stmt->bindValue(':BookTitle', $booktitle);
            $stmt->bindValue(':OriginalTitle', $originaltitle);
            $stmt->bindValue(':YearofPublication', $yearofpublication);
            $stmt->bindValue(':Genre', $genre);
            $stmt->bindValue(':MillionsSold', $millionsold);
            $stmt->bindValue(':LanguageWritten', $languagewritten);
            $stmt->bindValue(':CoverImagePath', $coverimagepath);
            $stmt->bindValue(':AuthorID', $lastAuthorID);
            $stmt->execute();
            // last insertid = BookID
            $lastBookID = $conn->lastInsertID();

            // add a log to the changelog table
            $datecreate = date('d-m-y');
            $datechange = date('d-m-y');
            $stmt = $conn->prepare("INSERT INTO changelog(dateChanged, dateCreated, BookID, userID, changeType) VALUES (:dateChanged, :dateCreated, :BookID, :userID, :changeType)");
            $stmt->bindParam(':dateChanged', $datechange);
            $stmt->bindParam(':dateCreated', $datecreate);
            $stmt->bindParam(':BookID', $lastBookID);
            $stmt->bindParam(':userID', $usertrack);
            $stmt->bindParam(':changeType', $changeType);
            $stmt->execute();
            $conn->commit();
            return true;
        }

        //something goes wrong roll back
        catch(PDOException $ex){
            $conn->rollback();
            throw $ex;
            return false;
        }
    }


    // update author, book and insert changelog at the same time 
    function updateBook($name, $surname, $nationality, $birthyear, $deathyear, $authorId, $booktitle, $originaltitle, $yearofpublication, $genre, $millionsold, $languagewritten, $coverimagepath, $bookId, $usertrack, $changeType){

        global $conn;
        try {
            $conn->beginTransaction();

            // update the author
            $stmt = $conn->prepare("UPDATE author SET Name = :Name, Surname = :Surname, Nationality = :Nationality, BirthYear = :BirthYear, DeathYear = :DeathYear WHERE AuthorID = :authorId");
            $stmt->bindValue(':Name', $name);
            $stmt->bindValue(':Surname', $surname);
            $stmt->bindValue(':Nationality', $nationality);
            $stmt->bindValue(':BirthYear', $birthyear);
            $stmt->bindValue(':DeathYear', $deathyear);
            $stmt->bindParam(':authorId', $authorId);
            $stmt->execute();

            // update the book
            $stmt = $conn->prepare("UPDATE book SET BookTitle = :BookTitle, OriginalTitle = :OriginalTitle, YearofPublication = :YearofPublication, Genre = :Genre, MillionsSold = :MillionsSold, LanguageWritten = :LanguageWritten, coverImagePath = :coverImagePath WHERE BookID = :BookID");
            $stmt->bindValue(':BookTitle', $booktitle);
            $stmt->bindValue(':OriginalTitle', $originaltitle);
            $stmt->bindValue(':YearofPublication', $yearofpublication);
            $stmt->bindValue(':Genre', $genre);
            $stmt->bindValue(':MillionsSold', $millionsold);
            $stmt->bindValue(':LanguageWritten', $languagewritten);
            $stmt->bindValue(':coverImagePath', $coverimagepath);
            $stmt->bindParam(':BookID' , $bookId);
            $stmt->execute();
            
            // add a log to the changelog table
            $datechange = date('d-m-y');
            $datecreate = date('d-m-y');
            $stmt = $conn->prepare("INSERT INTO changelog(dateChanged, dateCreated, BookID, userID, changeType) VALUES (:dateChanged, :dateCreated, :BookID, :userID, :changeType)");
            $stmt->bindParam(':dateChanged', $datechange);
            $stmt->bindParam(':dateCreated', $datecreate);
            $stmt->bindParam(':BookID', $bookId);
            $stmt->bindParam(':userID', $usertrack);
            $stmt->bindParam(':changeType', $changeType);
            $stmt->execute();
            $conn->commit();
            return true;  
        }

        //something goes wrong roll back
        catch(PDOException $ex){
            $conn->rollback();
            throw $ex;
            return false;
        }
    }

    // delete book from database
    function deleteBook($BookID) {
        global $conn;
        try {
            $stmt = $conn->prepare('DELETE FROM book WHERE BookID = :BookID');
            $stmt->bindValue(':BookID' , $BookID);
            $stmt->execute();
            return true;
        }
         
        //something goes wrong
        catch (PDOException $e) {
        echo 'Deleting function problem'.$e -> getMessage();
        die();
        }
    }

?>