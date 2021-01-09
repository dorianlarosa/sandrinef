<section id="avantages-section" class="container-fluid section">
    <div class="container reveal">
        <h2 class="section__title reveal-1">Bienfaits et avantages</h2>
        <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
        <p class="section__subtitle reveal-3">
            Optez pour des methodes douces et naturelles
        </p>
        <p class="section__text reveal-4">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
        </p>

        <div class="list-items">

        <?php get_template_part('parts/grid-dots', null, 'reveal-9'); ?>

            <div class="row">
                <?php
                /**
                 * Setup query to show the ‘services’ post type with ‘8’ posts.
                 * Output the title with an excerpt.
                 */
                $argsAvantages = array(
                    'post_type' => 'avantages',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );

                $avantages = new WP_Query($argsAvantages);
                $countAvantages = 4;

                while ($avantages->have_posts()) : $avantages->the_post();
                    $countAvantages++;
                ?>

                    <div class="col-12 col-md-6 col-lg-4 item reveal-<?= $countAvantages; ?>">
                        <div class="item-content">

                            <?php $imageAvantage = get_field("image"); ?>

                            <img class="item-content__image" src="<?= $imageAvantage["sizes"]["medium_large"]; ?>" alt="Illustration du massage" height="512" width="768">

                            <h3 class="item-content__title">
                                <?= the_title(); ?>
                            </h3>

                            <p class="item-content__text">
                                <?= the_field("texte"); ?>
                            </p>
                        </div>

                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?> 

            </div>

        </div>
    </div>
</section>