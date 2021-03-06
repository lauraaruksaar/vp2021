<?php
    require_once("use_session.php");
	
    require_once("../../../config.php");
    require_once("fnc_gallery.php");
	require_once("fnc_general.php");
	$public_from = 2;
	
	//https://greeny.cs.tlu.ee/~lauaru/vp2021/9.%20tund/gallery_public?page=2
	$page = 1;
	$limit = 5;
	$photo_count = count_public_photos(2);
	// kontrollime mis lehel oleme ja kas selline leht on võimalik
	if(!isset($_GET["page"]) or $_GET["page"] < 1){
		$page = 1;
	} elseif(round($_GET["page"] - 1) * $limit >= $photo_count){
		$page = ceil($photo_count / $limit);
	} else {
		$page = $_GET["page"];
	}
	
	$to_head = '<link rel="stylesheet" type="text/css" href="style/gallery.css">' . "\n";
	$to_head .= '<link rel="stylesheet" type="text/css" href="style/modal.css">' . "\n";
	$to_head .= '<script src="javascript/modal.js" defer></script>' ."\n";
	require("page_header.php");
?>
	<!--Modaalaken galerripiltide jaoks-->
	<div id="modalarea" class="modalarea">
		<span id="modalclose" class="modalclose">&times;</span>
		<div class="modalhorizontal">
			<div class="modalvertical">
				<p id="modalcaption"></p>
				<img id="modalimage" src="../pics/empty.png" alt="Galeriipilt">
				<br>
				<div id="rating" class="modalRating">
				<input id="rate1" name="rating" type="radio" value="1"><label for="rate1">1</label>
				<input id="rate2" name="rating" type="radio" value="2"><label for="rate2">2</label>
				<input id="rate3" name="rating" type="radio" value="3"><label for="rate3">3</label>
				<input id="rate4" name="rating" type="radio" value="4"><label for="rate4">4</label>
				<input id="rate5" name="rating" type="radio" value="5"><label for="rate5">5</label>
				<button id="storeRating" type="button">Salvesta hinne</button>
				<br>
				<p id="avgRating"></p>
				</div>
			</div>
		</div>
	</div>
		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
		<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
		<hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
		<li><a href="home.php">Avaleht</a></li>
    </ul>
	<hr> 
    <h3>Avalike fotode galerii</h3>
	<div id="gallery" class="gallery">
	<div>
		<p>
			<?php
				//Eelmine leht | Järgmine leht
				//<span>Eelmine leht</span> | <span><a href="?page=2"> Järgmine leht</a></span>
				if($page > 1){
					echo '<span><a href="?page=' .($page - 1) .'">Eelmine leht</a></span>';
				} else {
					echo "<span>Eelmine leht</span>";
				}
				echo " | ";
				if($page * $limit < $photo_count) {
					echo '<span><a href="?page=' .($page + 1) .'">Järgmine leht</a></span>';
				} else {
					echo "<span>Järgmine leht</span>";
				}
			?>
		</p>
		<?php echo read_public_photo_thumbs($public_from, $page, $limit); ?>
	</div>
</body>
</html>