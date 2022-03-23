
<head>
    <!-- wp header -->
    <?php get_header(); ?>
</head>

<body>
    <!-- Navigation-->
    <?php get_template_part('partials/navbar.tpl'); ?>

    <!-- Header-->
    <?php get_template_part('partials/header.tpl'); ?>

    <div class="container_img404">
        
        <img class="img404" src="<?= get_theme_file_uri('assets/images/img404.jpeg') ?>">
        <p>La page demandée n'existe pas </p>
    </div>


    <section>
        <!-- Footer-->
        <?php get_template_part('partials/footer.tpl'); ?>
        <!-- wp footer -->
        <?php get_footer(); ?>
    </section>
</body>

</html>