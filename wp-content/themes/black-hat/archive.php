<?php get_header() ?>

	<div id="container">
		<div id="content">

<?php the_post() ?>

<?php if ( is_day() ) : ?>
			<h2 class="page-title"><?php printf(__('Daily Archives: <span>%s</span>', 'sandbox'), get_the_time(get_option('date_format'))) ?></h2>
<?php elseif ( is_month() ) : ?>
			<h2 class="page-title"><?php printf(__('Monthly Archives: <span>%s</span>', 'sandbox'), get_the_time('F Y')) ?></h2>
<?php elseif ( is_year() ) : ?>
			<h2 class="page-title"><?php printf(__('Yearly Archives: <span>%s</span>', 'sandbox'), get_the_time('Y')) ?></h2>
<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			<h2 class="page-title"><?php _e('Blog Archives', 'sandbox') ?></h2>
<?php endif; ?>

<?php rewind_posts() ?>

<?php while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Permalink to %s', 'sandbox'), wp_specialchars(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>

				<?php if ( comments_open() ) : ?>
                <div class="entry-comments"><?php comments_popup_link(__('0', 'sandbox'), __('1', 'sandbox'), __('%', 'sandbox')) ?></div>
                <?php endif; ?> 

				<div class="clear"></div>
				<div class="entry-meta">
					<span class="author vcard"><?php printf(__('Posted by %s on ', 'sandbox'), '<a class="url fn n" href="'.get_author_link(false, $authordata->ID, $authordata->user_nicename).'" title="' . sprintf(__('View all posts by %s', 'sandbox'), $authordata->display_name) . '">'.get_the_author().'</a>') ?></span><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'sandbox'), the_date('', '', '', false), get_the_time()) ?></abbr>
				</div>
				<div class="entry-categ">
					<span class="cat-links"><?php printf(__('Filed under %s', 'sandbox'), get_the_category_list(', ')) ?></span>
					<?php if( function_exists('the_tags') ) {
                        // if there are no tags, this section does not appear
                        $tags = wp_get_post_tags($post->ID);
                        if ($tags) { ?>
							<br />
							<span class="cat-links">Tagged as <?php the_tags('') ?></span><?php 
	                    }
					} ?>
				</div>				
				<div class="entry-content">
<?php the_content(''.__('Read More <span class="meta-nav">&raquo;</span>', 'sandbox').''); ?>

<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'sandbox'), "</div>\n", 'number'); ?>
				</div>				
			</div><!-- .post -->

<?php endwhile ?>

			<div id="nav-below" class="navigation" style="margin-bottom:100px;">
				<div class="floater-left"><?php next_posts_link(__('<span class="meta-nav">&laquo;</span> Older posts', 'sandbox')) ?></div>
				<div class="floater-right"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox')) ?></div>
				<div class="clear"></div>
			</div>

		</div><!-- #content -->
		<?php get_sidebar() ?>
        <div class="clear"></div>
	</div><!-- #container -->

<?php get_footer() ?>