<?php
get_header();
?>

  <div id="contentArchive">
    <div class="title-animated">
      <h1>Escoge tu estilo de zapatos favorito</h1>
    </div>

<?php
    $upload_dir = wp_upload_dir();
    while(have_posts()){
      the_post();
?>
      <div class="colum3">
          <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <div class="inner_content">
              <div class="product_image">
                  <img src="<?php echo $upload_dir["baseurl"] ."/". get_the_content();  ?>" alt="Zapatos Wanderlust">
              </div>
              <div class="name">
                <p>
                    <?php echo get_the_title(); ?>
                </p>
              </div>
            </div>
          </a>
      </div>


<?php
    }
?>
  <br style="clear: both"/>
  </div>
<?php
  get_footer();
?>
