<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>site</title>
</head>
<body>
	<form action="harjutamine3.php" method="POST">
	Apples: <input type="checkbox" name="fruits[]" value="apples"><br>
	Oranges: <input type="checkbox" name="fruits[]" value="oranges"><br>
	Pears: <input type="checkbox" name="fruits[]" value="pears"><br>
	<input type="submit">
	</form>
	<?php
	$fruits = $_POST["fruits"];
	echo $fruits[1];
	?>
</body>
</html>