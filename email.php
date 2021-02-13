<?php
	try {
		require_once "phpmailer/class.phpmailer.php";
		$mail = new PHPMailer();
		
		$nome = $_POST['nome'];
		$assunto = $_POST['assunto'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$msg = $_POST['msg'];

		$html = file_get_contents('contatosite.html');
		$html = str_replace("#NOME#", $nome, $html);
		$html = str_replace("#ASSNT#", $assunto, $html);
		$html = str_replace("#TEL#", $tel, $html);
		$html = str_replace("#EMAIL#", $email, $html);
		$html = str_replace("#MSG#", $msg, $html);
			
		// Define os dados do servidor e tipo de conexão
		$mail->IsSMTP(); // Define que a mensagem será SMTP
		$mail->Host = "smtp.hostinger.com.br"; // Endereço do servidor SMTP
		$mail->Port = 587;
		$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
		$mail->Username = 'no-reply@martinsbarbosaadvocacia.com'; // Usuário do servidor SMTP
		$mail->Password = '8Q6|3cd#'; // Senha do servidor SMTP
		
		// Define o remetente
		$mail->From = "no-reply@martinsbarbosaadvocacia.com"; // Seu e-mail
		$mail->FromName = "Contato Site"; // Seu nome
		
		// Define os destinatário(s)
		//$mail->AddAddress('contato@martinsbarbosaadvocacia.com', '');
		$mail->AddAddress('contato@martinsbarbosaadvocacia.com', '');
		//$mail->AddAddress('ciclano@site.net');
		//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
		//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
		// Define os dados técnicos da Mensagem
		$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
		$mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
		// Define a mensagem (Texto e Assunto)
		$mail->Subject = "Contato Site"; // Assunto da mensagem
		$mail->Body = $html;
		//$mail->AltBody = $this->html;

		// Define os anexos (opcional)
		//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
		// Envia o e-mail
		$enviado = $mail->Send();

		// Limpa os destinatários e os anexos
		//$mail->ClearAllRecipients();
		//$mail->ClearAttachments();

		// Exibe uma mensagem de resultado
		if ($enviado) {
			$return = json_encode(true, JSON_PRETTY_PRINT);
		} else {
			$return = json_encode(false, JSON_PRETTY_PRINT);
		}
		
		$html2 = file_get_contents('contatoagradecimento.html');
		$html2 = str_replace("#NOME#", $nome, $html2);
		
		try {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = "smtp.hostinger.com.br";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username = 'no-reply@martinsbarbosaadvocacia.com'; //
			$mail->Password = '8Q6|3cd#';
			$mail->From = "no-reply@martinsbarbosaadvocacia.com";
			$mail->FromName = "Martins Barbosa";
			$mail->AddAddress($email, '');
			$mail->IsHTML(true);
			$mail->CharSet = 'UTF-8';
			$mail->Subject = "Contato - Martins Barbosa";
			$mail->Body = $html2;
			$enviado = $mail->Send();
		} catch (Exception $e) {
		}
		
		echo $return;
		
	} catch (Exception $e) {
		$return = json_encode(false, JSON_PRETTY_PRINT);
		echo $return;
	}
	
?>
