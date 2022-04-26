<?php
use Instrumental\Controllers\UserController;
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

    <?php
    $current_user = wp_get_current_user();
    $userdata = get_userdata($current_user->ID);
    $userName = $userdata->user_description;
    // dump(__FILE__ . ':' . __LINE__, $userName);
   // dd($userdata->description);
    ?>

    <div class="container">
        <h2 class="profileH2">Modifier votre profil</h2>

        <section>
            <form method="post">
                <input type="hidden" name="update-profile" readonly value="1">
                <div class="containerUpdate">
                    <p>
                        <label for="username" class='labelForm'>Username</label>
                        <input type="text" name="name" id="username" class="input" value="<?= $userdata->user_nicename ?>" size="20" autocapitalize="off" readonly>
                    </p>
                    <?php if ($userdata->first_name) : ?>
                        <p>
                            <label for="user_firstname" class='labelForm'>Votre Prénom</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="input" value="<?= $userdata->first_name ?>" size="20" autocapitalize="off">
                        </p>
                    <?php else : ?>
                        <p>
                            <label for="user_firstname" class='labelForm'>Votre Prénom</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="input" value="" size="20" autocapitalize="off">
                        </p>
                    <?php endif; ?>
                    <?php if ($userdata->last_name) : ?>
                        <p>
                            <label for="user_firstname" class='labelForm'>Votre Nom</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="input" value="<?= $userdata->last_name ?>" size="20" autocapitalize="off">
                        </p>
                    <?php else : ?>
                        <p>
                            <label for="user_firstname" class='labelForm'>Votre Nom</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="input" value="" size="20" autocapitalize="off">
                        </p>
                    <?php endif; ?>
                </div>
                <div class="containerUpdate">
                    <p>
                        <label for="user_email" class='labelForm'>Votre email</label>
                        <input type="email" name="user_email" id="user_email" class="input" value="<?= $userdata->data->user_email ?>" size="20" autocapitalize="off">
                    </p>
                    <p>
                        <label for="user_password" class='labelForm'>Nouveau mot de passe</label>
                        <input type="password" name="user_password" id="user_password" class="input" value="" size="20" autocapitalize="off">
                    </p>
                    <p>
                        <label for="user_password_confirmation" class='labelForm'>Confirmer nouveau mot de passe</label>
                        <input type="password" name="user_password_confirmation" id="user_password_confirmation" class="input" value="" size="20" autocapitalize="off">
                    </p>
                </div>
                <div class="containerUpdate">
                <?php if ($userdata->description) : ?>
                    <p>
                        <label for="user_description" class='labelForm'>Votre description</label><br> 
                        <input type="textarea" name="user_description" id="user_description" class="input" value="<?= $userdata->description ?>" size="170" autocapitalize="off">
                    </p>
                    <?php else : ?>
                    <p>
                        <label for="user_description" class='labelForm'>Votre description</label><br>
                        <input type="textarea" name="user_description" id="user_description" class="input" value="" size="170" autocapitalize="off">
                      
                    </p>
                    <?php endif; ?>
                </div>

                <div class="containerUpdate">

                    <!--=====================récupération des taxo du user=====================-->

                    <?php

                    $user = wp_get_current_user();
                    $roles = $user->roles;
                   
                    if (in_array('teacher', $user->roles)) {
                        $postType = 'teacher-profile';
                    } else {
                        $postType = 'student-profile';
                    }
                    $profileId = $user->ID;
                   
                    // dump($profileId);

                    $selectedInstruments = wp_get_post_terms($profileId, 'instrument');
                    $instrumentsId = [];
                    foreach ($selectedInstruments as $term) {
                        $instrumentsId[$term->term_id] = true;
                    }
                    $selectedCertificates = wp_get_post_terms($profileId, 'certificate');
                    $certificatesId = [];
                    foreach ($selectedCertificates as $term) {
                        $certificatesId[$term->term_id] = true;
                    }
                    $selectedStyles = wp_get_post_terms($profileId, 'music-style');
                    $stylesId = [];
                    foreach ($selectedStyles as $term) {
                        $stylesId[$term->term_id] = true;
                    }
                    //=====================CERTIFICAT TEACHER=====================
                    if (in_array('teacher', $roles)) {
                        $isTeacher = true;
                        echo "<div id='certificate' class='containerUpdateRadio'>";
                        echo "<label class='labelForm'>Vos certificats</label><br>";
                        $certificates = get_terms('certificate', array('hide_empty' => false));
                        foreach ($certificates as $index => $certificate) :
                            $checked = '';
                            if (isset($certificatesId[$certificate->term_id])) {
                                $checked = 'checked';
                            }
                            echo "<input type='checkbox' id='certif' $index  name='certificate[]' value='$certificate->term_id' $checked>";
                            echo "<label for='certif' $index>";
                            echo $certificate->name;
                            echo "</label><br>";
                        endforeach;
                        echo '</div>';
                    } else {
                    }
                    // =====================INSTRUMENTS=====================
                    if (in_array('teacher', $roles)) {
                        $isTeacher = true;
                        echo "<div id='instrument' class='containerUpdateRadio'>";
                        echo "<br><label class='labelForm'>Vos instruments</label><br>";
                        $instruments = get_terms('instrument', array('hide_empty' => false));
                        dump($instruments);
                        foreach ($instruments as $index => $instrument) :
                            $checked = '';
                            if (isset($instrumentsId[$instrument->term_id])) {
                                $checked = 'checked';
                            }
                            echo "<input type='checkbox' class='instru' $index name='instrument[]' value='$instrument->term_id' " . $checked . ">";
                            echo "<label for='instru' $index>";
                            echo $instrument->name;
                            echo "</label><br>";
                        endforeach;
                        echo '</div>';
                    } else {
                    }
                    //=====================MUSIC STYLE=====================
                    echo "<div id='musicStyle' class='containerUpdateRadio'>";
                    echo "<br><label class='labelForm'>Vos styles de musique</label><br>";
                    $musicStyles = get_terms('music-style', array('hide_empty' => false));
                    //dump($musicStyle);
                    foreach ($musicStyles as $index => $musicStyle) :
                        $checked = '';
                        if (isset($stylesId[$musicStyle->term_id])) {
                            $checked = 'checked';
                        }
                        echo "<input type='checkbox' class='music' $index  name='musicStyle[]' value='$musicStyle->term_id' $checked>";
                        echo "<label for='music' $index>";
                        echo $musicStyle->name;
                        echo "</label><br>";
                    endforeach;
                    echo '</div>';
                    ?>
                </div>
                <button type="submit" class="btn btn-success m-2">Update</button>
            </form>

            <!--============================Avatar===================================-->
            <div class="layoutUpdateButton">
                <div class="m-5">
                    <h2>Changer mon avatar</h2>
                    <p>Veuillez selectionner votre avatar en format .png</p>

                    <p class="mb-5">
                        <?php
                        $options = array(
                            'post_id' => 'user_' . $current_user->ID,
                            // 'field_groups' => array(77),
                            // 'form' => false,
                            // 'return' => add_query_arg('updated', 'true', '?'),
                            'html_before_fields' => '',
                            'html_after_fields' => '',
                            'submit_value' => 'Update'
                        );
                        acf_form($options);
                        ?>
                    </p>
                </div>
            </div>

            <!--===============================suppression de compte=============================-->
            <div class="divDeleteAccount">
                <?php
                global $router;
                $deleteAccountURL = $router->generate('user-delete-account');
                echo
                '<button type="button" class="btn btn-danger m-2"><a class="text-dark" href="' . $deleteAccountURL . '">Supprimer votre compte</a></button>';
                ?>
            </div>
        </section>
    </div>


    <!-- Footer-->
    <?php get_template_part('partials/footer.tpl'); ?>

    <!-- wp footer -->
    <?php get_footer(); ?>

    <!--======================================================================================-->
    <script>
        function viewCertificate() {

            let radioTeacher = document.querySelector("#teacher");
            let div = document.querySelector("#certificate");


            if (radioTeacher.checked == true) {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }

        }
    </script>

</body>

</html>