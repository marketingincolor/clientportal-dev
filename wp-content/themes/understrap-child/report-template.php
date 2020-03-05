<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
// Check value exists.
if( have_rows('report_content') ):

    // Loop through rows.
    while ( have_rows('report_content') ) : the_row();

        // Case: Paragraph layout.
        if( get_row_layout() == 'paragraph' ):
            $p_title = get_sub_field('title');
            $p_text = get_sub_field('text');
            ?>
			<div class="paragraph"> 
				<h3 class="paragraph-title"><?php echo $p_title; ?></h3>
				<p><?php echo $p_text; ?></p>
			</div>
            <?php
        elseif( get_row_layout() == 'bullet_list' ): 
            $b_title = get_sub_field('title');
            $b_text = get_sub_field('text');
            ?>
			<div class="bullet-list"> 
				<h3 class="bullet-title"><?php echo $b_title; ?></h3>
				<p><?php echo $b_text; ?></p>
			<?php if( have_rows('list') ): ?>
				<ul class="bullet-list">
				<?php while( have_rows('list') ): the_row(); 
					// vars
					$b_item = get_sub_field('bullet_text');
					?>
					<li class="bullet-item">
					    <?php echo $b_item; ?>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
			</div>
            <?php
        elseif( get_row_layout() == 'icon_list' ): 
            $i_title = get_sub_field('title');
            ?>
			<div class="icon-list"> 
				<h3 class="icon-title"><?php echo $i_title; ?></h3>


			<?php if( have_rows('icon_section') ): ?>
				<ul class="icon-group">
				<?php while( have_rows('icon_section') ): the_row(); 
					// vars
					$i_title_item = get_sub_field('icon_title');
					$i_image_item = get_sub_field('icon_image');
					$i_text_item = get_sub_field('icon_text');
					?>
					<li class="icon-item">
					    <span style="font-size:4rem;"><?php echo $i_image_item; ?></span>
					    <h4><?php echo $i_title_item; ?></h4>
					    <p><?php echo $i_text_item; ?></p>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php endif; ?>


			</div>
            <?php
        elseif( get_row_layout() == 'time_budget' ): 
            $t_title = get_sub_field('title');
            $t_budget = get_sub_field('budget');
            ?>
			<div class="time-budget"> 
				<h3 class="budget-title"><?php echo $t_title; ?></h3>
				<p><?php echo $t_budget; ?></p>
			</div>
            <?php
        endif;

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
