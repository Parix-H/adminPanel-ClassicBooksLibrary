<header>
   <?php
       	// including the css and fonts link to style the incleded html
        echo '<link href="../css/resCSS2.css" rel="stylesheet" type="text/css" />';
        echo '<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />';
        include ("../modularPages/header.php");
    ?>
</header>
<?php
   
if(!$_SESSION['login']){ 
     header("location:../../index.php");
  die;
}

if (!empty($_GET['message'])) {
    $message = $_GET['message'];
    echo '<p class="message"> '.$message.'</p>';
}
?>

<!-- the form of adding the book and author -->
<article class="form_container">
    <form action="../../controller/pdoAdd.php"  method="POST" class="vertical_item change">
        <fieldset>
            <legend>Add A New Book</legend>
                <label>Book Title:</label>
                <input type="text" name="BookTitle" required><br><br>
                <label>Original Title:</label>
                <input type="text" name="OriginalTitle" required><br><br>
                <label>Year of Publication:</label>
                <input type="text" name="YearofPublication" required><br><br>
                <label>Genre:</label>
                <input type="text" name="Genre" required><br><br>
                <label>Millions Sold:</label>
                <input type="text" name="MillionsSold" required><br><br>
                <label>Language Written:</label>
                <input type="text" name="LanguageWritten" required><br><br>
                <label>Cover Image Path:</label>
                <input type="text" name="coverImagePath" ><br><br>
        </fieldset>
        <fieldset>
            <legend>Add A New Author</legend>
                <label>Name:</label>
                <input type="text" name="Name" required><br><br>
                <label>Surname:</label>
                <input type="text" name="Surname" required><br><br>
                <label>Nationality:</label>
                <input type="text" name="Nationality" required><br><br>
                <label>Birth Year:</label>
                <input type="text" name="BirthYear" required><br><br>
                <label>Death Year:</label>
                <input type="text" name="DeathYear" required><br><br>
        </fieldset>
                <input type="hidden" name="action_type" value="add">
                <input type="submit" value="Add">
                <input type="submit" value="Cancel" name="action_type" >
    </form>
</article>