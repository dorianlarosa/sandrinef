<?php
/*
 * Template Name: Page contactez-moi
 */
get_header();
?>
<!-- PAGE -->

<div id="page-contactez-moi">
    <section id="header-page" class="container-fluid header">
        <div class="container container-content-header reveal">
            <div class="content-header">
                <h1 class="content-header__title reveal-1"><?= the_title(); ?></h1>
            </div>
        </div>
    </section>

    <section id="contact-section" class="container-fluid section">
        <div class="container">
            <div class="reveal">

                <h2 class="section__title reveal-2">Prise de contact</h2>
                <img class="divider reveal-3" src="<?= get_template_directory_uri() ?>/images/divider.png" alt="">
                <p class="section__subtitle reveal-4">
                    Envoyer un message
                </p>
            </div>

            <div class="container-informations-contact reveal">

                <div class="row">
                    <div class="col-12 col-lg-5 col-informations-contact">

                        <h3 class="reveal-1">Une question ?</h3>
                        <p class="text reveal-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta eius blanditiis atque illo eos mollitia officia ratione vero
                        </p>
                        <ul class="list-contact">
                            <li class="item-contact reveal-3">
                                <div class="container-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg>
                                </div>
                                <span><?php the_field('numero_de_telephone', 'option'); ?></span>
                            </li>
                            <li class="item-contact reveal-4">
                                <div class="container-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
                                    </svg>
                                </div>
                                <span><?php the_field('adresse_email', 'option'); ?></span>
                            </li>
                        </ul>
                        <h3 class="title-horaire reveal-5">Horaires</h3>
                        <div class="container-horaires">
                            <div class="horaire-item reveal-6">
                                <span>Du lundi au vendredi</span>
                                <span class="bold-text">De 10h00 à 19h00</span>
                            </div>
                            <div class="horaire-item reveal-7">
                                <span>Le samedi</span>
                                <span class="bold-text">De 10h00 à 18h00</span>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6 offset-lg-1 col-form">
                        <div class="container-form">
                            <div class="form reveal-7">

                                <?= do_shortcode('[wpforms id="106" title="false"]');?>
                                 </div>

                            <?php get_template_part('parts/grid-dots', null, 'reveal-8'); ?>


                        </div>

                    </div>


                </div>
            </div>
        </div>

    </section>


    <section id="map-section" class="container-fluid section reveal">
        <div id="container-map" class="reveal-1">

        </div>
    </section>

    <?php get_template_part('parts/cta-section'); ?>


</div>
<!-- END PAGE -->

<?php get_footer(); ?>