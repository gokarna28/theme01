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
        <div class="comments-section">
            <?php
            comments_template('/comments.php');
            ?>
        </div>
        
    </div>


    <!-- related post  -->
    <div class="single-post-related-post">
        <!-- use to call the widgits dynamically -->
        <?php dynamic_sidebar('sidebar-1');// id should be pass as paramenter ?>
    </div>

</div>


<?php
get_footer(); // call the footer
