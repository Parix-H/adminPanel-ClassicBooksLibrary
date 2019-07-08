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

    require ("../../model/db.php");

    // retrive a specific book information to delete
    $stms = $conn->prepare("SELECT * FROM book WHERE BookID =:bookID");
    $stms->bindParam(':bookID' , $_GET['BookID']);
    $stms->execute();
    $bookDelete = $stms->fetch();

?>
<article class="form_container">
    <form action="../../controller/pdoDelete.php" method="GET" class="change">
        <p>You are about to DELETE a book from the database.</p>
        <img src="<?php echo $bookDelete['coverImagePath'];?>"/><br>
        <?php echo '<b>'.$bookDelete['BookTitle'].'<b>';?>
        <p>Do you want to delete <?php echo '<b>'.$bookDelete['BookTitle'].'<b>'; ?>? </p>
        <input type="hidden" value="<?php echo $bookDelete['BookID'];?>" name="BookID">
        <input type="hidden" value="delete" name="action_type">
        <input type="submit" Value="Delete">
        <input type="submit" value="Cancel" name="action_type" >
    </form>
</article>