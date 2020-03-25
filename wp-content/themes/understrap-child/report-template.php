<?php
/**
 * The custom PAGE template for displaying Custom Report pages
 *
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="precontainer <?php //echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<!-- <div class="row"> -->

			<!-- Do the left sidebar check -->
			<?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<!-- <main class="site-main" id="main"> -->

				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'loop-templates/content', 'page' ); ?>





		<?php if( get_field('summary_background') ):
		    $sum_bgnd = get_field('summary_background'); 
		endif; ?>

		<div class="container-background report-header" style="background-image: url(<?php echo $sum_bgnd; ?>);">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">

						<h2 class="center-content"><i><?php the_title(); ?></i></h2>

					<?php if( get_field('report_date') ): ?>
					    <p class="center-content"><?php the_field('report_date'); ?></p>
					<?php endif; ?>

					<?php if( get_field('report_summary') ): ?>
					    <p><?php the_field('report_summary'); ?></p>
					<?php endif; ?>

					<?php //if(function_exists('mpdf_pdfbutton')) mpdf_pdfbutton(); ?>
					<?php //if(function_exists('mpdf_pdfbutton')) mpdf_pdfbutton(false, 'Download Report in PDF Format', 'my login text'); ?>
						<div class="center-content">
							<a href="<?php the_permalink();?>?output=pdf" class="button">Download Report in PDF Format</a>
						</div>

					</div>
				</div>
			</div>
		</div>


		<div class="container-background nav-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">
						<h2 class="center-content">Click on a Report Item to Scroll to it</h2>


						<div class="row justify-content-center"> 
						<?php 
						$value = get_field( 'report_content' );
						foreach ($value as $section) {
							//print_r($section);
							echo '<div class="col-3"><a href="#' . preg_replace( "/\s+/", "_", $section['title'] ) . '" class="button">' . $section['title'] . '</a></div>';
						}
						?>
						</div>


					</div>
				</div>
			</div>
		</div>
<?php //echo 'COUNT: ' . count( get_field('report_content') ); ?>





<?php
// Check value exists
if( have_rows('report_content') ):




    // Loop through rows
    while ( have_rows('report_content') ) : the_row(); ?>


        <?php // Case: Paragraph layout
        if( get_row_layout() == 'paragraph' ):
            $p_title = get_sub_field('title'); 
            $p_bgnd = get_sub_field('background'); ?>
		<div class="container-background paragraph-section" style="background-image: url(<?php echo $p_bgnd; ?>);"> 
			<div class="container"> 
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">

						<h3 class="paragraph-title" id="<?php echo preg_replace( '/\s+/', '_', $p_title ) ?>"><?php echo $p_title; ?></h3>

					<?php if( have_rows('content') ): ?>
				    <?php while( have_rows('content') ): the_row(); ?>

			        <?php if( get_row_layout() == 'subheading' ): ?>
			            <h4 class="paragraph-subheading"><?php the_sub_field('subheading_content'); ?></h4>
					<?php elseif( get_row_layout() == 'text' ): ?>
			            <p class="paragraph-text"><?php the_sub_field('text_content'); ?></p>
			        <?php elseif( get_row_layout() == 'image' ): ?>
			            <span class="paragraph-image"><img src="<?php get_sub_field('image_content'); ?>"></span>
				    <?php endif; ?>

				    <?php endwhile; ?>
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>


        <?php // Case: Bullet List layout
        elseif( get_row_layout() == 'bullet_list' ):
            $b_title = get_sub_field('title'); 
            $b_bgnd = get_sub_field('background');?>
		<div class="container-background bullet-list" style="background-image: url(<?php echo $b_bgnd; ?>);"> 
			<div class="container"> 
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">

						<h3 class="bullet-title" id="<?php echo preg_replace( '/\s+/', '_', $b_title ) ?>"><?php echo $b_title; ?></h3>

					<?php if( have_rows('list') ): ?>
				    <?php while( have_rows('list') ): the_row(); ?>

			        <?php if( get_row_layout() == 'subheading' ): ?>
			            <h4 class="bullet-subheading"><?php the_sub_field('subheading_bullet'); ?></h4>
					<?php endif; ?>

					<?php if( get_row_layout() == 'text' ): ?>
			            <li class="bullet-text"><?php the_sub_field('text_bullet'); ?></li>
					<?php endif; ?>

			        <?php if( get_row_layout() == 'image' ): ?>
			            <span class="bullet-image"><img src="<?php get_sub_field('image_bullet'); ?>"></span>
				    <?php endif; ?>

				    <?php endwhile; ?>
					<?php endif; ?>

					</div>
				</div>
			</div>
		</div>





        <?php // Case: Icon List Layout
        elseif( get_row_layout() == 'icon_list' ):
            $i_title = get_sub_field('title'); 
            $i_bgnd = get_sub_field('background');?>
		<div class="container-background icon-list" style="background-image: url(<?php echo $i_bgnd; ?>);"> 
			<div class="container">
				<div class="row justify-content-center"> 
					<div class="col-12 col-md-10">
						<div class="row justify-content-center">
						<h3 class="icon-title" id="<?php echo preg_replace( '/\s+/', '_', $i_title ) ?>"><?php echo $i_title; ?></h3>

			<?php if( have_rows('icon_section') ): ?>
			<?php while( have_rows('icon_section') ): the_row(); ?>

		        <?php if( get_row_layout() == 'subheading' ): ?>
		        	<div class="col-12 col-md-10">
		            	<h4 class="icon-subheading"><?php the_sub_field('subheading_list'); ?></h4>
		            </div>
				<?php endif; ?>

				<?php if( get_row_layout() == 'icon' ): ?>
	            	<div class="icon-item col-4">
	            		<span class="icon-img"><?php echo get_sub_field('icon_image'); ?></span>
	            		<h5 class="icon-text"><?php echo get_sub_field('icon_text'); ?></h5>
	            	</div>
				<?php endif; ?>

		        <?php if( get_row_layout() == 'image' ): ?>
		        	<div class="col-12 col-md-10">
		            	<span class="bullet-image"><img src="<?php get_sub_field('image_list'); ?>"></span>
		            </div>
			    <?php endif; ?>

			<?php endwhile; ?>
			<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		</div>







        <?php // Case: Time Budget layout
        elseif( get_row_layout() == 'time_budget' ): 
            $t_title = get_sub_field('title');
            $t_budget = get_sub_field('budget');
            $t_total = get_sub_field('total_hours');
            $t_used = get_sub_field('hours_used');
            $t_remaining = get_sub_field('hours_remaining');
            $t_bgnd = get_sub_field('background'); ?>
		<div class="container-background time-budget" style="background-image: url(<?php echo $t_bgnd; ?>);"> 
			<div class="container"> 
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">
						<h3 class="budget-title" id="<?php echo preg_replace( '/\s+/', '_', $t_title ) ?>"><?php echo $t_title; ?></h3>
					<?php if( $t_budget ): ?>
						<p><?php echo $t_budget; ?></p>
					<?php endif; ?>
						<h5 class="time-label">Total Project Hours:</h5> 
						<p class="time-data"><?php echo $t_total; ?></p>
						<h5 class="time-label">Hours Used To Date:</h5> 
						<p class="time-data"><?php echo $t_used; ?></p>
						<h5 class="time-label">Remaining Project Hours:</h5> 
						<p class="time-data"><?php echo $t_remaining; ?></p>
					</div>
				</div>
			</div>
		</div>

        <?php endif;

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>


	<?php if( get_field('next_steps_background') ):
	    $ns_bgnd = get_field('next_steps_background'); 
	endif; ?>

		<div class="container-background next-steps" style="background-image: url(<?php echo $ns_bgnd; ?>);"> 
			<div class="container"> 
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">
					<?php if( have_rows('next_steps') ): ?>
						<h3 class="steps-title">Next Steps</h3>
						<ol class="next-steps-list">
						<?php while( have_rows('next_steps') ): the_row(); 
							$step_text = get_sub_field('step'); ?>
							<li class="single-step">
							<?php if( $step_text ): ?>
								<p><?php echo $step_text; ?></p>
							<?php endif; ?>
							</li>
						<?php endwhile; ?>
						</ol>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</div>


				<?php endwhile; // end of the loop. ?>

			<!-- </main> --><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php //get_template_part( 'global-templates/right-sidebar-check' ); ?>

		<!-- </div> --><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->




<!-- Include of theme Footer for custom template layout -->

<?php //get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

						<?php //understrap_site_info(); ?>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>