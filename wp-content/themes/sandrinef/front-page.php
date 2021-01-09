<?php get_header(); ?>

<div id="home-page">
    <section id="header-home-page" class="container-fluid header" style="background-image:url('<?= get_template_directory_uri() ?>/images/header-homepage.jpg');">
        <div class="container container-content-header">
            <div class="content-header reveal">
                <span class="content-header__adress reveal-1">14 Grande rue, 25000 Besançon</span>
                <h1 class="content-header__title reveal-2">Sandrine F Bien-être</h1>
                <p class="content-header__text reveal-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam totam culpa atque quibusdam enim facilis voluptates recusandae.</p>
                <a href="" class="content-header__btn btn btn__light reveal-4">Reserver</a>
            </div>
        </div>
    </section>

    <section id="presentation-section" class="container-fluid section">
        <div class="container">

            <div class="row">
                <div class="col-12 col-md-6 section__text-col reveal">
                    <h2 class="section__title reveal-1">Bienvenu</h2>
                    <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                    <p class="section__subtitle reveal-3">
                        Sandrine F bien-être
                    </p>
                    <p class="section__text reveal-4">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit quisquam qui quaerat velit ipsa voluptas quod aliquam esse recusandae ab, est libero omnis delectus dolor numquam fuga suscipit repellat laudantium.
                    </p>
                    <div class="section__container-btn reveal-5">
                        <a href="#" class="btn">En savoir plus</a>
                    </div>
                </div>
                <div class="col-12 col-md-5 offset-md-1 section__image-col reveal">
                    <div class="image reveal-1">

                    </div>
                    <?php get_template_part('parts/grid-dots', null, 'reveal-2'); ?>

                </div>
            </div>

        </div>
    </section>

    <section id="services-section" class="container-fluid section">
        <div class="container reveal">

            <h2 class="section__title reveal-1">Services</h2>
            <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
            <p class="section__subtitle reveal-3">
                une relaxation suivant vos envies
            </p>
            <p class="section__text reveal-4">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
            </p>

            <div class="list-items ">
                <?php get_template_part('parts/grid-dots', null, 'reveal-10'); ?>
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

                    $countService = 4;

                    while ($services->have_posts()) : $services->the_post();
                    ?>
                        <?php
                        $statusService = get_field("statut_du_massage");
                        $countService++; ?>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 item reveal-<?= $countService; ?> <?php if ($statusService == 'formation_en_cours') echo 'not-available'; ?>">
                            <div class="item-content">

                                <span class="btn btn__small btn-not-available">Formation en cours</span>
                                <?php $imageService = get_field("image"); ?>

                                <img class="item-content__image" src="<?= $imageService["sizes"]["medium_large"]; ?>" alt="Illustration du massage" height="512" width="768">

                                <h3 class="item-content__title">
                                    <?= the_title(); ?>
                                </h3>

                                <p class="item-content__text">
                                    <?= the_field("resume"); ?>
                                </p>

                                <div class="container-btn item-content__container-btn">
                                    <a href="/massages/#<?= get_post_field('post_name', get_the_ID()); ?>" class="btn btn__small">En savoir plus</a>
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


    <?php get_template_part('parts/avantages-section'); ?>



    <section id="evenement-section" class="container-fluid section reveal">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 <?php if (get_field('afficher_une_image_section_evenement', 'option') == true) echo 'col-lg-4'; ?> col-text">
                <div class="col-text__content">


                    <h2 class="section__title reveal-1"><?php the_field('titre_section_evenement', 'option'); ?></h2>
                    <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                    <p class="section__subtitle reveal-3">
                        <?php the_field('sous-titre_section_evenement', 'option'); ?>
                    </p>
                    <p class="section__text reveal-4">
                        <?php the_field('texte_section_evenement', 'option'); ?>
                    </p>
                    <?php if (get_field('afficher_un_bouton_section_evenement', 'option') == true) { ?>
                        <div class="container-btn reveal-5">
                            <a href="<?php the_field('lien_du_bouton_section_evenement', 'option'); ?>" class="btn"><?php the_field('texte_du_bouton_section_evenement', 'option'); ?></a>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>

        <?php if (get_field('afficher_une_image_section_evenement', 'option') == true) { ?>
            <?php $imageSectionEvent = get_field("image_section_evenement", 'option'); ?>

            <img class="image-section reveal-6" src="<?= $imageSectionEvent["sizes"]["medium_large"]; ?>" alt="Illustration de la section" height="512" width="768">

        <?php } ?>
    </section>

    <section id="review-section" class="container-fluid section">
        <div class="container reveal">

            <h2 class="section__title reveal-1">Avis clients</h2>
            <img class="divider reveal-2" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
            <p class="section__subtitle reveal-3">
                Ce que les clients en disent
            </p>
            <div class="list-review">

                <?php get_template_part('parts/grid-dots', null, 'reveal-7'); ?>
                <?php get_template_part('parts/grid-dots', null, 'reveal-9'); ?>

                <div class="row">
                    <?php
                    /**
                     * Setup query to show the ‘services’ post type with ‘8’ posts.
                     * Output the title with an excerpt.
                     */
                    $argsReviews = array(
                        'post_type' => 'review',
                        'post_status' => 'publish',
                        'posts_per_page' => 2,
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    );

                    $reviews = new WP_Query($argsReviews);
                    $countReviews = 3;

                    while ($reviews->have_posts()) : $reviews->the_post();
                        $countReviews++;
                    ?>

                        <div class="col-12 col-md-6 item-review reveal-<?= $countReviews; ?>">
                            <div class="item-review-content">

                                <p class="item-review-content__text">
                                    "<?= the_field("avis"); ?>"
                                </p>

                                <p class="item-review-content__name">
                                    <?= the_field("nom"); ?>
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


    <?php get_template_part('parts/cta-section'); ?>



</div>

<?php get_footer(); ?>