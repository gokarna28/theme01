<?php if (have_comments()) {
    ?>
    <ol class="comment-list">
        <?php
        wp_list_comments(array(
            'avatar_size' => 40,
            'max_depth' => 5,
            'style' => 'ol',
            'short_ping' => true,
            'type' => 'comment',
        ));
        ?>
    </ol><!-- .comment-list -->
    <div>
        <?php comment_form(); //returns the comment form ?>
    </div>
    <?php
} else {
        echo "No comments";
        //comments form here
        comment_form();
}