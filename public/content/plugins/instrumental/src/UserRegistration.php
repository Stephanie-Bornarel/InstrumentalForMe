<?php

namespace Instrumental;

use WP_User;


class UserRegistration
{
    public function __construct()
    {

        add_action( //Charger un css custom sur nos pages login & register
            'login_enqueue_scripts',
            [$this, 'loadAssets']
        );

        add_action( // Inserrer du code Html dans le formulaire de WP afin de le personnaliser
            'register_form',
            [$this, 'addCustomFields']
        );

        add_action( // Gestion des erreurs une fois le formulaire soumis
            'registration_errors',
            [$this, 'checkErrors']
        );

        /* ======================================
           Etape après que l'utilisateur est crée
           ======================================*/

        add_action( // Affectation du rôle de l'utilisateur 
            'register_new_user',
            [$this, 'setUserRole']
        );

        add_action( //  Création de la page profil
            'register_new_user',
            [$this, 'createUserProfile']
        );

        add_action( // Affectation du MdP choisit par l'utilisateur
            'register_new_user',
            [$this, 'setUserPassword']
        );
    }

    /*======================
            Méthodes
    ====================== */

    public function setUserRole($newUserId)
    {
        $user = new WP_User($newUserId);
        $role = filter_input(INPUT_POST, 'user_type'); // Controle des données enregistrer par l'utilisateur (si rôle non autorisé = suppression de compte et blocage de la page)

        $allowedRoles = [
            'teacher',
            'student'
        ];

        if (!in_array($role, $allowedRoles)) {

            require_once ABSPATH . '/wp-admin/includes/user.php';
            wp_delete_user($newUserId);
            exit('SOMETHING WRONG HAPPENED');
        } else {
            $user->add_role($role);
            $user->remove_role('subscriber');
        }
    }

    public function createUserProfile($newUserId)
    {
        $role = filter_input(INPUT_POST, 'user_type');
        $user = new WP_User($newUserId);

        $certificates = isset($_POST['certificates']) ? $_POST['certificates'] : [];
        //dump($_POST);
        //dump($certificates);
        // die;

        if ($role === 'teacher') {
            $postType = 'teacher-profile';
        } elseif ($role === 'student') {
            $postType = 'student-profile';
        }

        $profileId = wp_insert_post([
            'post_author' => $newUserId,
            'post_status' => 'publish',
            'post_title'  => $user->data->display_name . "'s profile",
            'post_type'   => $postType,
        ]);


        wp_set_post_terms($profileId, $certificates, 'certificate');
        // wp_set_object_terms ( $newUserId, $certificates, 'certificate' , true ) ; 
    }

    public function setUserPassword($newUserId)
    {
        $password = filter_input(INPUT_POST, 'user_password');
        wp_set_password($password, $newUserId);
    }

    /*===============================
           Contrôle du formulaire
      =============================== */

    public function checkErrors($errors)
    {
        $password0 = filter_input(INPUT_POST, 'user_password');
        $password1 = filter_input(INPUT_POST, 'user_password_confirmation');
        $role = filter_input(INPUT_POST, 'user_type');
        $allowedRoles = [
            'teacher',
            'student'
        ];
        if (!in_array($role, $allowedRoles)) {
            $errors->add(
                'role-different',
                '<strong>' . __('error: ') . '</strong> Rôle invalide'
            );
        }
        if ($password0 !== $password1) {
            $errors->add(
                'passwords-different',
                '<strong>' . __('error: ') . '</strong> Le deuxième mot de passe doit correspondre au premier'
            );
        }
        if (mb_strlen($password0) < 8) {
            $errors->add(
                'password-too-short',
                '<strong>' . __('Error: ') . '</strong> Votre mot de passe doit contenir huit caractères '
            );
        }
        if (!preg_match('/[A-Z]/', $password0)) {
            $errors->add(
                'password-no-capitalized-letter',
                '<strong>' . __('Error: ') . '</strong> Votre mot de passe doit contenir un lettre majuscule '
            );
        }
        if (!preg_match('/[a-z]/', $password0)) {
            $errors->add(
                'password-no-lowercase-letter',
                '<strong>' . __('Error: ') . '</strong> Votre mot de passe doit contenir un lettre minuscule '
            );
        }

        if (!preg_match('/[0-9]/', $password0)) {
            $errors->add(
                'password-no-number',
                '<strong>' . __('Error: ') . '</strong> Votre mot de passe doit contenir un chiffre '
            );
        }


        if (!preg_match('/\W/', $password0)) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> Votre mot de passe doit contenir un caractère special '
            );
        }

        $letterPosition = strpos($password0, '@');
        if ($letterPosition !== false) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> You can not user @   character'
            );
        }

        $letterPosition = strpos($password0, '=');
        if ($letterPosition !== false) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> You can not user  =  character'
            );
        }
        $letterPosition = strpos($password0, '"');
        if ($letterPosition !== false) {
            $errors->add(
                'password-no-special-character',
                '<strong>' . __('Error: ') . '</strong> You can not user  "  character'
            );
        }

        return $errors;
    }

    /*===============================
        Customisation du formulaire
      =============================== */


    public function loadAssets()
    {

        wp_enqueue_style(
            'login-form-css',
            get_theme_file_uri('css/userRegistration.css')
        );
        wp_enqueue_script(
           'login-form-js',
            get_theme_file_uri('js/registration.js')
        );
    }

    public function addCustomFields()
    {

        echo '
          
            <p>
                <label for="user_password">Mot de passe</label>
                <input type="password" name="user_password" id="user_password" class="input" value="" size="20" autocapitalize="off">
            </p>

            <p>
                <label for="user_password_confirmation">Confirmer votre mot de passe</label>
                <input type="password" name="user_password_confirmation" id="user_password_confirmation" class="input" value="" size="20" autocapitalize="off">
            </p>
            <div>
                <input type="radio" id="teacher" name="user_type" value="teacher" onclick="handleViewCertificate()">
                <label for="teacher">Teacher</label> 

                <input type="radio" id="student" name="user_type" value="student" onclick="handleViewCertificate()">
                <label for="student">Student</label><br>
            </div>
            
            <div id="certificate" style="display:none">';


        $certificates = get_terms('certificate',  array(
            'hide_empty' => false,
        ));

        foreach ($certificates as $index => $certificat) {

            echo '<input type="checkbox" id="certif' . $index . '" name="certificates[]" value="' . $certificat->term_id . '">' .
            '<label for="certif' . $index . '">' . $certificat->name . '</label><br>';
        }


        echo '
           </div>';
 
    
    }

}



//         <script>
            
    //         function viewCertificate() {

    //             let radioTeacher = document.querySelector("#teacher");
    //             let div = document.querySelector("#certificate");
                
                
    //             if (radioTeacher.checked == true){
    //                 div.style.display = "block";
    //             } else {
    //                 div.style.display = "none";
    //             }   
    //       </script>
    //         