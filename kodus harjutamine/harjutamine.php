<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>My first web page</title>
</head>
<body> 
	<h1>Laura veebileht</h1>	
	<hr>
	<form action="harjutamine.php" method="POST">
		Name: <input type="text" name="name">
		<br>
		Age: <input type="number" name="age">
		<input type="submit" value="Saada">
	</form>
	<br>
	Sinu nimi on <?php echo $_POST["name"] ?>
	<br>
	Sa oled <?php echo $_POST["age"] ?> aastat vana
</body>
</html>