<?php
	require_once("../../config.php");
	require_once("fnc_films.php");
	//echo $server_host;
	$author_name = "Laura Aruksaar";
	$film_store_notice = null;
	$title_input = null;
	$title_input_error = null;
	$genre_input = null;
	$genre_input_error = null;
	$studio_input = null;
	$studio_input_error = null;
	$director_input = null;
	$director_input_error = null;
	$year_input = null;
	$year_input_error = null;
	$duration_input = null;
	$duration_input_error = null;
	
	if(isset($_POST["film_submit"])){
			if(!empty($_POST["title_input"])){
				$title_input = $_POST["title_input"];
			} else {
				$title_input_error = "Sisesta filmi pealkrir.";
			}
			if (!empty($_POST["year_input"])){
				$year_input = $_POST["year_input"];
			} else {
				$year_input_error = "Sisesta filmi pealkiri.";
			}
			if(!empty($_POST["duration_input"])){
				$year_input = $_POST["duration_input"];
			} else {
				$year_input_error = "Sisesta filmi kestus";
			}
			if(!empty($_POST["genre_input"])){
				$genre_input = $_POST["genre_input"];
			} else {
				$genre_input_error = "Sisesta filmi zanr.";
			}
			if(!empty($_POST["studio_input"])){
				$studio_input = $_POST["studio_input"];
			} else {
				$studio_input_error = "Sisesta filmistuudio.";
			}
			if(!empty($_POST["director_input"])){
				$director_input = $_POST["director_input"];
			} else {
				$director_input_error = "Sisesta filmi rezissöör.";
			}
			if(empty($title_input_error) and empty($year_input_error) and empty($duration_input_error) and empty($genre_input_error) and empty($studio_input_error) and empty($director_input_error)){
			
			
			$film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
		}else{
			$film_store_notice = "Osa andmeid on puudu!";
		}
		}
	
	
	
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title><?php echo $author_name; ?>,veebiprogrammeerimine</title>
</head>
<body>
	<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="http://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
	<h2>Eesti filmide lisamine</h2>
	<form method="POST">
        <label for="title_input">Filmi pealkiri</label>
        <input type="text" name="title_input" id="title_input" placeholder="filmi pealkiri">
        <br>
        <label for="year_input">Valmimisaasta</label>
        <input type="number" name="year_input" id="year_input" min="1912" value="<?php echo date("Y");?>">
        <br>
        <label for="duration_input">Kestus</label>
        <input type="number" name="duration_input" id="duration_input" min="1" value="60" max="600">
        <br>
        <label for="genre_input">Filmi žanr</label>
        <input type="text" name="genre_input" id="genre_input" placeholder="žanr">
        <br>
        <label for="studio_input">Filmi tootja</label>
        <input type="text" name="studio_input" id="studio_input" placeholder="filmi tootja">
        <br>
        <label for="director_input">Filmi režissöör</label>
        <input type="text" name="director_input" id="director_input" placeholder="filmi režissöör">
        <br>
        <input type="submit" name="film_submit" value="Salvesta">
    </form>
    <span><?php echo $film_store_notice; ?></span>

</body>
</html>