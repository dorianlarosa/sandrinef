<?php
/*
 * Template Name: Page massages
 */
get_header();
?>
<!-- PAGE -->

<div id="page-massages">
    <section id="header-page" class="container-fluid header">
        <div class="container container-content-header">
            <div class="content-header reveal">
                <h1 class="content-header__title reveal-1"><?= the_title(); ?></h1>
            </div>
        </div>
    </section>


    <section id="services-section" class="container-fluid section">
        <div class="container">
            <div class="reveal">

                <h2 class="section__title reveal-2">Mes services</h2>
                <img class="divider reveal-3" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                <p class="section__subtitle reveal-4">
                    Découvrez l'ensemble de mes massages
                </p>
                <p class="section__text reveal-5">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                </p>
            </div>

            <div class="list-items reveal">
                <?php get_template_part('parts/grid-dots', null, 'reveal-6'); ?>
                <div class="row">

                    <?php
                    /**
                     * Setup query to show the ‘services’ post type with ‘8’ posts.
                     * Output the title with an excerpt.
                     */
                    $argsServices = array(
                        'post_type' => 'massages',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );

                    $services = new WP_Query($argsServices);
                    $countServices = 0;
                    while ($services->have_posts()) : $services->the_post();
                    $countServices++;
                    ?>
                        <?php $statusService = get_field("statut_du_massage"); ?>

                        <div id="<?= get_post_field('post_name', get_the_ID()); ?>" class="col-12 item reveal-<?= $countServices;?> <?php if ($statusService == 'formation_en_cours') echo 'not-available'; ?>">
                            <div class="item-content">


                                <span class="btn btn__small btn-not-available">Formation en cours</span>
                                <?php $imageService = get_field("image"); ?>

                                <img class="item-content__image" src="<?= $imageService["sizes"]["medium_large"]; ?>" alt="Illustration du massage" height="512" width="768">

                                <div class="item-infos">

                                    <h3 class="item-infos__title">
                                        <?= the_title(); ?>
                                    </h3>

                                    <p class="item-infos__text">
                                        <?= the_field("description"); ?>
                                    </p>

                                    <?php

                                    $price = get_field("prix");
                                    if (get_field("prix")) {

                                    ?>

                                        <p class="item-infos__price-container">
                                            <?= the_field("prix"); ?>
                                        </p>

                                    <?php } ?>

                                    <?php

                                    $arrayDuration = get_field("liste_des_durees_de_seance");
                                    if ($arrayDuration) {


                                    ?>

                                        <ul class="item-infos__list-duration">
                                            <?php



                                            foreach ($arrayDuration as $key => $value) {
                                            ?>
                                                <li class="badge item-duration">
                                                    <?= $value["duree"] . "min"; ?>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>


                                    <?php } ?>


                                    <div class="container-btn item-infos__container-btn">
                                        <a href="/massages/#<?= get_post_field('post_name', get_the_ID()); ?>" class="btn btn__small ">Réserver</a>
                                    </div>

                                </div>
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


    <section id="shop-section" class="container-fluid section">
        <div class="container reveal">

            <div class="row">
                <div class="col-12 col-lg-6 section__text-col">
                    <h2 class="section__title reveal-1">Gamme de produits</h2>
                    <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                    <p class="section__subtitle reveal-3">
                        Des produits adaptés à vos besoins
                    </p>
                    <p class="section__text reveal-4">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                    </p>
                    <div class="section__container-btn reveal-5">
                        <a href="#" class="btn">Voir le catalogue</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php get_template_part('parts/avantages-section'); ?>

    <?php get_template_part('parts/cta-section'); ?>


</div>
<!-- END PAGE -->

<?php get_footer(); ?>