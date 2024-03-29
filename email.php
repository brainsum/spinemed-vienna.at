<?php

require_once 'config.inc.php';
require_once 'vendors/recaptcha/src/autoload.php';
require 'vendors/PHPMailer/src/Exception.php';
require 'vendors/PHPMailer/src/PHPMailer.php';
require 'vendors/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

session_start();

$host = $_SERVER["HTTP_HOST"];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["betreff"]) && isset($_POST["nachricht"])){
  $mname = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $memail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $mbetreff = filter_var($_POST['betreff'], FILTER_SANITIZE_STRING);
  $mnachricht = filter_var($_POST['nachricht'], FILTER_SANITIZE_STRING);
} else {
  header("Location: http://$host$uri");
  exit();
}

$token = $_POST['token'];

// use the reCAPTCHA PHP client library for validation
$recaptcha = new \ReCaptcha\ReCaptcha(RECAPTCHA_SECRET_V3);

$resp = $recaptcha->setExpectedHostname($_SERVER['HTTP_HOST'])
  ->setExpectedAction('send_message')
  ->setScoreThreshold(0.9)
  ->verify($_POST['token'], $_SERVER['SERVER_NAME']);

// verify the response.
if ($resp->isSuccess()) {
  // Valid submission.
  $to = $memail;
  $date = date('Y');
  $subject = "Sie haben eine Nachricht von der Webseite SpineMED bekommen.";
  // Get HTML contents from file.
  $htmlContent = "Sehr geehrte Damen und Herren,<br><br>dies ist eine automatisierte Antwort. Herzlichen Dank für Ihr Interesse an SpineMED.Das healthPi Medical Center (Wollzeile 1-3, 1010 Wien, Tel: 01-997 4207) wird sich demnächst persönlich mit Ihnen in Verbindung setzen.<br><br>SpineMED ist ein in den USA entwickeltes Traktionsgerät, das für Rücken- und Wirbelsäulenbeschwerden unterschiedlicher Art eingesetzt werden kann.<br>Auch bei sehr schweren akuten und chronischen Fällen wie z.B Bandscheibenvorfälle, Hexenschuss oder Ischiasreizung werden außerordentliche Therapieerfolge erzielt.<br><br>Die Kosten einer SpineMED Behandlung betragen €95,- pro Einheit. Für ein optimales Behandlungsergebnis wird eine Serie von 10-20 Sitzungen zu je 30 min empfohlen. Viele Patienten verspüren bereits nach 10 Einheiten eine deutliche Schmerzreduktion.<br>Diese akute Phase der Therapie (ca. 10 Einheiten) sollte in einem möglichst kurzem Zeitraum innerhalb von 14 Tagen mit einer Einheit pro Tag erfolgen.<br>Im Anschluss daran empfehlen wir zumeist eine Fortführung der Therapie als Erhaltungsmassnahme (ca. 5 Einheiten) mit einer Einheit alle 2 Wochen, um das bereits erzielte gute Ergebnis zu fixieren.<br>Sollten Sie eine Zusatzversicherung haben, werden die Kosten in der Regel ganz oder zu einem Großteil übernommen. Eine Teilrückerstattung der Kosten dieser Ordinationen erfolgt jedoch auch von den gesetzlichen Krankenversicherungen. healthPi übernimmt die notwendigen Einreichungen für Sie, um Ihnen sämtliche administrativen Aufwände abzunehmen.<br><br>Die Erstuntersuchung wird vom ärztlichen Leiter Univ.-Lector Dr. Wolfgang Gruther MSc TCM, Facharzt für physikalische Medizin und allgemeine Rehabilitation, vorgenommen, der mit seinem Team einen geeigneten Gesundheitsplan für Sie erarbeitet. Bitte denken Sie daran etwaige Vorbefunde zu Ihrem Ersttermin mitzunehmen.  Bei näheren Fragen steht Ihnen das healthPi Team gerne zur Verfügung.<br><br>Mit freundlichen Grüßen,<br>Ihr SpineMED Team<br><br><hr><br><b>Name:</b><br> $mname<br><b>E-mail:</b><br><a href='mailto:$memail'>$memail</a><br><br><b>Betreff:</b><br> $mbetreff<br><br><b>Nachricht:</b><br> $mnachricht<br><br>© $date SpineMED Vienna";

  $mail = new PHPMailer();

  // Settings.
  $mail->IsSMTP();
  $mail->CharSet = 'UTF-8';

  $mail->Host       = SMTP_HOST;
  $mail->SMTPDebug  = 0;
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = SMTP_PORT;
  $mail->Username   = SMTP_USER;
  $mail->Password   = SMTP_PASS;

  // Content.
  $mail->setFrom(SITE_MAIL, 'SpineMED');
  $mail->addCC(BRAINSUM);
  $mail->addBCC(HEALTHPI_WOLFGANG);
  $mail->addBCC(HEALTHPI_CARSTEN);
  $mail->addAddress($memail);

  $mail->isHTML(TRUE);
  $mail->Subject = $subject;
  $mail->Body    = $htmlContent;
  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  if ($mail->send()) {
    $_SESSION['MSG'] = 'Vielen Dank für Ihre Anfrage, bald werden wir auf Ihre E-Mail antworten.';
  }
  else {
    $_SESSION['MSG'] = 'Leider, ist ein Fehler aufgetreten, bitte wiederholen Sie den Vorgang. Danke!';
  }
}
else {
  // Collect errors and display it.
  $errors = $resp->getErrorCodes();
  $_SESSION['MSG'] = 'Ungültige recaptcha.';
  foreach ($errors as $error) {
    print $_SESSION['MSG'] .= ' ' . $error;
  }
}

header("Location: http://$host$uri");
exit();

?>
