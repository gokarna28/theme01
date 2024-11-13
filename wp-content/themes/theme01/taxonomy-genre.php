<?php
//Template Name:Movies

get_header();// call the header
?>
<div class="movie_wrapper">
    <div class="movie_card_container">
        <?php
        //get the page no
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Get the current genre term
        $term = get_queried_object();
        // echo "<pre>";
        // print_r($term);
        // echo "<pre>";
        
        $args = array(
            'post_type' => 'theme01_movies',
            'posts_per_page' => 6,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'slug',
                    'terms' => $term->slug,
                )
            )
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
                        <p class="movie_date"><?php echo get_the_date(); ?></p>
                    </div>
                </a>
                <?php
            }

        } else {
            echo "no post found";
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
            'total' => $loop->max_num_pages
        ));
        ?>
    </div>
</div>
<?php
get_footer(); // call the footer
