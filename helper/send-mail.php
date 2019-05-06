<?php 
require_once('../vendor/autoload.php');

$fromEmail = "info@virtuagym.com";
$to_email = trim($_POST['to']);
$subject = 'Virtuagym: Your Workout Plan Confirmation';
$mail_body = $_POST['content'];

if ($to_email == "")
    die("User Email not specified");

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername('gideonweb2019@gmail.com')
  ->setPassword('webdev2019');

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message($subject))
  ->setFrom([$fromEmail => 'Virtuagym'])
  ->setTo($to_email)
  ->setBody($mail_body, 'text/html');

// Send the message
$result = $mailer->send($message);
echo "Email sent to the recipient successfully!";
exit;
?>