<nav>
    <input type="checkbox" id="hamburger_check">
    <label for="hamburger_check">&#9776;</label>
    <p class="logo">Book Admin Site</p>

    <ul class="menu">
      <li class="menuItem"><a href=displayBook.php>Display Books</a></li>
      <li class="menuItem"><a href="addBook.php">Add Books</a></li>
      <!-- check if the user is admin, display the Add User menu  -->
      <?php 
      session_start();
      
      if ($_SESSION['accessRights'] == 'admin') {
        echo '<li class="menuItem"><a href="addUser.php">Add Users</a></li>';
      }
      ?>
      <li class="menuItem"><a href="../../controller/pdoLogout.php">Log Out</a></li>
    </ul>
</nav>
<div class="message">
  <?php
    if(!empty($_GET['message'])) {
      $message = $_GET['message'];
      echo '<p class="message">'.$message.'</p>';
    }
  ?>
</div>
<!-- </body>
</html> -->