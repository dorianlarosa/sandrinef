                        <footer id="footer" class="footer container-fluid reveal">
                                <div class="container">

                                        <div class="footer__logo-container">
                                                <?php
                                                $custom_logo_id = get_theme_mod('custom_logo');
                                                $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                                                ?>
                                                <img class="logo reveal-1" src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                                        </div>
                                        <div class="footer__list-contact">
                                                <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__adress reveal-2">
                                                                <p class="col-footer__title">
                                                                        Adresse
                                                                </p>
                                                                <ul class="col-footer__list">
                                                                        <?php $adress = get_field('adresse', 'option'); ?>
                                                                        <li>
                                                                                <span>
                                                                                        <?= $adress['adresse']; ?>,</span>
                                                                                <span>
                                                                                        <?= $adress['code_postal']; ?>

                                                                                </span>
                                                                        </li>


                                                                </ul>

                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__contact reveal-3">
                                                                <p class="col-footer__title">
                                                                        Contact
                                                                </p>

                                                                <ul class="col-footer__list">
                                                                        <li>
                                                                                <?php the_field('numero_de_telephone', 'option'); ?>
                                                                        </li>
                                                                        <li>
                                                                                <?php the_field('adresse_email', 'option'); ?>
                                                                        </li>
                                                                </ul>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__horaire reveal-4">
                                                                <p class="col-footer__title">
                                                                        Horaires
                                                                </p>

                                                                <ul class="col-footer__list">
                                                                <?php $horaires = get_field('horaires', 'option'); ?>
                                                                        <li>
                                                                                <span><?= $horaires['horaire_1']['periode']; ?></span>
                                                                                <span class="bold-text"><?= $horaires['horaire_1']['horaire']; ?></span>

                                                                        </li>
                                                                        <li>
                                                                                <span><?= $horaires['horaire_2']['periode']; ?></span>
                                                                                <span class="bold-text"><?= $horaires['horaire_2']['horaire']; ?></span>
                                                                        </li>
                                                                </ul>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="footer__bottom-footer">
                                                <span class="copyright reveal-5">
                                                        2020 Sandrine Fonquernie. All right reserved
                                                </span>

                                                <div class="container-links reveal-6">
                                                        <?php
                                                        wp_nav_menu(array(
                                                                'theme_location' => 'footer-menu',
                                                                'menu_class' => 'menu',
                                                        )); ?>
                                                        <!-- <span><a href="">Mentions légales</a></span>
                                                <span><a href="">Politique de confidentialitée</a></span> -->
                                                </div>
                                        </div>
                                        <?php get_template_part('parts/grid-dots', null, 'reveal-8'); ?>
                                </div>

                        </footer>

                        </main>

                        <?php wp_footer(); ?>

                        </body>

                        </html>