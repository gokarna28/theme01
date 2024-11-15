<?php
//Template Name:Shop

get_header();// call the header
?>
<div class="movie_wrapper">
    <div class="movie_card_container">
        <?php
        //get the page no
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'products',
            'posts_per_page' => 6,
            'paged' => $paged
        );

        $loop = new WP_Query($args);

        if (have_posts()) {
            while ($loop->have_posts()) {
                $loop->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="movie_card">
                    <div class="movie_image">
                        <?php
                        $image_path = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        ?>
                        <img src="<?php echo $image_path[0]; ?>" alt="movie image">
                    </div>
                    <div class="movie_details">
                        <p class="movie_title"><?php the_title(); ?></p>
                        <?php
                        $product_price = get_post_meta($post->ID, '_theme01_product_price', true);
                        ?>
                        <p class="product_price">Rs. <?php echo $product_price; ?></p>
                        <div>
                            <button class="product_cart_btn">Buy Now</button>
                            <button class="product_cart_btn">Add To Cart</button>
                        </div>
                    </div>
                </a>
                <?php
            }

        } else {
            echo "no post";
        }
        ?>
    </div>
    <div class="movie_pagination_container">
        <?php
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $loop->max_num_pages,
            'aria_current' => 'page',
            'show_all' => false,
            'prev_next' => true,
            'prev_text' => __('Previous'),
            'next_text' => __('Next'),
            'end_size' => 1,
            'mid_size' => 2,
            'type' => 'plain',
            'add_args' => false,
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => '',
        ));
        ?>
    </div>
</div>
<?php
get_footer(); // call the footer
