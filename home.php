<?php get_header(); ?>

	<div>
		<div id="slider-title-desc-container">

		<?php
				global $wp;
				global $post;

				$args = array(
					'posts_per_page'   => 5,
					'offset'           => 0,
					'category_name'    => 'highlight_home', // Alles in der Category "slider (slug ist highlight_home)"
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'post',
					'post_status'      => 'publish',
					'suppress_filters' => true
				);

				$defaults = array(
					'numberposts'      => 5,
					'category'         => 0,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'include'          => array(),
					'exclude'          => array(),
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'post',
					'suppress_filters' => true,
				);
				$parsed_args = wp_parse_args( $args, $defaults );
				$parsed_args['post_status'] = ( 'attachment' === $parsed_args['post_type'] ) ? 'inherit' : 'publish';
				$parsed_args['no_found_rows'] = true;
				$get_posts = new WP_Query;
				$myposts = $get_posts->query( $parsed_args );

				if (sizeof($myposts) == 0) {

				}

				foreach ($myposts as $post) : setup_postdata($post);
				?>

				<!-- <div class="slider-title">
					<a href="<?php the_permalink() ?>">
						<?php echo get_the_title(); ?>
					</a>
				</div> -->

				<?php

				endforeach;

				foreach ($myposts as $post) : setup_postdata($post);
				?>

				<div class="slider-desc" thumbnail="<?php echo the_post_thumbnail_url()?>">
					<?php
						add_filter('excerpt_length', 'slider_excerpt_length');
						the_excerpt();
						remove_filter('excerpt_length', 'slider_excerpt_length');
					?>
				</div>

				<?php

				endforeach;

				?>
			</div>
		<div class="slider-nav">

			<?php

				for ($i = 0; $i < sizeof($myposts); $i++) {
					$post = $myposts[$i];
					setup_postdata($post)
					?>

					<div class="slider-navitem" onclick="onclick_slider_button(<?php echo $i ?>)"><?php echo get_the_title(); ?></div>

				<?php }

				wp_reset_postdata();
			?>

		</div>

		<script>
			itemCount = document.getElementsByClassName("slider-desc").length;
			currentSliderItem = 0;
			loadNextSliderItem(currentSliderItem);

			function loadNextSliderItem() {
				onclick_slider_button(currentSliderItem);

				currentSliderItem++;
				if (currentSliderItem >= itemCount)
					currentSliderItem = 0;

				if (window.sliderdisabled == false || window.sliderdisabled == null) {
					setTimeout(loadNextSliderItem, 8000);
				}
			}

			function onclick_slider_button(index) {
				// var titles = document.getElementsByClassName("slider-title");
				// for (i = 0; i < titles.length; i++) {
				// 	if (i == index)
				// 		titles[i].style.display = "initial";
				// 	else
				// 		titles[i].style.display = "none";
				// }

				var desc = document.getElementsByClassName("slider-desc");
				for (i = 0; i < desc.length; i++)
				{
					if (i == index)
					{
						desc[i].style.display = "initial";

						// Thumbnail setzen
						var thumb = document.getElementById("slider-title-desc-container");
						newThumbnail = "url(" + desc[i].attributes.thumbnail.nodeValue + ")";
						thumb.style.backgroundImage = newThumbnail;
					}
					else
						desc[i].style.display = "none";
				}

				var btns = document.getElementsByClassName("slider-navitem");
				for (i = 0; i < btns.length; i++)
				{
					if (i == index)
					{
						btns[i].style.backgroundColor = "<?php echo get_theme_mod_default('set_color_buttonevent') ?>";
					}
					else
					{
						btns[i].style.backgroundColor = "<?php echo get_theme_mod_default('set_color_primary1') ?>";
					}
				}
			}
		</script>

	</div>

	</div> <!-- main content container -->

	<div class="spacer-25"></div>

	<div id="main-content-container">

    <div id="sidebar">
        <div>
            <?php
				if (function_exists('dynamic_sidebar')) {
					dynamic_sidebar('body_sidebar');
				}
			?>
        </div>
    </div>

		<div id="page-content-container">
			<ul class="home-ul">

				<?php
					global $wp;
					global $post;

					// Pagination: Etwas umstaendlich, weil get_posts() kein $paged hat, aber ein $offset.
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$postsPerPage = ((int)get_theme_mod_default('set_homepage_postcount'));
                    // paged - 1 um den offset korrekt für die erste Seite zu setzen - 20221128jt
					$pagedOffset = ($paged - 1) * $postsPerPage;

					$args = array(
						'posts_per_page'   => ((int)get_theme_mod_default('set_homepage_postcount')),
						'offset'           => $pagedOffset,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'post_status'      => 'publish',
					);

					$defaults = array(
						'numberposts'   => ((int)get_theme_mod_default('set_homepage_postcount')),
						'category'         => 0,
						'orderby'          => 'date',
						'order'            => 'DESC',
						'include'          => array(),
						'exclude'          => array(),
						'meta_key'         => '',
						'meta_value'       => '',
						'post_type'        => 'post',
						'suppress_filters' => true,
						'paged' 		   => $paged,
					);

					$parsed_args = wp_parse_args( $args, $defaults );
					$parsed_args['post_status'] = ( 'attachment' === $parsed_args['post_type'] ) ? 'inherit' : 'publish';
					$parsed_args['no_found_rows'] = true;
					$get_posts = new WP_Query();

    				$myposts = $get_posts->query( $parsed_args );

					foreach ( $myposts as $post ) : setup_postdata( $post );
					?>

						<li class="li-postlist-item">
							<!-- Überschrift -->
							<h2 class="li-postlist-item-title">
								<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</h2>

							<!-- Datum, Autor, ... -->
							<div class="li-postlist-item-subtitle">
								<small><?php the_date()?> (von: <?php the_author(); ?>)</small>
							</div>

							<div class="li-postlist-item-content">
								<!-- Thumbnail -->
								<?php if (has_post_thumbnail())
								{
									$thumbnail_id = get_post_thumbnail_id( $post->ID );
									$alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

									?>
									<div class="li-postlist-item-thumbnail">
										<a href="<?php the_permalink() ?>">
											<!-- alt="<?php echo $alt_text ?>" -->
											<img style="background-image: url('<?php the_post_thumbnail_url('articleimage') ?>')">
										</a>
									</div>
								<?php } ?>

								<!-- Textvorschau -->
								<?php
									add_filter('excerpt_length', 'home_excerpt_length');
									the_excerpt();
									remove_filter('excerpt_length', 'home_excerpt_length');
								?>
							</div>
						</li>

					<?php
					endforeach;

					wp_reset_postdata();
				?>

			</ul>

		<?php
		the_posts_pagination( array(
			'mid_size' => 5,
			'prev_text' => __( ' &laquo; ', 'textdomain' ),
			'next_text' => __( ' &raquo; ', 'textdomain' ),
			) );
		?>

		</div>
<?php get_footer(); ?>
