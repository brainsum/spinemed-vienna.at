<?php
session_start();

/* PAGE HEAD
************/
include('head.php');

/* MENU SECTION
***************/
include('inc/section-menu.php');

echo "<main>";

/* MAIN SECTIONS
****************/

if(isset($_SESSION['MSG']))
{
    echo '<h2 style="text-align: center; margin: 20px 0;">';
    echo $_SESSION['MSG'];
    echo '</h2>';
    session_destroy();
}

include('inc/section-intro.php');
include('inc/section-iconline.php');
include('inc/section-informationline.php');
include('inc/section-anwendung.php');
include('inc/section-vertical-buttons.php');

include('inc/section-contact-map.php');
include('inc/section-contact.php');

/* FOOTER SECTION
*****************/
include('footer.php');
