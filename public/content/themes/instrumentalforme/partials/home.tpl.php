<?php
    $terms = get_terms(array(
        'taxonomy' => 'instrument',
        'hide_empty' => false,
    ));
    ?>
    <!-- Content section 1-->
    <?php
    for ($i = 0; $i < count($terms); $i++) :
        $taxonomyImageData = get_field('picture', 'instrument_' . $terms[$i]->term_id);
        $taxonomyImage = $taxonomyImageData['url'];
        //dump($taxonomyImageData);
        //dump($terms[$i]);
        // $taxonomyImage = $terms[$i]->term_id;
        //dump($taxonomyImage);
    ?>
        <section class="instrument-container">
            <div class="container px-5">
                <div class="row gx-5 align-items-center instrument">
                    <div class="col-lg-6 order-lg-2">
                        <!--
                <div class="p-5"><a href="#"><img class="img-fluid rounded-circle" src="<?= $taxonomyImage; ?>" alt="..." /></a></div>
                //-->
                        <div class="p-5 instrument__picture" style="background-image: url(<?= $taxonomyImage; ?>)"></div>
                    </div>
                    <div class="col-lg-6 order-lg-1 instrument__description">
                        <div class="p-5">
                            <h2 class="display-4"><a href="<?= get_term_link($terms[$i]->term_id); ?>"><?= $terms[$i]->name; ?></a></h2>

                            <p><?= substr($terms[$i]->description, 0, 500) . '...'; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endfor; ?>


    <!-- Content section 2-->
    <!--<section>
    <div class="container px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6">
                <div class="p-5"><img class="img-fluid rounded-circle" src="<?= get_theme_file_uri('assets/img/02.jpg') ?>" alt="..." /></div>
            </div>
            <div class="col-lg-6">
                <div class="p-5">
                    <h2 class="display-4">We salute you!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                </div>
            </div>
        </div>
    </div>
</section>-->

    <!-- Content section 3-->
    <!--<section>
    <div class="container px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="p-5"><img class="img-fluid rounded-circle" src="<?= get_theme_file_uri('assets/img/03.jpg') ?>" alt="..." /></div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="p-5">
                    <h2 class="display-4">Let there be rock!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod aliquid, mollitia odio veniam sit iste esse assumenda amet aperiam exercitationem, ea animi blanditiis recusandae! Ratione voluptatum molestiae adipisci, beatae obcaecati.</p>
                </div>
            </div>
        </div>
    </div>
</section>-->