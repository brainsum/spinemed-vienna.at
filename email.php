<?php
require_once 'config.inc.php';
require_once 'recaptchalib.php';
session_start();

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["betreff"]) && isset($_POST["nachricht"])){
    $reCaptcha = new ReCaptcha(RECAPTCHA_SECRET);
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );

        if ($response != null && $response->success) {
            $memail = (string) $_POST["email"];
            $mbetreff = (string) $_POST["betreff"];
            $mnachricht = (string) $_POST["nachricht"];
            $mname = (string) $_POST["name"];

            $to = $memail;
            $date = date('Y');
            $subject = "Sie haben eine Nachricht von der Webseite SpineMED bekommen.";
            // Get HTML contents from file
            $htmlContent = "Sehr geehrte Damen und Herren,<br><br>dies ist eine automatisierte Antwort. Herzlichen Dank für Ihr Interesse an SpineMED.Das healthPi Medical Center (Wollzeile 1-3, 1010 Wien, Tel: 01-997 4207) wird sich demnächst persönlich mit Ihnen in Verbindung setzen.<br><br>SpineMED ist ein in den USA entwickeltes Traktionsgerät, das für Rücken- und Wirbelsäulenbeschwerden unterschiedlicher Art eingesetzt werden kann.<br>Auch bei sehr schweren akuten und chronischen Fällen wie z.B Bandscheibenvorfälle, Hexenschuss oder Ischiasreizung werden außerordentliche Therapieerfolge erzielt.<br><br>Die Kosten einer SpineMED Behandlung betragen €90,- pro Einheit. Für ein optimales Behandlungsergebnis wird eine Serie von 10-20 Sitzungen zu je 30 min empfohlen. Viele Patienten verspüren bereits nach 10 Einheiten eine deutliche Schmerzreduktion.<br>Diese akute Phase der Therapie (ca. 10 Einheiten) sollte in einem möglichst kurzem Zeitraum innerhalb von 14 Tagen mit einer Einheit pro Tag erfolgen.<br>Im Anschluss daran empfehlen wir zumeist eine Fortführung der Therapie als Erhaltungsmassnahme (ca. 5 Einheiten) mit einer Einheit alle 2 Wochen, um das bereits erzielte gute Ergebnis zu fixieren.<br>Sollten Sie eine Zusatzversicherung haben, werden die Kosten in der Regel ganz oder zu einem Großteil übernommen. Eine Teilrückerstattung der Kosten dieser Ordinationen erfolgt jedoch auch von den gesetzlichen Krankenversicherungen. healthPi übernimmt die notwendigen Einreichungen für Sie, um Ihnen sämtliche administrativen Aufwände abzunehmen.<br><br>Die Erstuntersuchung wird vom ärztlichen Leiter Univ.-Lector Dr. Wolfgang Gruther MSc TCM, Facharzt für physikalische Medizin und allgemeine Rehabilitation, vorgenommen, der mit seinem Team einen geeigneten Gesundheitsplan für Sie erarbeitet. Bitte denken Sie daran etwaige Vorbefunde zu Ihrem Ersttermin mitzunehmen.  Bei näheren Fragen steht Ihnen das healthPi Team gerne zur Verfügung.<br><br>Mit freundlichen Grüßen,<br>Ihr SpineMED Team<br><br><hr><br><b>Name:</b><br> $mname<br><b>E-mail:</b><br><a href='mailto:$memail'>$memail</a><br><br><b>Betreff:</b><br> $mbetreff<br><br><b>Nachricht:</b><br> $mnachricht<br><br>© $date SpineMED Vienna";

            // Set content-type for sending HTML email
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

            // Additional headers
            $headers .= 'From: SpineMED <' . SITE_MAIL . ">\r\n";
            //Multiple CC can be added, if we need (comma separated);
            $headers .= 'Cc: ' . SITE_MAIL . ', ' . HEALTHPI_OFFICE . "\r\n";
            //Multiple BCC, same as CC above;
            $headers .= 'Bcc: ' . HEALTHPI_WOLFGANG . ', ' . HEALTHPI_CARSTEN . "\r\n";


          // Send email
            if (mail($to, $subject, $htmlContent, $headers)):
                $_SESSION['MSG'] = 'Vielen Dank für Ihre Anfrage, bald werden wir auf Ihre E-Mail antworten.';
            else:
                $_SESSION['MSG'] = 'Leider, ist ein Fehler aufgetreten, bitte wiederholen Sie den Vorgang. Danke!';
            endif;
        }
        else {
          $_SESSION['MSG'] = 'Ungültige recaptcha.';
        }
    }
    else {
      $_SESSION['MSG'] = 'Bitte überprüfen Sie recaptcha.';
    }
}

$host = $_SERVER["HTTP_HOST"];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

header("Location: http://$host$uri");
exit();

?>
