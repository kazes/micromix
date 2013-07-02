<!-- THE_POST.PHP -->
<?php
$micromix_number = get_post_meta($post->ID, 'micromixNumber', true);
$the_permalink = the_permalink_return();
$image_format = (is_home() || is_single()) ? 'large' : 'medium';
$image_src = image_attachment_src($post->ID, $image_format); // thumbnail (150), medium (220), large (500)
?>

<!-- TITLE -->
<h2 class="post-title">
    <strong class="post-micromix-number"><?= $micromix_number ?></strong>
    <?php if(!is_single()): ?>
        <a class="the-title" href="<?= $the_permalink ?>" rel="bookmark" title="Leave a comment ?">&ldquo;
            <?php the_title(); ?>&rdquo;
        </a>
    <?php else: ?>
        <span class="the-title">&ldquo;<?php the_title(); ?>&rdquo;</span>
    <?php endif; ?>
</h2>

<!-- DATE -->
<p class="post-date"><small><?php the_time('F jS, Y') ?></small></p>


<!-- IMAGE -->
<div class="post-image">
    <?php if(!is_single()): ?>
        <a href="<?= $the_permalink ?>" title="See this post">
            <img src="<?= $image_src ?>" alt="<?= the_title(); ?>">
        </a>
    <?php else: ?>
        <img src="<?= $image_src ?>" alt="<?= the_title(); ?>">
    <?php endif; ?>

    <!-- SOUND -->
    <?php include("sound.php"); ?>
</div>


<!-- POST CONTENT -->
<div class="post-content">
    <?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
    <p class="post-permalink">> <a href="<?= $the_permalink ?>" rel="bookmark">read this post</a></p>
</div>


<!-- AUTHOR -->
<p class="author">
    <span>mixed by <?php the_author_posts_link(); ?></span>
</p>


<!-- TAGS AND CATEGORIES -->
<?php if(is_single()) { ?>
<p class="postmetadata">
    <?php the_tags('<span><strong>Artists : </strong> ', ', ', '.<br /></span>'); ?>
    <span><strong>Categories : </strong> <?php the_category(', ') ?></span>
</p>
<?php } ?>
