<?php
if(isset($_POST['submitted'])) {
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = true; //erro especifico do campo
			$hasError = true; //tem erro no form logo não envia
		} else {
			$name = trim($_POST['contactName']);
		}

		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = true;
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = true;
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}

		//Check to make sure comments were entered
		if(trim($_POST['comments']) === '') {
			$commentError = true;
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}

		//
		if(trim($_POST['assunto']) === '') {
			$assuntoError = true;
			$hasError = true;
		} else {
			$assunto = trim($_POST['assunto']);
		}


		//If there is no error, send the email
		if(!isset($hasError)) {
get_template_part('library/phpmailer/PHPMailerAutoload');
$mail   = new PHPMailer();
$mail->IsSendmail();
// $mail->IsQmail();
$email = trim($_POST['email']);
$social = trim($_POST['social']);
$body   = 'Name: '. $name . '<br />Email: ' . $email . '<p>Subject: ' . $assunto. '</p><p>Comment: '. $comments;
$mail->SetFrom($email , $name);
$mail->AddReplyTo($email, $name);
$address = get_option('admin_email');
$mail->AddAddress($address, "Fabrix");
$mail->Subject    = "[WP Mobile Edition]~" .$assunto;
$mail->MsgHTML($body);
if(!$mail->Send()) {
  $emailSent = false;
} else {
  $emailSent = true;
}

		}



}

          $assunto_email = "";
          if(isset($_GET['id'])) {
          $assunto_email = $_GET['id'];
          }
//-----------------
get_header(); ?>
<div class="fdx_topheading"><?php _e('Contact', 'wp-mobile-edition') ?></div>
<div class="fdx_content" style="padding: 10px">
<?php if(isset($emailSent) && $emailSent == true) { ?>

	<div style="text-align: center">
		<h1><?php _e('Thanks', 'wp-mobile-edition') ?>, <a><?=$name;?></a></h1>
		<p><?php _e('Your message has been sent successfully', 'wp-mobile-edition') ?>!</p>
	</div>

<?php } elseif(isset($emailSent) && $emailSent == false) { ?>
<p><h2>PHPMailer Error: <a href="#"><?php  echo $mail->ErrorInfo;  ?></a>   </h2>   </p>
<?php } else { ?>

<!-- ====================================== -->


<form action="<?php the_permalink(); ?>" id="contactForm" method="post">

<div class="input-group">
<span class="input-group-addon">&rarr;</span><input class="form-control" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" type="text" <?php global $nameError; if($nameError != '') { ?>style="border: 1px solid #DD0000;"<?php } ?> placeholder="Name">
</div>
<br>
<div class="input-group">
<span class="input-group-addon">&rarr;</span><input class="form-control" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" <?php global $emailError; if($emailError != '') { ?>style="border: 1px solid #DD0000;"<?php } ?> placeholder="E-mail">
</div>

<br>
<div class="input-group">
<span class="input-group-addon">&rarr;</span><input class="form-control" name="assunto" id="assunto" value="<?php if(isset($_POST['assunto'])) echo $_POST['assunto'];?><?php echo $assunto_email;?>" <?php global $assuntoError; if($assuntoError != '') { ?>style="border: 1px solid #DD0000;"<?php } ?> placeholder="Subject">
</div>

<br>
<textarea name="comments" id="commentsText" class="form-control" rows="3" <?php global $commentError; if($commentError != '') { ?>style="border: 1px solid #DD0000;"<?php } ?> placeholder="Message"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
<input type="hidden" name="submitted" id="submitted" value="true" />
<div style="text-align: center; margin-top: 10px"><button type="submit" name="submit" id="submit" style="padding: 5px"><?php _e('Send message', 'wp-mobile-edition') ?></button></div>

</form>


<!-- ====================================== -->
<?php } ?>
 </div>
<?php get_footer(); ?>