<?php

namespace Instrumental\Controllers;

use DateTime;
use Instrumental\Models\LessonModel;


use WP_Query;

class UserController extends CoreController
{
    public function getProfile()
    {
        $query = new WP_Query([
            'author' => get_current_user_id(),
            'post_type' => 'teacher-profile'

        ]);

        $profile = $query->post;

        return $profile;
    }

    public function home()
    {
        $this->show('views/user-home.view');
    }

    public function saveProfile()
    {
        if (!$this->isConnected()) {
            header("HTTP/1.1 403 Forbidden"); // équivalent à http_response_code(403);
            header("EasterEgg: Hello worl");
            $this->show('views/user-forbidden');
        } else {
            // mise à jour des champs acf
            acf_form_head();

            $updateProfile = filter_input(INPUT_POST, 'update-profile');
            if ($updateProfile && $this->isConnected()) {

                // TODO  controle de token csrf ( wp_nonce")
                // https://codex.wordpress.org/fr:Les_Nonces_WordPress

                // en fonction du roles du user, définition de post à mettre à jour
                $user = wp_get_current_user();
                if (in_array('teacher', $user->roles)) {
                    $postType = 'teacher-profile';
                } else {
                    $postType = 'student-profile';
                }
                $userId = $user->ID;
                

                // mise à jour des champs meta_user
                $firstName = filter_input(INPUT_POST, 'user_firstname');
                update_user_meta($user->ID, 'first_name', $firstName);

                $lastName = filter_input(INPUT_POST, 'user_lastname');
                update_user_meta($user->ID, 'last_name', $lastName);

                 $description = trim(filter_input(INPUT_POST, 'user_description'));
                 update_user_meta($user->ID,'description', $description);

                // mise à jour de l'email
                $email = trim(filter_input(INPUT_POST, 'user_email'));

                if ($email) {
                    $args = [
                        'ID' => $user->ID,
                        'user_email' => $email,
                    ];
                    wp_update_user($args);
                }


                $password = trim(filter_input(INPUT_POST, 'user_password'));
                $passwordConfirmation = trim(filter_input(INPUT_POST, 'user_password_confirmation'));
                if ($password && $password == $passwordConfirmation) {
                    // mise à jour du mot de passe
                    wp_set_password($password, $user->ID);
                }

                // =============================================================================

                // gestion des taxonomies
                
                $certificates = (filter_input(INPUT_POST, 'certificate', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY));
                $instruments = filter_input(INPUT_POST, 'instrument', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                $musicStyles = filter_input(INPUT_POST, 'musicStyle', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
              


                $userId = $user->ID;
                $query = new WP_Query([
                    'author' => $userId,
                    'post_type' => $postType
                ]);


                if (!empty($query->posts)) {
                    
                    $profile = $query->posts[0];
                    wp_set_post_terms($profile->ID, $certificates, 'certificate');
                    wp_set_post_terms($profile->ID, $instruments, 'instrument');
                    wp_set_post_terms($profile->ID, $musicStyles, 'music-style');


                    // // mise à jour de la description
                    // $description = filter_input(INPUT_POST, 'user_description');

                    // DOC https://developer.wordpress.org/reference/functions/wp_update_post/
                    // DOC https://developer.wordpress.org/reference/functions/wp_insert_post/

                    wp_update_post([
                        'ID' => $profile->ID,
                        'post_content' => $description,
                        'post_type' => $postType
                    ]);
                }

                global $router;
                header('Location: ' . $router->generate('user-home'));
            }
        }
    }
    //============================Update avatar===================================

    public function updateProfile()
    {
        acf_form_head();
        // si l'utilisateur n'est pas connecté, nous affichons une page d'erreur avec l'entête http "forbidden"
        if (!$this->isConnected()) {
            header("HTTP/1.1 403 Forbidden"); // équivalent à http_response_code(403);
            header("EasterEgg: Hello wonderland");

            $this->show('views/user-forbidden');
        } else {
            $profile = $this->getProfile();

            $this->show('views/user-update-profile.view', [
                'profile' => $profile
            ]);
        }
    }
    //===============================suppression de compte=============================

    public function deleteAccount()
    {
        $this->show('views/user-delete-account.view');
        require_once(ABSPATH . 'wp-admin/includes/user.php');
        $current_user = wp_get_current_user();
        wp_delete_user($current_user->ID);
    }

    //===============================Lesson=============================
    public function takeLesson()
    {
        $model = new LessonModel();

        $userStudent = wp_get_current_user();
        
        $datasLesson = $_POST;

        $datetime = new DateTime($datasLesson['date']);
        $date = $datetime->format('Y-m-d H:i');

        $userStudentId = $userStudent->ID;
        $userTeacherId = $datasLesson['teacherId'];
        
        $date = $datasLesson['date'];
        $instrument = $datasLesson['instrument'];

        $model->insert($userStudentId, $userTeacherId, $date, $instrument);
        global $router;

        //  redirection
        $url = $router->generate('appointment');
        header('Location: ' . $url);
    }
 

}
