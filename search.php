<?php get_header(); ?>
<?php the_post(); ?>

    <div id="sidebar">
        <!-- Desktop Navigation -->
        <div id="sidebar-navigation-desktop">
            <?php custom_sidebar_menu('2'); ?>
        </div>
        
        <div>
            <?php dynamic_sidebar('body_sidebar'); ?>
        </div>
    </div>

    <div id="page-content-container">

        <div class="breadcrumb breadcrumb-search">
            <?php breadcrumb(); ?>
        </div>

            <?php if (have_posts()) : ?>
                <div class="post">
                    <h2 class="search-h2">Deine Suchergebnisse zu "<?php the_search_query(); ?>"</h2>
                    <div class="entry">
                        <p>Durchsucht wurden alle Beitr&auml;ge der Webseite, das Archiv und alle Unterseiten. Auf Gro&szlig;- und Kleinschreibung wird beim Suchen nicht geachtet.</p>
                        <?php while (have_posts()) : the_post(); ?>
                                <h3 class="search-h3" id="post-<?php the_ID(); ?>">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="search-excerpt">
                                    <?php the_excerpt() ?>
                                </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="navigation">
                        <div class="alignleft"><?php next_posts_link('&laquo; mehr Ergebnisse') ?></div>
                        <div class="alignright"><?php previous_posts_link('mehr Ergebnisse &raquo;') ?></div>
                    </div>
                </div>	

            <?php else : ?>
                <div class="post">
                    <h2>Seite durchsuchen</h2>
                    <div class="entry">
                        <h3 class="pagetitle">Deine Suche zu "<?php the_search_query(); ?>" lieferte leider keine Ergebnisse.</h2>
                        <p>Versuche es doch ein bisschen unsch&auml;rfer noch einmal oder ver&auml;ndere den Suchbegriff, denn es wird nach exakten &Uuml;bereinstimmungen gesucht. Die Gro&szlig;- und Kleinschreibung deines Suchbegriffs wird aber ignoriert.</p> 
                    </div>
                </div>
            <?php endif; ?>

    </div>

<?php get_footer(); ?>
