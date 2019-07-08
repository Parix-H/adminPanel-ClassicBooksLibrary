<header>
    <?php
    	// including the css and fonts link to style the incleded html
        echo '<link href="../css/resCSS2.css" rel="stylesheet" type="text/css" />';
        echo '<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />';

        include ("../modularPages/header.php");
    ?>
</header>
<?php
// session_start();

if(!$_SESSION['login']){ 
     header("location:../../index.php");
  die;
}

if (!empty($_GET['message'])) {
    $message = $_GET['message'];
    echo '<p class="message"> '.$message.'</p>';
}
?>
<article class="form_container">
    <form action="../../controller/pdoReg.php"  method="post"  class="change">
        <fieldset>
            <legend>Add User</legend>
                <label>Username:</label>
                <input type="text" name=username required><br><br>
                <label>Password:</label>
                <input type="text" name=password required><br><br>
                <label>First Name:</label>
                <input type="text" name=firstName required><br><br>
                <label>Last Name:</label>
                <input type="text" name=lastName required><br><br>
                <label>Email:</label>
                <input type="text" name=email required><br><br>
                <label>Role:</label>
                <input type="text" name=accessRights required><br><br>
                <input type="hidden" name="action_type" value="addUser">
                <input type="submit">
        </fieldset>
    </form>
</article>