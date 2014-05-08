<?php get_header();?>
<!--content s -->
<div id="content" >
	<?php 
		if(have_posts()):
			while(have_posts()):?>
				<?php the_post();?>
                <div class="post" id="post-<?php the_ID();?>">
                    <h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2></br>
                    <div class="entry">
						<?php the_content();?>
                        <?php link_pages('<p><strong>Pages:</strong>','</p>','number');?>
                        <p class="postmetadata" >
                        	<?php _e('Filed under:');?><?php the_category(',');?>
                            <?php _e('by');?><?php the_author();?>                            
                            <?php edit_post_link('Edit','|','');//以管理员身份登录时才可见?>
                        </p>
                    </div>
                    <!--评论 s -->
                    	<?php comments_template();?>
                    <!--评论 e -->
                </div>
			<?php endwhile;?>
            <div class="navigation" >
            	<?php previous_post_link('? %link');?>  <?php next_post_link('%link ?');?>
            </div>
            <?php else:?>
            <div class="post">
            	<h2><?php _e('Not Found');?></h2>
            </div>
		<?php endif;?>
</div>
<!--content e -->

<?php get_sidebar();?>
<?php get_footer();?>
</div><!--wrapper e -->
</body>
</html>















