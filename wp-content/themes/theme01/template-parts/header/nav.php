<?php
/**
 * Template navbar
 */
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo site_url(); //return the site url?>">
      <?php
      $logoImage = get_header_image(); //return the path of header image
      //echo $logoImage;
      ?>
      <img src="<?php echo $logoImage; ?>" alt="logo image" width="150">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- calling nav items -->
      <?php wp_nav_menu(array(
        'theme_location' => 'primary-menu'
        ,
        'menu_class' => 'header-nav'
      )) ?>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>