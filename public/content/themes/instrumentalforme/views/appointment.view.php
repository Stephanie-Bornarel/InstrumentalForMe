<?php
$user = wp_get_current_user();
?>



<body id="page-top">

    <!-- wp header -->
    <?php get_header(); ?>

    <!-- Navigation-->
    <?php get_template_part('partials/navbar.tpl'); ?>

    <!-- Header-->
    <?php get_template_part('partials/header.tpl'); ?>
    <?php
    if (!is_user_logged_in()) {
        echo '<h2 class="navbarLayout-li"><a href="' . wp_login_url() . '">Vous devez être connecter pour pouvoir prendre rendez-vous</a></h2>';
       
    } else {
        (is_user_logged_in())
        
    ?>
        <h4 class="m-5">Merci <?= $user->display_name ?>, votre rendez-vous a bien été pris en compte.</h4>
    <?php
    }
    ?>
    <!-- Footer-->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- wp footer -->
    <?php get_footer(); ?>
</body>

</html>