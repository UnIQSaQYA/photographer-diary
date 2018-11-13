<?php
require_once (ROOT . 'vendor/PHPMailer/PHPMailerAutoload.php');
class Mail {

	/**
	 * This function is use to authenticate to smtp and send email
	 * @param  [type] $address [description]
	 * @param  [type] $subject [description]
	 * @param  [type] $body    [description]
	 * @param  [type] $altbody [description]
	 * @return [type]          [description]
	 */
	public static function sendMail($address, $subject, $body, $altbody = NULL) {
		$mail = new PHPMailer;
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 0;

		$mail->Username = 'uniq.saqya@gmail.com';
		$mail->Password = 'Met@llica2';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('uniqsaqya@gmail.com', 'Niklesh Shakya');
		$mail->addAddress($address);
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = $altbody;

		if(!$mail->send()) {
			return false;
		    # echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			return true;
		}
	}
}