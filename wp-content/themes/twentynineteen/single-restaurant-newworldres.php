<?php
$posts = get_field('noname');


if( $posts ): ?>
    <ul>
        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <?php setup_postdata($post); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span>Custom field from $post: <?php the_field('author'); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif;



// vars
$font_size = get_field('starpoint');

?>

<?php if( $font_size ): ?>
	h2 {
		font-size: <?php echo $font_size; ?>px;
	}
<?php endif; ?>

<?php


?>



