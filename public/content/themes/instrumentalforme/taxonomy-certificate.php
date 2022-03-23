<?php
 //echo __FILE__ . ':' . __LINE__;
// exit();
?>

<!DOCTYPE html>
<html lang="en">

<
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
    ?>

    <!-- Content section -->
    <section id="scroll">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="p-5">
                    <h3 class="display-4"><?= $term->name; ?></h3>

                    <p class="taxoLayout"><?= $term->description; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- wp footer -->
    <?php get_footer(); ?>
</body>

</html>