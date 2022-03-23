<?php
the_post();
$studentMusicStyle = get_the_terms(
    $post->ID,
    'music-style'
);
?>

<head>
    <!-- wp header -->
    <?php get_header(); ?>
</head>

<body id="page-top">

    <!-- Navigation-->
    <?php get_template_part('partials/navbar.tpl'); ?>
    <!-- Header-->
    <?php get_template_part('partials/header.tpl'); ?>

    <div class="container">
        <section>
            <div class="profileH2">
                <p class="profileView">Vous êtes sur la page de profil de</p>
                <p><?= get_avatar(
                        $post->ID,
                        $size = 96,
                        $default = '',
                        $alt = '',
                        $args = null
                    ); ?></p>
                <h2><?= get_the_author(); ?></h2>
            </div>
            <div class="profileDescription">
                <p><?= get_the_content(); ?></p>
            </div>
            <div class="profileInstrument">
                <h4><?= get_the_author(); ?> aime :</h4>
                <ul>
                    <?php if (!isset($studentMusicStyle)) : ?>
                        <?php foreach ($studentMusicStyle as $key => $value) : ?>
                            <h6 class="profileMusicStyle_ul-p"><a href="<?= get_term_link($value->term_id); ?>"><?= $value->name; ?></a></h6>
                            <p class="taxoLayout"><?= substr($value->description, 0, 500) . '...'; ?></p>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="taxoLayout"><?= get_the_author(); ?> n'a pas de style de musique sélectionné...</p>
                    <?php endif ?>
                </ul>
            </div>
        </section>
    </div>

    <!-- Footer-->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- wp footer -->
    <?php get_footer(); ?>
</body>

</html>