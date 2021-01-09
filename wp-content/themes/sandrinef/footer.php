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
                                                                        <li>
                                                                                <span>
                                                                                        26 Grande rue,</span>
                                                                                <span>
                                                                                        25000 Besançon

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
                                                                        <li>
                                                                                <span>Du lundi au vendredi</span>
                                                                                <span class="bold-text">De 10h00 à 19h00</span>

                                                                        </li>
                                                                        <li>
                                                                                <span>Le samedi</span>
                                                                                <span class="bold-text">De 10h00 à 18h00</span>
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