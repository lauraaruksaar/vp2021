<?php
    //alustame sessiooni
    session_start();
    //kas on sisselogitud
    if(!isset($_SESSION["user_id"])){
        header("Location: page.php");
    }
    //väljalogimine
    if(isset($_GET["logout"])){
        session_destroy();
        header("Location: page.php");
    }
    
	//Testin klassi
	/* require_once("classes/Test.class.php");
	$test_object = new Test(6);
	echo "Teadaolev, avalik number: " .$test_object->known_number;
	$test_object->reveal();
	unset($test_object); */
	

    require("page_header.php");
?>
	<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
	<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
	<hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="list_films.php">Filmide nimekirja vaatamine</a> versioon 1</li>
		<li><a href="add_films.php">Filmide lisamine andmebaasi</a> versioon 1</li>
        <li><a href="user_profile.php">Kasutajaprofiil</a></li>
        <li><a href="movie_relations.php">Filmi, isiku jms seoste loomine</a></li>
        <li><a href="list_movie_info.php">Isikute ja filmide info</a></li>
        <li><a href="gallery_photo_upload.php">Galeriipiltide üleslaadimine</a></li>
        <li><a href="gallery_public.php">Sisseloginud kasutajatele nähtavate fotode galerii</a></li>
		<li><a href="gallery_own.php">Minu fotode galerii</a></li>
		
    </ul>
</body>
</html>