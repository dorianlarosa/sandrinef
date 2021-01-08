<?php
/*
 * Template Name: Page A propos de moi
 */
get_header();
?>
<!-- PAGE -->

<div id="page-a-propos-de-moi">
    <section id="header-page" class="container-fluid header" style="background-image:url('<?= get_template_directory_uri() ?>/images/header-page-massage.jpg');">
        <div class="container container-content-header">
            <div class="content-header">
                <h1 class="content-header__title"><?= the_title(); ?></h1>
            </div>
        </div>
    </section>


    <section id="a-propos-section" class="container-fluid section">
        <div class="container">

            <h2 class="section__title">Qui-suis-je ?</h2>
            <img class="divider" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
            <p class="section__subtitle">
                Quelques mots sur moi
            </p>
            <p class="section__text">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia qui culpa magni! Molestias dicta omnis, eum nihil voluptas accusantium, expedita inventore neque ipsum suscipit voluptatem dolorum unde consequuntur illo officia!
            </p>
            <div class="container-qualifications">

                <div class="row">
                    
                    <div class="col-12 col-md-5 offset-md-1 order-md-2 image-col">
                        <img src="<?= get_template_directory_uri() ?>/images/image-presentation.jpg" alt="">
                        <?php get_template_part('parts/grid-dots'); ?>

                    </div>

                    <div class="col-12 col-md-6 order-md-1 qualifications-col">
                        <h3>Qualifications</h3>
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

                            while ($qualifications->have_posts()) : $qualifications->the_post();
                            ?>

                                <li class="qualification-item">
                                    <?= get_field("annee_d’obtention")." - ".get_the_title(); ?>
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

    </section>


    <?php get_template_part('parts/cta-section'); ?>

</div>
<!-- END PAGE -->

<?php get_footer(); ?>