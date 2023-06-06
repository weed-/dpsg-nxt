<?php get_header(); ?>

<div id="sidebar">
        <!-- Desktop Navigation -->
        <div id="sidebar-navigation-desktop">

            <?php
                custom_sidebar_menu(get_the_ID());
            ?>

        </div>
        
        <div>
            <?php 
                if (function_exists('dynamic_sidebar')) { 
                    dynamic_sidebar('body_sidebar'); 
                } 
            ?>
        </div>
    </div>

    <div id="page-content-container">

        <h1 class="page404-h1">Hoppla! Seite nicht gefunden</h1>
        <hr>

        <p id="content-text">Es tut uns sehr leid, aber die aufgerufene URL (Adresse) konnte nicht gefunden werden. Bitte überprüfe die Schreibweise der Adresse oder benutze die Suche zum Auffinden von Inhalten.  </p>
        
        <img class="page404-img" src="<?php echo bloginfo('template_url') . "/images/error404.jpg" ?>">

        <p id="content-text">
        Wenn du über einen Link hierher gekommen bist, informiere am besten direkt <a href="/impressum">das Webteam</a> damit der Fehler ganz schnell behoben wird. </p>

    </div>

<?php get_footer(); ?>
