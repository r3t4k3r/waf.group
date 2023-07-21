<?php
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

    require_once __DIR__ . '/PHPMailer/src/Exception.php';
	require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
	require_once __DIR__ . '/PHPMailer/src/SMTP.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

    function send($params) {
        global $mail;

        $config = $mail;
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'ssl://mail.smtp2go.com';
        $mail->SMTPAuth = true;
        $mail->Username = $config['email'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = 'SSL';
        $mail->Port = 465;   
		$mail->CharSet = 'UTF-8';
		$mail->Priority = 1;
			 
		$mail->setFrom($config['email'], $config['name']);
			 
		$mail->addAddress($params['email']);
			 
		$mail->Subject = $params['subject'];
			 
		$body = $params['text'];
		$mail->msgHTML($body);
			 
		return $mail->send();
    }
?>