<header>
   <?php
       	// including the css and fonts link to style the incleded html
        echo '<link href="../css/resCSS2.css" rel="stylesheet" type="text/css" />';
        echo '<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />';
        
        include ("../modularPages/header.php");
    ?>
</header>

<?php

// check if the user is logged in, else redirect to the loging page
if(!$_SESSION['login']){ 
     header("location:../../index.php");
  die;
}

// show the message, if there is one
if (!empty($_GET['message'])) {
    $message = $_GET['message'];
    echo '<p class="message"> '.$message.'</p>';
}

require ("../../model/db.php");

// retrieve data of the specific book from "book" table
$stmt = $conn->prepare("SELECT * FROM book WHERE BookID = :BookID");
$stmt->bindParam(':BookID' , $_GET['BookID']);
$stmt->execute();
$editBook = $stmt->fetch();

// retreive data from "author" table
$stmt = $conn->prepare("SELECT * FROM author WHERE AuthorID = :AuthorID");
$stmt->bindParam(':AuthorID', $editBook['AuthorID']);
$stmt->execute();
$editAuthor = $stmt->fetch();
?>
<article class="form_container">
    <form action="../../controller/pdoUpdate.php"  method="POST" class="change">
        <fieldset>
        <legend>Update Book ID: <?Php echo "".'<b>'.$_GET['BookID'].'</b>'."".'<br>';?></legend>
            <label>Book Title:</label>
            <input type="text" name="BookTitle" value="<?php echo $editBook['BookTitle']; ?>" required><br><br>

            <label>Original Title:</label>
            <input type="text" name="OriginalTitle" value="<?php echo $editBook['OriginalTitle']; ?>" required><br><br>

            <label>Year of Publication:</label>
            <input type="text" name="YearofPublication" value="<?php echo $editBook['YearofPublication']; ?>"  required><br><br>

            <label>Genre:</label>
            <input type="text" name="Genre" value="<?php echo $editBook['Genre']; ?>"  required><br><br>

            <label>Millions Sold:</label>
            <input type="text" name="MillionsSold" value="<?php echo $editBook['MillionsSold']; ?>"  required><br><br>

            <label>Language Written:</label>
            <input type="text" name="LanguageWritten" value="<?php echo $editBook['LanguageWritten']; ?>"  required><br><br>

            <label>Cover Image Path:</label>
            <input type="text" name="coverImagePath" value="<?php echo $editBook['coverImagePath']; ?>"  required><br><br>
            <input type="text" name="BookID" value="<?php echo $editBook['BookID']; ?>">
        </fieldset>
        <fieldset>
        <legend>Update Author ID: <?php echo "".'<b>'.$editBook['AuthorID'].'<b>'; ?></legend>
            <label>Name:</label>
            <input type="text" name="Name" value="<?php echo $editAuthor['Name']; ?>" required><br><br>

            <label>Surname:</label>
            <input type="text" name="Surname" value="<?php echo $editAuthor['Surname']; ?>" required><br><br>

            <label>Nationality:</label>
            <input type="text" name="Nationality" value="<?php echo $editAuthor['Nationality']; ?>" required><br><br>

            <label>Birth Year:</label>
            <input type="text" name="BirthYear" value="<?php echo $editAuthor['BirthYear']; ?>" required><br><br>

            <label>Death Year:</label>
            <input type="text" name="DeathYear" value="<?php echo $editAuthor['DeathYear']; ?>" ><br><br>

            <input type="text" name="AuthorID" value="<?php echo $editBook['AuthorID']; ?>">
        </fieldset>
            <input type="hidden" name="action_type" value="update">
            <input type="submit" value="Update">
            <input type="submit" value="Cancel" name="action_type" >
    </form>
</article>
