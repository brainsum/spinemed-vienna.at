<?php
session_start();

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["betreff"]) && isset($_POST["nachricht"])){
    $memail = (string)$_POST["email"];
    $mbetreff = (string)$_POST["betreff"];
    $mnachricht = (string)$_POST["nachricht"];
    $mname = (string)$_POST["name"];

    $to = 'spinemed.vienna@gmail.com';
    $subject = "Sie haben eine Nachricht von der Webseite SpineMED bekommen.";
    // Get HTML contents from file
    $htmlContent = "Sehr geehrter Administrator,<br><br>Sie haben eine Nachricht von der Webseite SpineMED bekommen, mit den folgenden Daten: <br><br><b>Name:</b><br> $mname<br><b>E-mail:</b><br><a href='mailto:$memail'>$memail</a><br><br><b>Betreff:</b><br> $mbetreff<br><br><b>Nachricht:</b><br> $mnachricht<br><br>© 2016 SpineMED Vienna";

    // Set content-type for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: SpineMED<spinemed.vienna@gmail.com>' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
        $_SESSION['MSG'] = 'Vielen Dank für Ihre Anfrage, bald werden wir auf Ihre E-Mail antworten.';
    else:
        $_SESSION['MSG'] = 'Leider, ist ein Fehler aufgetreten, bitte wiederholen Sie den Vorgang. Danke!';
    endif;
}

$host = $_SERVER["HTTP_HOST"];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

header("Location: http://$host$uri");
exit();

?>
