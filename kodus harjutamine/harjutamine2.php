<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>arvutamine</title>
</head>
<body>
	<form action="harjutamine2.php" method="POST">
	<input type="number" name="num1">
	<br>
	<input type="number" name="num2">
	<input type="submit">
	</form>
	Answer:<?php echo $_POST["num1"] + $_POST["num2"] ?>
</body>
</html>