<?php
	include('customizer.php');
	include('inc/walker_sidebar_menu_v2.php');
	include('inc/walker_mobile_primary_menu.php');

	register_nav_menu("primary_menu_part1", "Hauptmenü Teil 1");
	register_nav_menu("primary_menu_part2", "Hauptmenü Teil 2");
	register_nav_menu("primary_menu_part3", "Hauptmenü Teil 3");
	register_nav_menu("quicklink", "quicklink_menu");
	register_nav_menu("footer", "footer_menu");

	add_theme_support('post-thumbnails'); 

	/* WordPress s.w.org CDN entfernen */
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	add_filter( 'emoji_svg_url', '__return_false' );

	// REST Api Hinweise entfernen
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);

	// WordPRess Diverse Eintraege entfernen
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');

	function dpsg_widgets_init() {
		register_sidebar( array(
			'name' => 'Body Sidebar',
			'id' => 'body_sidebar',
			'before_widget' => '<div id="widget-container">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>', ) );
	}
	add_action( 'widgets_init', 'dpsg_widgets_init' );

	function home_excerpt_length($length) {
		return 80;
	}
	function new_excerpt_more($more) {
		return ' &mldr; <a href="' . get_permalink($post->ID) . '" class="readmore">weiterlesen &raquo;</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');

	function slider_excerpt_length($length) {
		return 20;
	}

	function get_theme_mod_default($settingname) {
        global $wp_customizer_settings_default;
		$val = get_theme_mod($settingname);

		if (strlen($val) > 0) {
			return $val;
		}

		if (isset($settingname, $wp_customizer_settings_default)) {
			return $wp_customizer_settings_default[$settingname];
		}

		return '';
	}

	add_filter( 'wp_nav_menu_objects', 'wp_nav_menu_objects_partial_sub_menu', 10, 2 );
	function wp_nav_menu_objects_partial_sub_menu($sorted_menu_items, $args) {
		if (isset($args->partial_sub_menu) && $args->partial_sub_menu == true) 
		// if ($args->partial_sub_menu == true)
		{	
			// get active menu item and parent
			$root_id = 0;
			$parentId = 0;
			foreach ($sorted_menu_items as $menu_item) {
				if ($menu_item->current) {
					// var_dump($menu_item);

					$root_id = (int) $menu_item->ID;
					$parentId = (int) $menu_item->menu_item_parent;
					break;
				}
			}

			// Listemit Level0
			$level0Items = [];
			foreach ($sorted_menu_items as $menu_item)
			{
				if ($menu_item->menu_item_parent == 0)
				{
					array_push($level0Items, $menu_item->ID);
				}
			}

			if ($parentId == 0)
			{
				// active menu item has no parent(s)
				$level0MenuItems = [];
				foreach ($sorted_menu_items as $menu_item)
				{
					if ($menu_item->menu_item_parent == $root_id)
					{
						array_push($level0MenuItems, $menu_item);
					}
				}

				return $level0MenuItems;
			}

			// Level 0 Parent Id
			$parentIdOfLevel0 = 0;

			// Bedingung: $sorted_menu_items ist sortiert
			$startSearching = false;
			$parentIdTree = [];
			array_push($parentIdTree, $parentId);
			array_push($parentIdTree, $root_id);


			// var_dump('parentIdTree: ');
			// var_dump($parentIdTree);
			// var_dump('<br>');



			// var_dump($level0Items);

			foreach (array_reverse($sorted_menu_items) as $menu_item) 
			{
				if ($menu_item->ID == $root_id
					|| $startSearching)
				{
					// if ($startSearching == false)
					// {
					// 	$parentIdOfLevel0 = $menu_item->ID;
					// }	
					// else
					// {
						
					// }

					$startSearching = true;

					$parentIdOfLevel0 = $menu_item->menu_item_parent;

					// var_dump('it: ' . $parentIdOfLevel0 . ' (ID: ' . $menu_item->ID . '<br>');

					// if ($menu_item->menu_item_parent != 0)
					// if (in_array($menu_item->menu_item_parent, $level0Items) == true)
					// {

						// var_dump('1: ' . $menu_item->title . '<br>');
						array_push($parentIdTree, (int)$menu_item->menu_item_parent);
					// }	
					// else
					// {
						// if (in_array($menu_item->ID, $parentIdTree) == false)
						// {
							// var_dump('2: ' . $menu_item->title . '<br>');
							// array_push($parentIdTree, $menu_item->ID);
							// array_push($parentIdTree, (int)$menu_item->menu_item_parent);
						// }
						
					if (in_array($menu_item->menu_item_parent, $level0Items) == true)
					{
						break;
					}
				}
			}

			// var_dump('parentIdTree: ');
			// var_dump($parentIdTree);
			// var_dump('<br>');

			if ($parentIdOfLevel0 == 0) // Support Level1 selection
				$parentIdOfLevel0 = $parentId;
			
			// var_dump('parentIdOfLevel0: ' . $parentIdOfLevel0 . '<br>');

			// Level 0 tree extrahieren
			$newPartialMenu = [];
			$level0BeginFound = false;
			foreach ($sorted_menu_items as $menu_item) 
			{
				// cases: Anfang, mitte, Ende
				if ($menu_item->ID == $parentIdOfLevel0)
				{
					// Anfang von Level 0 Menü gefunden
					$level0BeginFound = true;

					if ($parentIdOfLevel0 != $root_id) // falls Level 1 ausgewählt wurde, damit es doch nicht übersprungen wird
						continue; // Level0 nicht beachten, erst die folgenden Items
				}

				if ($level0BeginFound
					&& $menu_item->ID != $parentIdOfLevel0
					&& $menu_item->menu_item_parent == 0)
				{
					// Ende gefunden
					$level0BeginFound = false;
					break;
				}

				if ($level0BeginFound)
				{
					// sub items collecten
					array_push($newPartialMenu, $menu_item);
				}
			}

			// var_dump($newPartialMenu);

			// im anzuzeigenden Level 0 Menü anderes außer Level 1 ausblenden
			$lastLevel0Id = 0;
			$skipCurrentLevel1Tree = false;

			$ignoreCurrentLevel1 = false;
			
			for ($i = 0; $i < sizeof($newPartialMenu); ) 
			{
				$menu_item = $newPartialMenu[$i];

				if ($menu_item->menu_item_parent == $parentIdOfLevel0)
				{	
					if (in_array($menu_item->ID, $parentIdTree))
					{
						// var_dump('hold ' . $menu_item->title . '<br>');
						// var_dump('id: ' . $menu_item->ID . ', parent: ' . $menu_item->menu_item_parent);
						// var_dump($parentIdTree);
						$ignoreCurrentLevel1 = false;
					}
					else{
						// var_dump('remove ' . $menu_item->title . '<br>');
						$ignoreCurrentLevel1 = true;
					}

					$i++;
					continue; // Level 1 da lassen
				}

				if ($ignoreCurrentLevel1)
				{
					array_splice($newPartialMenu, $i, 1);
					continue;
				}	

				$i++;
			}

			return $newPartialMenu;
		}
		else
		{
			return $sorted_menu_items;
		}
	}

	function print_sidebar_primary_menus() {
		?>
		<ul class="sidebar-default-main-menu">
			<?php

				$primary_menu_parts = array(
					'primary_menu_part1',
					'primary_menu_part2',
					'primary_menu_part3',
				);

				for ($i = 0; $i < sizeof($primary_menu_parts); $i++) {
					if (has_nav_menu($primary_menu_parts[$i])) {
						$menuParams = array(
							'theme_location'  => $primary_menu_parts[$i],
							'menu'            => $primary_menu_parts[$i],
							'container'       => false,
							'menu_class'      => 'menu',
							'items_wrap'      => '%3$s',
							'depth'           => 2,
							'partial_sub_menu' => false,
						);
	
						wp_nav_menu($menuParams);
					}
				}
			?>
		</ul>
		<?php
	}

	function pages_to_id_list($page_array) {
		$direct_child_ids = array();
		for ($i = 0; $i < sizeof($page_array); $i++) {
			array_push($direct_child_ids, (int)$page_array[$i]->ID);
		}

		return $direct_child_ids;
	}

	function custom_sidebar_menu($current_page_id) {

		// --- direkte Childs ----
		$direct_childs = get_pages(array(
			'parent' => $current_page_id));
		$direct_child_ids = pages_to_id_list($direct_childs);
		
		// --- parallele Seiten des Parents ----
		$direct_parent = get_post($current_page_id)->post_parent;
		$neighbor_ids = array();
		if ($direct_parent != null) {
			$neighbors = get_pages(array(
				'parent' => $direct_parent));
			$neighbor_ids = pages_to_id_list($neighbors);
		}
		// --- Parents bis oben ----
		$parent_tree_ids = array();
		$direct_parent_iterator = get_post($direct_parent);
		while ($direct_parent_iterator != null) {
			array_push($parent_tree_ids, $direct_parent_iterator->ID);
			if ($direct_parent_iterator->post_parent != 0)
				$direct_parent_iterator = get_post($direct_parent_iterator->post_parent);
			else
				$direct_parent_iterator = null;
		}

		$relevant_ids = $direct_child_ids;
		$relevant_ids = array_merge($relevant_ids, $neighbor_ids);
		$relevant_ids = array_merge($relevant_ids, $parent_tree_ids);

		?>
			<div class="sidebar-menu-container">
				<ul>
					<?php

						if (sizeof($relevant_ids) == 0 
							|| sizeof(array_diff($relevant_ids, [$current_page_id])) == 0) {
							// keine Childs oder parents, daher standard Hauptmenü ausgeben
							print_sidebar_primary_menus();
						}
						else {
							wp_list_pages(array(
								'include' => $relevant_ids,
								'title_li' => null,
								'walker' => new Walker_Sidebar_Menu_V2()
							));
						}
					?>
				</ul>
			</div>
		<?php
	}
	
	function breadcrumb_print_parents($parent_id) {
		$parent = get_page($parent_id);
		
		if ($parent->post_parent != 0) {
			breadcrumb_print_parents($parent->post_parent);
		}
		echo "<a href=\"" . get_post_permalink($parent_id) . "\">" . $parent->post_title . "</a>";
	}

	function breadcrumb() {
		?>
		
		<a href="/" alt="Startseite" title="Startseite" id="ahomejurte">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home_jurte-icon.png" alt="Startseite" id="imghomejurte" />
		</a>

		<?php
		
		if (is_category() || is_single()) {

			if (is_single()) {
				echo '<a href="'.get_permalink().'" title="';
				the_title();
				echo '">';
				the_title();
				echo '</a>';
			}

			if (get_the_category() != null) {
				// the_category(',');
			}

		} elseif (is_page()) {
			if (get_post_parent() != null) {
				breadcrumb_print_parents(get_post_parent()->ID);
			}

		} elseif (is_search()) {
			echo "Suchergebnisse für ";
			echo '"<em>';
			echo the_search_query();
			echo '</em>"';
		}
	}

	function get_customcss($pagepageid, $customcss) {
		$meta_value = get_post_meta($pagepageid, $customcss, true);

		if (strlen($meta_value) == 0) {
			return null;
		}

		return "class=\"" . $meta_value . "\"";
	}

	function print_footer_menu($menu_name) {
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object($locations[$menu_name]);
			$menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

			$lastFirstLevelItem = 0;

			foreach ($menuitems as $menuitem) 
			{
				if ($menuitem->menu_item_parent != 0 && $menuitem->menu_item_parent != $lastFirstLevelItem)
				{
					// uninteressantes Menuitem vom Level her
					continue;
				}

				if ($menuitem->menu_item_parent == 0
					&& $lastFirstLevelItem != $menuitem->db_id)
				{
					if ($lastFirstLevelItem != 0)
						echo "</ul></div>"; // ggf. vorheriges level 0 item div schließen

					// ist neues level 0 item
					$lastFirstLevelItem = $menuitem->db_id; ?>
					
					<div class="footer-menu-container">
						<a class="footer-menu-level0" href="<?php echo $menuitem->url ?>">
							<p class="footer-menu-header"> 
								<?php echo $menuitem->title ?> 
							</p>
						</a>
						<ul class="footer-menu-container-level0-ul">
				<?php 
				}
				else
				{ ?>
					<!-- // ist neues level 1 item -->
					<li>
						<a class="footer-menu-level1" href="<?php echo $menuitem->url ?>">
							<p class="footer-menu-header-level1">
								<?php echo $menuitem->title ?> 
							</p>
						</a>
					</li>
				<?php }
			}
		?>
		</div>
		<?php
	}

	/* Shortcode (Nur IDs, keine Slugs)
		[beitraege numberposts="4" category="4"]
	*/
	function shortcode_posts_function( $atts = [], $content = null, $tag = '') {
		// Parameter normalize+lowercase
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		$args = shortcode_atts(
			array(
				"numberposts"       => 4,
				"category"			=> ''
			), $atts, $tag
		);

		query_posts( $args );
		$beitraege = get_posts($args);

		// sammeln ...
		$content = '<ul class="home-ul beitraege">';
		foreach ($beitraege as $beitrag) {
			$content .= '<li class="li-postlist-item">';
			$content .= '<h2 class="li-postlist-item-title"><a href="'.get_permalink($beitrag->ID).'">'.$beitrag->post_title.'</a></h2>';
			$content .= '<small>'.get_the_date('',$beitrag->ID).'</small><br />';
			$content .= '<div class="li-postlist-item-thumbnail"><a href="'.get_permalink($beitrag->ID).'"><img style="background-image: url('.get_the_post_thumbnail_url($beitrag->ID, 'articleimage').')" class="thumb"></a></div>';
			$content .= '<div class="li-postlist-item-content">'.get_the_excerpt($beitrag->ID).'</div>';
			$content .= '</li>';
		}
		$content .= '</ul>';
		// ... und ausgeben
		return $content;
	}
	/* Shortcode registrieren */
	add_shortcode('beitraege', 'shortcode_posts_function');

?>