<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('v.zhevaga@gmail.com', 'site Portfolio');
	//Кому отправить
	$mail->addAddress('v.zhevaga@gmail.com');
	//Тема письма
	$mail->Subject = 'New request from portfolio site';

	//Тело письма
	$body = '<h1>Встречайте супер письмо!</h1>';

	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
	}	
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>e-mail:</strong> '.$_POST['email'].'</p>';
	}	
	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>tel:</strong> '.$_POST['tel'].'</p>';
	}	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>message:</strong> '.$_POST['message'].'</p>';
	}	
	
	/*
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Message sended!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>