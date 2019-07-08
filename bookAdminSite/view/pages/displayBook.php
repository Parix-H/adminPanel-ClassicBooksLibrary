<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="../css/resCSS2.css" rel="stylesheet">
    <style>
    </style>
  </head>
  <body>

    <!-- include a modular header to every page -->
    <header>
      <?php 
        include ("../modularPages/header.php"); 
      ?>
    </header>

    <!-- including the code to dispaly every book's information -->
    <article class="flex_container">
      <?php
          include ("../../model/db.php");
          include ("../../controller/processBooks.php");
      ?>
    </article>
  </body>
</html>
