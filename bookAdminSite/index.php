<?php
    echo '<link href="view/css/resCSS2.css" rel="stylesheet" type="text/css" />';
    echo '<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />';
?>
<div class="mesaage">
  <?php
    if(!empty($_GET['message'])) {
      $message = $_GET['message'];
      echo $message;
    }
  ?>
</div>
<div id="login_header">
<p>Book Admin Site</p>
</div>
<article class="form_container"  id="login">
<form action="controller/pdoLogin.php" method="post" class="change">
  <fieldset>
    <legend> Admin Login</legend>
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    <label>Password:</label>
    <input type="text" name="password" required><br><br>
    <input type="submit" value="Log in">
  </fieldset>

</form>
</article>

<!-- <a href="view/pages/registration.php">Register here</a> -->