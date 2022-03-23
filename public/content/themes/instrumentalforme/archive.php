<?php
//echo __FILE__.':'.__LINE__; exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Instrumental For Me!</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.icon" />

</head>

<body id="page-top">

    <!-- wp header -->
    <?php get_header(); ?>

    <!-- Navigation-->
    <?php get_template_part('partials/navbar.tpl'); ?>

    <!-- Header-->
    <?php get_template_part('partials/header.tpl'); ?>

    <?php
    $term = get_queried_object();
    $termId = $term->term_id;

    $taxonomyImage = get_field('picture', 'instrument_' . $termId);
    //dump($term);

    //dump($taxonomyImage['url']);
    //exit;
    ?>
    <!-- Content section 1-->

    <div class="container">
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><a href="#"><img class="img-fluid rounded-circle" src="<?= $taxonomyImage['url']; ?>" alt="..." /></a></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4"><?= $term->name; ?></h2>
                            <p><?= $term->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>               
                                <div class="profileH2">
                        <div class="profileDescription">
                            <article class="projet">                              
                                <?php the_terms($post->ID, 'type', 'Type : '); ?><br>
                                <p img class="profileView img-fluid rounded-circle"> <?php the_post_thumbnail('thumbnail'); ?></p>
                                <h2>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_author(); ?>
                                    </a>
                                </h2>
                                <div>
                                    <p class="linkInstrument"><?php the_terms($post->ID, 'instrument'); ?></p>
                                </div>
                                <div>
                                    <?php the_content(); ?>
                                </div>
                            </article>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>
    </div>

    <!-- Footer-->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- wp footer -->
    <?php get_footer(); ?>
</body>

</html>