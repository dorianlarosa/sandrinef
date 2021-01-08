                        <footer id="footer" class="footer container">
                                <div class="footer__logo-container">
                                        <?php
                                        $custom_logo_id = get_theme_mod('custom_logo');
                                        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                                        ?>
                                        <img class="logo" src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                                </div>
                                <div class="footer__list-contact">
                                        <div class="row">
                                                <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__adress">
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
                                                <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__contact">
                                                        <p class="col-footer__title">
                                                                Contact
                                                        </p>

                                                        <ul class="col-footer__list">
                                                                <li>
                                                                        06 29 35 66 33
                                                                </li>
                                                                <li>
                                                                        adress@doamin.fr
                                                                </li>
                                                        </ul>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4 col-footer col-footer__horaire">
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
                                        <span class="copyright">
                                                2020 Sandrine Fonquernie. All right reserved
                                        </span>

                                        <div class="container-links">
                                                <?php
                                                wp_nav_menu(array(
                                                        'theme_location' => 'footer-menu',
                                                        'menu_class' => 'menu',
                                                )); ?>
                                                <!-- <span><a href="">Mentions légales</a></span>
                                                <span><a href="">Politique de confidentialitée</a></span> -->
                                        </div>
                                </div>
                                <?php get_template_part('parts/grid-dots'); ?>

                        </footer>

                        </main>

                        <?php wp_footer(); ?>

                        </body>

                        </html>