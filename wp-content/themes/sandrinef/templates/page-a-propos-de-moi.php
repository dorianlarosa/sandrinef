<?php
/*
 * Template Name: Page A propos de moi
 */
get_header();
?>
<!-- PAGE -->

<div id="page-a-propos-de-moi">
    <section id="header-page" class="container-fluid header">
        <div class="container container-content-header">
            <div class="content-header reveal">
                <h1 class="content-header__title reveal-1"><?= the_title(); ?></h1>
            </div>
        </div>
    </section>


    <section id="a-propos-section" class="container-fluid section">
        <div class="container ">
            <div class="reveal">


                <h2 class="section__title reveal-2">Qui-suis-je ?</h2>
                <img class="divider reveal-3" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                <p class="section__subtitle reveal-4">
                    Quelques mots sur moi
                </p>
                <p class="section__text reveal-5">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                </p>
            </div>
            <div class="container-qualifications reveal">

                <div class="row">

                    <div class="col-12 col-md-5 offset-md-1 order-md-2 image-col">
                        <?php get_template_part('parts/grid-dots', null, 'reveal-8'); ?>
                        <div class="image reveal-5">

                        </div>

                    </div>

                    <div class="col-12 col-md-6 order-md-1 qualifications-col">
                        <div class="qualifications-col__content">
                            <div class="container-icon reveal-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                                </svg>
                            </div>

                            <h3 class="reveal-1">Qualifications</h3>
                            <ul class="list-qualifications">

                                <?php
                                /**
                                 * Setup query to show the ‘services’ post type with ‘8’ posts.
                                 * Output the title with an excerpt.
                                 */
                                $argsQualifications = array(
                                    'post_type' => 'qualifications',
                                    'post_status' => 'publish',
                                    'meta_key' => 'annee_d’obtention',
                                    'posts_per_page' => -1,
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC'
                                );

                                $qualifications = new WP_Query($argsQualifications);
                                $countQualifications = 1;
                                while ($qualifications->have_posts()) : $qualifications->the_post();
                                    $countQualifications++;
                                ?>

                                    <li class="qualification-item reveal-<?= $countQualifications; ?>">
                                        <?= get_field("annee_d’obtention") . " - " . get_the_title(); ?>
                                    </li>

                                <?php
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <?php get_template_part('parts/cta-section'); ?>

</div>
<!-- END PAGE -->

<?php get_footer(); ?>