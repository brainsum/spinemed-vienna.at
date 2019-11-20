<?php
if (((empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") && preg_match("/med-rent.de$/", $_SERVER['HTTP_HOST'])) || $_SERVER['HTTP_HOST'] == 'med-rent.de') {
  $location = 'https://' . 'www.spinemed-vienna.at' . $_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ' . $location);
  exit;
}
if ((($_SERVER['HTTPS'] === "off" || $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https') && preg_match("/spinemed-vienna.at$/", $_SERVER['HTTP_HOST'])) || $_SERVER['HTTP_HOST'] == 'spinemed-vienna.at') {
  $location = 'https://' . 'www.spinemed-vienna.at' . $_SERVER['REQUEST_URI'];
  header('HTTP/1.1 301 Moved Permanently');
  header('Location: ' . $location);
  exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title><?php echo $title; ?></title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="author" content="MedRent GmbH">
    <meta name="copyright" content="© 2019 SpineMED Vienna">
    <meta name="email" content="office@med-rent.de">
    <meta name="Rating" content="General">
    <meta name="Distribution" content="Global">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="1 Week">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#3fa3bf">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Spinemed">
    <meta name="application-name" content="Spinemed">
    <meta name="msapplication-TileColor" content="#3fa3bf">
    <meta name="msapplication-config" content="/img/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"
          rel="stylesheet">
    <link href="css/screen.css" rel="stylesheet">
    <script src="js/dist/cookieconsent.min.js"></script>
    <script src="js/dist/cookieconsent.config.js"></script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-89553391-1', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('send', 'pageview');
    </script>
    <script src='https://www.google.com/recaptcha/api.js?hl=de-AT'></script>
</head>
<body>