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
	
    require_once("../../../config.php");
    require_once("fnc_photoupload.php");
	require_once("fnc_general.php");
	require_once("classes/Photoupload.class.php");
    
   
    $photo_error = null;
	$photo_upload_notice = null;
    
	
	$photo_file_name_prefix ="vp_";
	$photo_file_size_limit = 1024 * 1024;
	$allowed_photo_types = ["image/jpeg", "image/png", "image/gif"];
	
	$normal_photo_max_width = 600;
	$normal_photo_max_height = 400;
	$thumbnail_width = $thumbnail_height = 100;
	$watermark_file = "../pics/vp_logo_color_w100_overlay.png";
	
	$photo_size_ratio = 1;
	$alt_text = null;
	$privacy = 1;
	
    if(isset($_POST["photo_submit"])){
        //var_dump($_POST);
        //var_dump($_FILES);
        if(isset($_FILES["photo_input"]["tmp_name"]) and !empty($_FILES["photo_input"]["tmp_name"])){
            
			if(isset($_POST["alt_input"]) and !empty($_POST["alt_input"])){
                $alt_text = test_input(filter_var($_POST["alt_input"], FILTER_SANITIZE_STRING));
		}   
			
				//kas on privaatsus
				if(isset($_POST["privacy_input"]) and !empty($_POST["privacy_input"])){
					$privacy = filter_var($_POST["privacy_input"], FILTER_VALIDATE_INT);
				}
				if(empty($privacy)){
					$photo_error . " Privaatsus on määramata!";
				}
			
        if(empty($photo_error)){
			$photo_upload = new Photoupload($_FILES["photo_input"]);
			$photo_error .= $photo_upload->check_size($photo_file_size_limit);
			
			if(empty($photo_error)){
                    //failinime
                    $photo_upload->create_filename($photo_file_name_prefix);
                    //normaalmõõdus foto
                    $photo_upload->resize_photo($normal_photo_max_width, $normal_photo_max_height);
                    $photo_upload->add_watermark($watermark_file);
                    $photo_upload_notice = "Vähendatud pildi " .$photo_upload->save_image($photo_upload_normal_dir .$photo_upload->file_name);

                    //teen pisipildi
                    $photo_upload->resize_photo($thumbnail_width, $thumbnail_height);
                    $photo_upload_notice .= " Pisipildi " .$photo_upload->save_image($photo_upload_thumb_dir .$photo_upload->file_name);
                    //kopeerime pildi originaalkujul, originaalnimega vajalikku kataloogi
                    $photo_upload_notice .= $photo_upload->move_original_photo($photo_upload_orig_dir .$photo_upload->file_name);

                    //kirjutame andmetabelisse
                    $photo_upload_notice .= " " .store_photo_data($photo_upload->file_name, $alt_text, $privacy);
                    unset($photo_upload);
                    $alt_text = null;
                    $privacy = 1;
                }
			}
        } else {
            $photo_error = "Pildifaili pole valitud!";
        }
        
        if(empty($photo_upload_notice)){
			$photo_upload_notice = $photo_error;
		}
    }	
	
	$to_head = '<script src="javascript/fileSizeCheck.js" defer></script>' ."\n";
    
    require("page_header.php");
?>
		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<p>See leht on loodud õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
		<p>Õppetöö toimub <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate instituudis</a>.</p>
		<hr>
    <ul>
        <li><a href="?logout=1">Logi välja</a></li>
			<li><a href="home.php">Avaleht</a></li>
    </ul>
		<hr>
    <h3>Galeriipiltide üleslaadmine</h3>
	
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	
        <label for="photo_input">Vali pildifail </label> 
        <input type="file" name="photo_input" id="photo_input">
		<br>
		<label for="alt_input">Altternatiivtekst (alt):</label>
		<input type="text" name="alt_input" id="alt_input" placeholder="alternatiivtekst..." value="<?php echo $alt_text; ?>">
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_1" value="1" <?php if($privacy == 1){echo " checked";}?>>
		<label for="privacy_input_1">Privaatne (ainult mina näen)</label>
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_2" value="2" <?php if($privacy == 2){echo " checked";}?>>
		<label for="privacy_input_2">Sisseloginud kasutajatele</label>
		<br>
		<input type="radio" name="privacy_input" id="privacy_input_3" value="3" <?php if($privacy == 3){echo " checked";}?>>
		<label for="privacy_input_3">Kõik näevad</label>
		<br>
		
        <input type="submit" name="photo_submit" id="photo_submit" value="Lae pilt üles">
		<span id="notice">Vali pilt!</span>
    </form>
    <span><?php echo $photo_upload_notice; ?></span>
    
</body>
</html>