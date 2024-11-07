<?php
get_header(); //call the header
?>

<?php 
$cate_data=get_queried_object();//return all the data of category related post
print_r( $cate_data);
?>


<?php
get_footer();// call the footer