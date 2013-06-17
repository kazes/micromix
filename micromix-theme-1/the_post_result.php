<!-- TEMPLATE RESULT (when you filter by author or artist)-->

<!-- POST TITLE -->
<h2 class="post-title">
	<strong><?= get_post_meta($post->ID, 'micromixNumber', true); ?></strong>
    <a href="<?php the_permalink() ?>">&ldquo;<?php the_title(); ?>&rdquo;</a>
</h2>


<!-- POST IMAGE -->
<?php
$image_src = image_attachment_src($post->ID, 'medium'); // thumbnail (150), medium (220), large (500)
?>
<div class="post-image">
    <a href="<?php the_permalink() ?>" class="link-thumb">
        <img src="<?= $image_src; ?>" alt="<?php the_title(); ?>" />
    </a>
    <?php include('sound.php'); ?>
</div>


<!-- POST CONTENT -->
<div class="post-content">
	<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
	<p class="post-permalink">> <a href="<?php the_permalink() ?>" rel="bookmark">read this post</a></p>
</div>



