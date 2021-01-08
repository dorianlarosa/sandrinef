<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php wp_head(); ?>
</head>

<body>
    <main id="main">
        <div class="container-fluid top-navbar">
            <div class="container content-top-navbar">
                <div class="contact-infos">
                    <!-- <span class="mail">Contactez-moi : adresse@domaine.com</span>
                    <span class="separate-contact"> | </span> -->
                    <span class="contact-tel">Appellez-moi : <?php the_field('numero_de_telephone', 'option'); ?></span>
                </div>
                <div class="socials-network">
                    <a href="" class="social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid navbar">
            <nav class="container content-navbar">

                <div class="container-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="link-logo">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
                        ?>
                        <img class="logo" src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">

                    </a>
                </div>

                <div class="menu-toggle" id="mobile-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <ul class="nav" id="primary-nav">
                    <li class="nav-item"><a href="#" class="nav-link active">Accueil</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">A propos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Massages</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="#" class="btn nav-link__btn">Réserver</a></li>
                </ul>
            </nav>
        </div>