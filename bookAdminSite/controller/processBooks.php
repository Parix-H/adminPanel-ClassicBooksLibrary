<?php
	// including the css and fonts link to style the incleded html
	echo '<link href="../view/css/resCSS2.css" rel="stylesheet" type="text/css" />';
	echo '<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700" rel="stylesheet" />';


	if(!$_SESSION['login']){ 
		// include_once('index.php');
		header("location:../../index.php");
	die;
	}

	// retrieve all books' informaiton from database
	$sth = $conn->prepare('SELECT BookID, bookTitle, coverImagePath, YearofPublication ,MillionsSold, Name, Surname FROM book LEFT OUTER JOIN author ON book.AuthorID = author.AuthorID');
	$sth->execute();
	$result = $sth-> fetchAll();

	// retrive data for every book to show on display page
	foreach( $result as $book ) {
		$_SESSION["BookID"] = $book['BookID'];
?>
	<div class="vertical_container horisontal_item">
		<figure class="horizontal_item">
			<img src="<?php echo $book['coverImagePath'];'<br>' ?> "/>
			<figcaption>
				<div class = "title">
					<?php 
						echo $book['bookTitle']."".'<br>';
					?>
				</div>
				<div class="author">
					<?php
						echo $book['Name']." ".$book['Surname']."".'<br>';
					?>
				</div>
				<div class="numbers">
					<?php
						echo 'Published in: '.$book['YearofPublication']."".'<br>';
						echo 'Millions Sold: '.$book['MillionsSold'];
					?>
				</div>
				<div class="button">
					<form action="deleteBook.php" method="GET" class="display">
						<input type="hidden" name="BookID" value="<?php echo $book['BookID']; ?>">
						<input type="submit" value="Delete" id="delete_book">
					</form>
					<form action="updateBook.php" mthod="GET" class="display">
						<input type="hidden" name="BookID" value="<?php echo $book['BookID']; ?>">
						<input type=submit value=Update>
					</form>
				</div>
			</figcaption>
		</figure>
	</div>
<?php
	}	
?>
	


