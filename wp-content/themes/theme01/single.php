<?php
get_header(); // call the header
the_post();
?>
<!-- single post  -->
<div class="single-post-blog-container">
    <!-- //post  -->
    <div class="single-post-blog">
        <h1><?php the_title(); ?></h1>
        
        <p><?php echo get_the_date(); ?></p>
        <!-- get the content  -->
        <div> <?php the_content(); ?></div>

        <!-- comment form start from here  -->
        <div>
            <?php
            wp_list_comments(array(
                'style' => 'div',          // or 'ul' for unordered list
                'short_ping' => true,       // shorten pingbacks
                'avatar_size' => 50,        // size of gravatar/avatar
                'reply_text' => 'Reply',    // text for reply link
            ));
            ?>
        </div>
        <div>
            <?php comment_form(); //returns the comment form ?>
        </div>

    </div>
    <!-- related post  -->
    <div class="single-post-related-post">
        <!-- use to call the widgits dynamically -->
        <?php dynamic_sidebar('sidebar-2');// id should be pass as paramenter?>
    </div>

</div>


<?php
get_footer(); // call the footer
