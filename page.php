<?php

// HEADER
if (!isajax()) {
    get_header(); // <div id="column2"> is in header
}
echo '<div class="view" data-context="index">';


if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="article" id="post-<?php the_ID(); ?>">

        <h2><span><?php the_title(); ?></span></h2>



        <div class="page">
            <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?><!-- wysiwyg content -->
        </div><!-- .page -->

        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    </div><!-- .article -->


    <?php
    // COMMENTS
    comments_template();
    ?>


<?php endwhile; endif; ?>
</div>

<?php // SIDEBAR
if (!isajax()) {
    get_sidebar();
}
?>