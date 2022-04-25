<?php
the_post();
$teacherInstrument = get_the_terms(
    $post->ID,
    'instrument'
);
$datas = $_POST;
$teacherId = get_the_author_meta('ID');
$student = wp_get_current_user();
$studentId = $student->ID;
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
                <p><?php $urlAvatar = get_field('avatar', 'user_' . $teacherId)['url'];
                    ?></p>
                <img src="<?= $urlAvatar ?>" alt="">
                <!-- <?php dump($urlAvatar); ?> -->
                <h2><?= get_the_author(); ?></h2>
            </div>
            <div class="profileDescription">
                <p><?= get_the_content(); ?></p>
            </div>
            <div>
                <p class="center">Vous souhaitez prendre une leçon avec <?= get_the_author(); ?> ?</p>
                <h4>Choisissez date et horaire de votre leçon</h4>
                <?php
                global $router;
                $url = $router->generate('teacher-take-lesson');
                ?>
                <form method="POST" action="<?= $url; ?>">
                    <label for="instrument">Instrument que vous souhaitez apprendre : </label><br>
                    <select name="instrument" id="instrument">
                        <?php foreach ($teacherInstrument as $key => $value) : ?>
                            <option value="<?= $value->term_id; ?>" id="<?= $value->term_id; ?>"><?= $value->name; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!--
                    <label class="appointmentForm" for="date">Date souhaitée :</label><br>
                    //-->

                    <input id="date" name="date" type="hidden" />

                    <div id="vuecontainer">
                        <div id="appointment">
                            <v-app>
                                <v-main>
                                    <template>
                                        <v-row>
                                            <v-col cols="12" sm="4"></v-col>

                                            <v-col cols="12" sm="2">
                                                <v-menu ref="menuDate" v-model="menuDate" :close-on-content-click="false" transition="scale-transition" offset-y max-width="290px" min-width="auto">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field v-model="dateFr" label="Date" persistent-hint prepend-icon="mdi-calendar" v-bind="attrs" v-on="on"></v-text-field>
                                                    </template>
                                                    <v-date-picker locale="fr" v-model="date" @input="menuDate = false ; updateDate()"></v-date-picker>
                                                </v-menu>
                                            </v-col>

                                            <v-col cols="12" sm="2">
                                                <v-menu ref="menu" v-model="menuTime" :close-on-content-click="false" :nudge-right="40" :return-value.sync="time" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-text-field v-model="time" label="Choisir une heure" prepend-icon="mdi-clock-time-four-outline" readonly v-bind="attrs" v-on="on"></v-text-field>
                                                    </template>
                                                    <v-time-picker format="24hr" v-if="menuTime" v-model="time" full-width @click:minute="$refs.menu.save(time) ; updateDate()"></v-time-picker>
                                                </v-menu>
                                            </v-col>

                                            <v-col cols="12" sm="4"></v-col>

                                        </v-row>
                                    </template>
                                </v-main>
                            </v-app>
                        </div>
                    </div>

                    <input class="appointmentForm" type="submit" value="Validez">
                    <input name="teacherId" type="hidden" value="<?= $teacherId; ?>" />
                </form>
            </div>
            <div class="profileInstrument">
                <h4><?= get_the_author(); ?> enseigne :</h4>
                <?php
                foreach ($teacherInstrument as $key => $value) :
                    $taxonomyImageData = get_field('picture', 'instrument_' . $value->term_id);
                    $taxonomyImage = $taxonomyImageData['url']; ?>
                    <!-- <ul>
                        <li><?= $value->name; ?></li>
                    </ul> -->
                    <section class="instrument-container">
                        <div class="container px-5">
                            <div class="row gx-5 align-items-center instrument">
                                <div class="col-lg-6 order-lg-2">
                                    <div class="p-5 instrument__picture" style="background-image: url(<?= $taxonomyImage; ?>)"></div>
                                </div>
                                <div class="col-lg-6 order-lg-1 instrument__description">
                                    <div class="p-5">
                                        <h2 class="display-4"><a href="<?= get_term_link($value->term_id); ?>"><?= $value->name; ?></a></h2>
                                        <p><?= substr($value->description, 0, 500) . '...'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
            <div class="profileInstrument">
                <h4><?= get_the_author(); ?> aime :</h4>
                <?php
                $teacherMusicStyle = get_the_terms(
                    $post->ID,
                    'music-style'
                );
                ?>
                <ul>
                    <?php if (isset($teacherMusicStyle)) : ?>
                        <?php foreach ($teacherMusicStyle as $key => $value) : ?>
                            <h6 class="profileMusicStyle_ul-p"><a href="<?= get_term_link($value->term_id); ?>"><?= $value->name; ?></a></h6>
                            <p class="taxoLayout"><?= substr($value->description, 0, 500) . '...'; ?></p>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="taxoLayout"><?= get_the_author(); ?> n'a pas de style de musique sélectionnée...</p>
                    <?php endif ?>
                </ul>
            </div>
            <div class="profileCertificate">
                <h4>Les certificats de <?= get_the_author(); ?> :</h4>
                <?php
                $teacherCertificate = get_the_terms(
                    $post->ID,
                    'certificate'
                ); ?>
                <ul>
                    <?php if (isset($teacherCertificate)) : ?>
                        <?php foreach ($teacherCertificate as $key => $value) : ?>
                            <h6 class="profileCertificate_ul-p"><a href="<?= get_term_link($value->term_id); ?>"><?= $value->name; ?></a></h6>
                            <p class="taxoLayout"><?= substr($value->description, 0, 500) . '...'; ?></p>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="taxoLayout"><?= get_the_author(); ?> n'a pas de certificats sélectionné...</p>
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