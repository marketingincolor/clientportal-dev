<?php
/**
 * The template for displaying Custom Report pages
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

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php //get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'loop-templates/content', 'page' ); ?>










<div class="report-header">
	<h2><?php the_title(); ?></h2>

<?php if( get_field('report_summary') ): ?>
    <h3><i><?php the_field('report_summary'); ?></i></h3>
<?php endif; ?>

<?php if( get_field('report_date') ): ?>
    <h4><?php the_field('report_date'); ?></h4>
<?php endif; ?>


</div>


<?php
// Check value exists
if( have_rows('report_content') ):

    // Loop through rows
    while ( have_rows('report_content') ) : the_row(); ?>



        <?php // Case: Paragraph layout
        if( get_row_layout() == 'paragraph' ):
            $p_title = get_sub_field('title'); ?>
			<div class="paragraph-section"> 
				<h3 class="paragraph-title"><?php echo $p_title; ?></h3>

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



        <?php // Case: Bullet List layout
        elseif( get_row_layout() == 'bullet_list' ): 
            $b_title = get_sub_field('title'); ?>
			<div class="bullet-list"> 
				<h3 class="bullet-title"><?php echo $b_title; ?></h3>

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





        <?php // Case: Icon List Layout
        elseif( get_row_layout() == 'icon_list' ): 
            $i_title = get_sub_field('title');
            ?>
			<div class="icon-list"> 
				<h3 class="icon-title"><?php echo $i_title; ?></h3>

			<?php if( have_rows('icon_section') ): ?>
			<?php while( have_rows('icon_section') ): the_row(); ?>

	        <?php if( get_row_layout() == 'subheading' ): ?>
	            <h4 class="icon-subheading"><?php the_sub_field('subheading_list'); ?></h4>
			<?php endif; ?>

			<?php if( get_row_layout() == 'icon' ): ?>
            	<li class="icon-item">
				    <span style="font-size:4rem;"><?php echo get_sub_field('icon_image'); ?></span>
				    <h5><?php echo get_sub_field('icon_text'); ?></h5>
				</li>
			<?php endif; ?>

	        <?php if( get_row_layout() == 'image' ): ?>
	            <span class="bullet-image"><img src="<?php get_sub_field('image_list'); ?>"></span>
		    <?php endif; ?>

			<?php endwhile; ?>
			<?php endif; ?>

			</div>







        <?php // Case: Time Budget layout
        elseif( get_row_layout() == 'time_budget' ): 
            $t_title = get_sub_field('title');
            $t_budget = get_sub_field('budget');
            $t_total = get_sub_field('total_hours');
            $t_used = get_sub_field('hours_used');
            $t_remaining = get_sub_field('hours_remaining');
            ?>
			<div class="time-budget"> 
				<h3 class="budget-title"><?php echo $t_title; ?></h3>
				<p><?php echo $t_budget; ?></p>
				<h6>Hours Total: <?php echo $t_total; ?></h6>
				<h6>Hours Used: <?php echo $t_used; ?></h6>
				<h6>Hours Remaining: <?php echo $t_remaining; ?></h6>
			</div>

        <?php endif;

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>







				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer();
