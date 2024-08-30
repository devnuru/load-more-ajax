<?php get_header(); ?>





      <div class="container container_filter">

            <div class="filters filter-button-group">
                  <ul><h4>
                    <li class="active" data-filter="*">All</li>

                    <?php
                      $terms = get_terms('porfiolio_category');
                      foreach ($terms as  $term) { ?>
                        <li data-filter=".<?php  echo $term->slug; ?>"><?php echo $term->name; ?></li>
                  <?php  }

                    ?>
                    <!-- <li data-filter=".webdesign">Logo</li>
                    <li data-filter=".webdev">videos</li>
                    <li data-filter=".brand">Websites</li> -->
                  </h4></ul>
                </div>

                <div class="content grid">
                  <?php
                      $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => 4,
                        'paged' => get_query_var('paged', 1), //page number 1 on load
                        'post_status' => 'publish',
                      );

                      $wp_query = new WP_Query($args);

                      while ($wp_query->have_posts()) {
                        $wp_query->the_post();

                        $termsArray = get_the_terms($post->ID, 'porfiolio_category');

                        $termsSLug = "";
                        foreach ($termsArray as $term) {
                          $termsSLug .= $term->slug . ' ';
                        }

                        ?>

                        <div class="single-content <?php echo  $termsSLug; ?>  grid-item">
                          <img class="p2" src="<?php the_post_thumbnail_url(); ?>">
                  
                     <?php 
                       $terms = wp_get_post_terms( $post->ID, 'porfiolio_category');
                       foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                       echo '<a href="' . $term_link . '">' . $term->name . '</a>' . ' '; }
                       ?> 
                
							             
                        </div>

                  <?php  }
                    wp_reset_postdata();
                    ?>

              </div>

              <?php if ($wp_query->max_num_pages >1) { ?>
                  <div class="button_load_more ">
                      <div class="btn_wrapper">
                            <a  class="btn btn-default  btn_style_more loadmore "href="#">Load More</a>
                      </div>

                  </div>
              <?php  }?>
      </div>



<?php get_footer(); ?>
