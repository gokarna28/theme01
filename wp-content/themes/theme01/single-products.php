<?php
get_header(); // call the header
?>
<div class="movie-content-container">

    <div class="movie-left">
        <?php
        if (has_post_thumbnail()): ?>
            <div class="movie-thumbnail">
                <?php
                $featured_image = get_the_post_thumbnail_url();
                //echo $featured_image;
                ?>
                <img src="<?php echo $featured_image; ?>" />
            </div>
        <?php endif;
        ?>
        <div class="product_details_container">
            <h2><?php the_title(); ?></h2>
            <?php
            $product_price = get_post_meta($post->ID, '_theme01_product_price', true);
            $product_discreption = get_post_meta($post->ID, '_theme01_product_discreption', true);
            ?>
            <p class="product_price">Rs. <?php echo $product_price; ?></p>
            <p class="product_price">Rs. <?php echo $product_discreption; ?></p>
            <button class="product_cart_btn">Add To Cart</button>
            <div class="product-category-details">
                <?php $categories = get_the_terms($post->ID, 'categories'); ?>

                <p>Categories:
                    <?php
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            ?>
                            <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?>,</a>
                            <?php
                        }
                    }
                    ?>

                </p>
            </div>
        </div>
    </div>

    <div class="movie-right">
        right
    </div>
</div>

<div class="product_features">
    <?php
    if (get_the_content()) {
        ?>
        <h2>Features and specification</h2>
        <p><?php the_content(); ?></p>

        <?php
    }
    ?>
</div>


<?php
get_footer(); // call the footer
?>