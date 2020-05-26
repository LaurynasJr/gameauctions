<?php
include($_SERVER['DOCUMENT_ROOT']. '/inc/config.php');
include($_SERVER['DOCUMENT_ROOT']. '/inc/css.php');
if(intval($_GET['id'])){
$resultss = $link -> query("SELECT * FROM `products` WHERE id='".intval($_GET['id'])."'" );
$rows = $resultss -> fetch_assoc();
$resultsss = $link -> query("SELECT * FROM `product` WHERE products='".intval($_GET['id'])."' LIMIT 1" );
$filer = $resultsss -> fetch_assoc();
$resulte = $link->query("SELECT * FROM `users` WHERE id='".$rows['users']."'");
$rowe = $resulte->fetch_assoc();
$gar = $link->query("SELECT * FROM `garant` WHERE `title`='".$rows['title']."'");
$garant = $gar->fetch_assoc();


if($rows['status'] == '1'){
	if($filer['products'] == NULL){
		mysqli_query($link, "UPDATE products SET verifu = '0' WHERE title='".$rows['title']."'");
		echo "<script>document.location.replace('/');</script>";
} 
function Space_random_string($length) { $characters = "qwertyuiopasdfghjklzxcvbnm"; srand((double)microtime()*1000000);  $random = ''; for ($i = 0; $i < $length; $i++) {  $random .= $characters[rand() % strlen($characters)];  } return $random; }
function shapeSpace_random_string($length) { $characters = "1234567890"; srand((double)microtime()*1000000); $random = ''; for ($i = 0; $i < $length; $i++) {  $random .= $characters[rand() % strlen($characters)];  } return $random; }
$token = (Space_random_string(3).shapeSpace_random_string(2).Space_random_string(1).shapeSpace_random_string(4).Space_random_string(3).shapeSpace_random_string(1).Space_random_string(1).shapeSpace_random_string(1).Space_random_string(2).shapeSpace_random_string(2).Space_random_string(1).shapeSpace_random_string(11));
$date = date("d.m.y H:i");


if(isset($_POST['buy_funk'])){
if ($user['balance'] >= $rows['price']){
$price = $rows['price'];
$sum = $price - 0.46;

$query = mysqli_query($link, "UPDATE users SET balance = (balance - '$price') WHERE login='".$_SESSION['logged_user']->login."'");

$to = $_SESSION['logged_user']->email;
	$subject = "Tarpininko perspėjimas";
  

	$message = 'Sveiki, '.$_SESSION['logged_user']->email.' <br>Jūs sumokėjote už prekę, su tarpininko paslauga, laukite laiško su tarpininko patvirtinimu.<br>Patikrinimas gali užtrukti 24 valandų.<br><br>Su pagarba,<br> '.$_SERVER['HTTP_HOST'];
	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";

	$host = $_SERVER['HTTP_HOST'];
	$headers .= "From: $host <".$settings['email_ord'].">\r\n";
	$headers .= "Cc: ".$settings['email_ord']."\r\n";
	$headers .= "Bcc: ".$settings['email_ord']."\r\n";

	mail ($to, $subject, $message, $headers);
	$date = date("d.m.y H:i");
	mysqli_query($link, "INSERT INTO garant VALUES(NULL, '".$user['login']."', '".$rowe['login']."', '".$filer['file']."', '".$rows['title']."', '$token', '$date', NULL, '".$user['email']."', '$price', '$promo')");
	
	if(!empty($_POST['atsakymas'])) {
	$atsakymas = htmlentities(mysqli_real_escape_string($link, $_POST['atsakymas']));
	mysqli_query($link, "INSERT INTO sells VALUES(NULL, '".$rows['title']."', '".$user['email']."', '".$rows['users']."', '$date', '$price', '$promo', '+$sum', 'Neįvvertinta', '$atsakymas')");
} 
	else {
	mysqli_query($link, "INSERT INTO sells VALUES(NULL, '".$rows['title']."', '".$user['email']."', '".$rows['users']."', '$date', '$price', '$promo', '+$sum', 'Neįvertinta', NULL)");
	}
	
	mysqli_query($link, "DELETE FROM `product` WHERE `file`='".$filer['file']."'");
	
if($filer['products'] == NULL){
		mysqli_query($link, "UPDATE products SET verifu = '0' WHERE title='".$rows['title']."'");
		echo "<script>document.location.replace('/');</script>";
} 
?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -178px;"><div class="sa-icon sa-error" style="display: none;"><span class="sa-x-mark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success animate" style="display: block;"><span class="sa-line sa-tip animateSuccessTip"></span><span class="sa-line sa-long animateSuccessLong"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Užsakymas sekmingai pateiktas</h2><p style="display: block;">Sėkmingai nusipirkote prekes, laukite atsakymo iš tarpininko paštu.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;"><a href="myorder">OK</a></button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php }elseif ($user['balance'] <= '0' ){?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -171px;"><div class="sa-icon sa-error animateErrorIcon" style="display: block;"><span class="sa-x-mark animateXMark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;"><span class="sa-line sa-tip"></span><span class="sa-line sa-long"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Klaida</h2><p style="display: block;">Jūs neturite pakankamai lėšų sumokėti.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php } elseif ($user['balance'] != '0' && $user['balance'] < $rows['price'] ){?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -171px;"><div class="sa-icon sa-error animateErrorIcon" style="display: block;"><span class="sa-x-mark animateXMark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;"><span class="sa-line sa-tip"></span><span class="sa-line sa-long"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Klaida</h2><p style="display: block;">Jūs neturite pakankamai lėšų sumokėti.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php } }?>

<?php 
if(isset($_POST['buy_funk2'])){
if ($user['balance'] >= $rows['price']){
$price = ($rows['price']);
$sum = $price;
	
	mysqli_query($link, "INSERT INTO garant VALUES(NULL, '".$user['login']."', '".$rowe['login']."', '".$filer['file']."', '".$rows['title']."', '$token', '$date', 'Pirkimas be tarpininko.', '".$user['email']."', '$sum', '$promo')");
	
	if(!empty($_POST['atsakymas'])) {
	$atsakymas = htmlentities(mysqli_real_escape_string($link, $_POST['atsakymas']));
	mysqli_query($link, "INSERT INTO sells VALUES(NULL, '".$rows['title']."', '".$user['email']."', '".$rows['users']."', '$date', '$price', '$promo', '+$sum', 'Neįvvertinta', '$atsakymas')");
} 
	else {
	mysqli_query($link, "INSERT INTO sells VALUES(NULL, '".$rows['title']."', '".$user['email']."', '".$rows['users']."', '$date', '$price', '$promo', '+$sum', 'Neįvertinta', NULL)");
	}
	
	mysqli_query($link, "UPDATE users SET balance = (balance - '$price') WHERE login='".$_SESSION['logged_user']->login."'");
	mysqli_query($link, "UPDATE users SET balance = (balance + '$price') WHERE id='".$rows['users']."'");
	mysqli_query($link, "UPDATE users SET pardavimai = (pardavimai + '1') WHERE id='".$rows['users']."'");
		
	
	
if($filer['products'] == NULL){
		mysqli_query($link, "UPDATE products SET verifu = '0' WHERE title='".$rows['title']."'");
		echo "<script>document.location.replace('/');</script>";
} 
	mysqli_query($link, "DELETE FROM `product` WHERE `file`='".$filer['file']."'");
	
	$to = $user['email'];
	$subject = "Prekės gavimas";
  

	$message = 'Kad gauti prekę paspauskite ant nuorodos<br>
	<a href="http://'.$_SERVER['HTTP_HOST'].'/getgood?getgood='.$token.'">Pasiimti pirkinį</a>';
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";

	$host = $_SERVER['HTTP_HOST'];
	$headers .= "From: $host <".$settings['email_ord'].">\r\n";
	$headers .= "Cc: ".$settings['email_ord']."\r\n";
	$headers .= "Bcc: ".$settings['email_ord']."\r\n";

  mail ($to, $subject, $message, $headers);
?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -178px;"><div class="sa-icon sa-error" style="display: none;"><span class="sa-x-mark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success animate" style="display: block;"><span class="sa-line sa-tip animateSuccessTip"></span><span class="sa-line sa-long animateSuccessLong"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Sėkmingai pateikta</h2><p style="display: block;">Sėkmingai nusipirkote prekes, patikrinkite paštą.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php }elseif ($user['balance'] <= '0' ){ ?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -171px;"><div class="sa-icon sa-error animateErrorIcon" style="display: block;"><span class="sa-x-mark animateXMark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;"><span class="sa-line sa-tip"></span><span class="sa-line sa-long"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Klaida</h2><p style="display: block;">Pas jus nepakanka lėšų.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php } elseif ($user['balance'] != '0' && $user['balance'] < $rows['price'] ){ ?>
<div class="sweet-overlay" tabindex="-1" style="opacity: 1.17; display: block;"></div>
<div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false" data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop" data-timer="null" style="display: block; margin-top: -171px;"><div class="sa-icon sa-error animateErrorIcon" style="display: block;"><span class="sa-x-mark animateXMark"><span class="sa-line sa-left"></span><span class="sa-line sa-right"></span></span></div><div class="sa-icon sa-warning" style="display: none;"><span class="sa-body"></span><span class="sa-dot"></span></div><div class="sa-icon sa-info" style="display: none;"></div><div class="sa-icon sa-success" style="display: none;"><span class="sa-line sa-tip"></span><span class="sa-line sa-long"></span><div class="sa-placeholder"></div><div class="sa-fix"></div></div><div class="sa-icon sa-custom" style="display: none;"></div><h2>Klaida</h2><p style="display: block;">Pas jus nepakanka lėšų.</p><fieldset><input type="text" tabindex="3" placeholder=""><div class="sa-input-error"></div></fieldset><div class="sa-error-container"><div class="icon">!</div><p>Not valid!</p></div><div class="sa-button-container"><button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button><div class="sa-confirm-button-container"><a href=""><button class="confirm" tabindex="1" style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button></a><div class="la-ball-fall"><div></div><div></div><div></div></div></div></div></div>
<?php } }?>
		<div id="page-container" class="header-navbar-fixed header-navbar-transparent">
		    <main id="main-container">
        <!-- Hero Content -->
        <section class="content content-boxed overflow-hidden main-cover">
            <div class="sell-block">
                <div class="block col-sm-8 col-sm-offset-2 table-pad">
                    <div class="block-content block-content-full bg-gray-light text-center">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <a href="/"><img style="height: 60px; margin-top: 30px;"
                                                               src="/template/images/late.jpg"></a>
                            </div>
                            <div class="col-md-5 hidden-sm hidden-xs">
                                <div>
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="<?=$rowe['avatar'];?>" alt=""/>                                        <h2 class="h4 font-w600 push-5 push-5-t"><?=$rowe['login'];?></h2>
                                        <h3 class="h6 text-gray-dark">
                                            <small>PARDAVĖJAS   <br></small>
                                        </h3>
                                                                                                            </div>
                            </div>
                            <div class="col-xs-2 hidden-sm hidden-xs" id="lock" style="padding-top: 11px;">
                            </div>
                        </div>
                    </div>
                    <div class="block-header bg-primary-dark text-center">
                        <a href="/product?product=<?=$rows['id'];?>"><h3
                                    class="text-white font-w700 h5"><?=$rows['title'];?></h3></a>
                    </div>
                    <div class="block-content">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md-6 push-10-t">
                                <p class="bg-success-light input-amount remove-margin" style="padding: 21px; font-size: 51px;"><?=$rows['price'];?> <i class="fa fa-euro" aria-hidden="true" style="font-size: 51px;"></i></p>
                                <p class="bg-danger-light h4 remove-margin" style="padding: 8px;" id="lock_second"></p>
                                <!--<p class="bg-success-light h5 remove-margin" style="padding: 9px;">Atsiskaitymų sistemos komisija: 0,00<i class="fa fa-euro" aria-hidden="true" style="font-size: 14px;"></i></p>-->
                                <p class="bg-warning-light h2 remove-margin" style="padding: 10px; border-top: 2px solid #d26a5c;" id="lock_third"></p>
                            </div>
                            <div class="col-sm-12 col-md-6 push-10-t">
                                <div class="block">
                                    <div class="block-header bg-danger-light">
                                        <ul class="block-options push-5-t" style="margin-top: 2px !important;">
                                            <li>
                                                <label class="css-input switch switch-square switch-danger">
<script>
    var garant_ok = 'yes';
    var partener_id = '';
	var price = <?=$rows['price'] + 1;?>;
	var price2 = <?=$rows['price'];?>;
    function garantbutton() {
        var checked = $("#check").is(':checked');
        if (checked) {
            garant_ok = 'yes';
		$('#lock').html('<span class="text-danger"><i class="fa fa-lock fa-5x"></i></span><br><span>PIRKINYS<br>APSAUGOTAS</span>');
		$('#lock_second').html('<i class="fa fa-lock"></i><br>Tarpininkas: 1 <i class="fa fa-euro" aria-hidden="true" style="font-size: 16px;"></i>');
		$('#lock_third').html('Suma: '+price+'  <i class="fa fa-euro" aria-hidden="true" style="font-size: 24px;"></i>');
		$('#buy').html('<form method="post"><button class="btn btn-minw btn-success" name="buy_funk" type="submit">Apmokėti iš balanso</button></form>');
		$('#buy2').html('<form action="/inc/payment/payment2.php" method="POST" class="form-inline"><input type="hidden" name="desc" value="Prekės pirkimas (<?=$rows["title"];?>)"><input type="hidden" name="file_id" value="<?=$filer["id"];?>"><input class="form-control input-lg text-center" type="hidden" name="sum" value="'+price2+'"><input type="hidden" name="author" value="<?=$rowe["id"];?>"><div class="col-sm-10 col-sm-offset-1 push-10"><input class="form-control input-lg text-center" type="text" name="email" required placeholder="Jūsų E-Mail"></div><div class="col-sm-12 text-center push-20"><button class="btn btn-minw btn-success" type="submit" name="oplata" value="1">Priėjimas prie apmokėjimo</button></div></form>');
		
        } else {
        $('#lock').html('<span class="text-danger"><i class="fa fa-unlock-alt fa-5x"></i></span><br><span>APSAUGOKITE<br>PIRKINĮ</span>');
		$('#lock_second').html('<i class="fa fa-unlock-alt"></i><br>Pirkimas be tarpininko');
		$('#lock_third').html('Suma: '+price2+'  <i class="fa fa-euro" aria-hidden="true" style="font-size: 24px;"></i>');
		$('#buy').html('<form method="post"><button class="btn btn-minw btn-success" name="buy_funk2" type="submit">Apmokėti iš balanso</button></form>');
		$('#buy2').html('<form action="/inc/payment/payment2.php" method="POST" class="form-inline"><input type="hidden" name="desc" value="Prekės pirkimas (<?=$rows["title"];?>)"><input type="hidden" name="file_id" value="<?=$filer["id"];?>"><input class="form-control input-lg text-center" type="hidden" name="sum" value="<?=$rows["price"];?>"><input type="hidden" name="author" value="<?=$rowe["id"];?>"><div class="col-sm-10 col-sm-offset-1 push-10"><input class="form-control input-lg text-center" type="text" name="email" required placeholder="Jūsų E-Mail"></div><div class="col-sm-12 text-center push-20"><button class="btn btn-minw btn-success" type="submit" name="oplata" value="2">Priėjimas prie apmokėjimo</button></div></form>');
		
	 }
    }

    $(document).ready(function () {
        $('#check').prop('checked', false);
        garantbutton();
        $("#check").change(function () {
            garantbutton();
        });
    });
</script>
<input type="checkbox" id="check" /><span></span>

                                                </label>
                                            </li>
                                        </ul>
                                        <h3 class="block-title text-left">Tarpininko paslauga<br>
                                            <small>Kaina: 1 <i class="fa fa-euro" aria-hidden="true" style="font-size: 10px;"></i></small>
                                        </h3>
                                    </div>
                                    <div class="block-content block-content-mini bg-danger-light">
                                        <p>Tarpininko paslauga - tai paslauga kuri apsaugo jus nuo apgavysčių, tarpininkas po pirkimo patikrina jūsų prekę, jei ji
                                        atitinka reikalavimus, yra tokia kaip ir buvo parašyta, jus ją gaunate, jei ne, jus gaunate pinigus atgal į balansą..</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="block">
                                    <div class="block-content block-content-full bg-warning-light text-center"
                                         style="padding: 5px;">
                                        <p class="remove-margin">
                                            <small>Dėmesio, jei pirkote be tarpininko paslaugos, būtinai filmuokite visą procesą. <br> Jei pirkote su tarpininko paslaugą,
                                            filmavimas nebūtinas.
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<center>
                        <div class="row">
<?php if ( isset ($_SESSION['logged_user']) ) : ?>
                                <div class="col-md-12">
                                    <div class="block remove-margin">
                                        <div class="block-content block-content-mini text-center">
                                            <div class="row">
<?php if($user['email'] == 'email' || $user['email'] == ''){ echo'<div style="color:red;"><b>Pirmiausia nurodykite el. Paštą</b></div><br><a href="settings">Eiti į nustatymus</a>'; }else{?>
                                                <div class="h5 font-w300">Apmokėjimas iš balanso</div>
                                                <hr>
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <p class="remove-margin">Jūsų email:<br><b><?=$user['email'];?></b></p>
                                                    </div>
                                                 <div class="col-sm-6 col-sm-offset-3 push-10">
                                                    <p>Balanse: <b><?php echo round($user['balance'], 2);?> <i class="fa fa-euro" aria-hidden="true" style="font-size: 14px;"></i></b></p>
                                                </div>
												
												<?php  
												if($rows['inputas'] == NULL){
												} else {?>
												
												<div class="col-md-12">
												<div class="h5 font-w300"><?=$rows['inputas'];?></div>
                                                <hr>
												<form method="post" >
												<input class="form-control input-lg text-center js-maxlength" type="text" name="atsakymas" required placeholder="Informacija pardavėjui" maxlength="925" data-threshold="5" data-warning-class="label label-primary" data-limit-reached-class="label label-danger" style="font-size: 18px;">
												</form>
												<hr>
												</div>
												<?php } ?>
												
												
                                                <div class="col-sm-12 text-center push-20" style="margin-top: 2px;">

                                                   <div id="buy"></div>
                                                </div>
												<?php }?>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
<?php endif; ?>
                           <!-- <div class="col-md-6">
                                <div class="block remove-margin">
                                    <div class="block-content block-content-mini text-center">
                                        <div class="h5 font-w300">Apmokėjimas per atsiskaitymų sistemas</div>
                                        <hr>
                                        <p>Įveskite savo email, pirkinio pristatymui.</p>
                                        <div class="row">
										<div id="buy2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							-->
                            <div class="col-sm-12 text-center push-10">
                                <p class="table-mar padding-line remove-margin">
                                    <small>Perkant pirkinius, Jus sutinkate su <a href="/terms">Mūsų tinklapio taisyklėmis</a>.</small>
                                </p>
                            </div>
                        </div>
						</center>
                    </div>
                    <div class="block-header bg-gray-light text-center">
                        <a href="/"><h3 class="font-w400 h6"><?=$settings['title_site']?> </a></h3>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
        <!-- END Hero Content -->
    </main>

		</div>		
	</body>
	<head>
		<title>Pirkti: <?=$rows['title'];?> - <?=$_SERVER['HTTP_HOST'];?></title>
		<meta name="Keywords" content="latestore, лэйтстор, late, store, ru, лэйт, стор, ру, торговая, площадка, цифровых, товаров, гарант, проверка, товара, digital, products, goods, garant, продажа, покупка, buy, sell, цифровые, площадки, купить, игры, стим, дешево, csgo, gta, 5, pawn, мод, аккаунты, samp, crmp, готовый, сервер, самп, проект, шаблон, сайта, скрипты, filescript, fs, Добрый день!&nbsp;Данный товар продается по оптимально низкой цене! Скидка товара 50%Подробнее об аккаунте:На данном аккаунте 12 уровень ратуши, 8 уровень деревни строителя, 200 гемов, 5 строителейНа данный товар имеется гарантия! Если вам не понравился товар вы его спокойно можете вернуть продавцу и забрать свои деньги!﻿"/>
	</head>
</html>
<?php } else { echo('<br><br><center><div style="color:red;">Prekės baigėsi, arba dar nėra pardavime!!!</div><br><br><a href="/">Grįžti į tinklapį</a></center>');};
} else { printf('<br><br><center><div style="color:red;">Tokios prekės nėra!!!</div><br><br><a href="/">Grįžti į tinklapį</a></center>'); }
?>


