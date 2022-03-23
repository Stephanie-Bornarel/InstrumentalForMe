<?php

// Debug:
// echo __FILE__ . ':' . __LINE__;
// exit();

if (!defined('THEME_INSTRUMENTALFORME_VERSION')) {
    define('THEME_INSTRUMENTALFORME_VERSION', '1.0.0');
}

// Configure theme :
add_action(
    'after_setup_theme',
    'instrumentalforme_initializeTheme'
);


if (!function_exists('instrumentalforme_initializeTheme')) {
    function instrumentalforme_initializeTheme()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
       
    }
}

if (!function_exists('instrumentalforme_loadAssets')) {
    function instrumentalforme_loadAssets()
    {


        // ===============================================================
        // vuejs intégré en mode "yolo"
        wp_enqueue_script(
            'vuejs',
            'https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js',
            [],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'vuetify',
            'https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js',
            [],
            '1.0.0',
            true
        );

        wp_enqueue_style(
            'materialdesignicons',
            'https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css'
        );

        wp_enqueue_style(
            'vuetify',
            'https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css'
        );

        wp_enqueue_style(
            'customvuejs',
            get_theme_file_uri('css/vuejs.css')
        );


        // ===============================================================


        wp_enqueue_style(
            'instrumentalforme-styles',
            get_theme_file_uri('css/styles.css')
        );

        wp_enqueue_style(
            'font-awesome-style',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
        );

        wp_enqueue_style(
            'social-styles',
            get_theme_file_uri('css/social.css')
        );

        wp_enqueue_style(
            'instrumental-styles',
            get_theme_file_uri('css/instrumental.css')
        );

       

        wp_enqueue_style(
            'google-font-1',
            'https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900',
        );

        wp_enqueue_style(
            'google-font-2',
            'https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i'
        );



        wp_enqueue_script(
            'instrumentalforme-scripts',
            get_theme_file_uri('js/scripts.js'),
            [],
            '1.0.0',
            true
        );



        wp_enqueue_script(
            'appointment-js',
            get_theme_file_uri('js/appointment.js'),
            [],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'calendar-js',
            get_theme_file_uri('js/calendar.js'),
            [],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'fontawesome-js',
            'https://use.fontawesome.com/releases/v5.15.4/js/all.js',
            [],
            '1.0.0',
            true
        );

        wp_enqueue_script(
            'bootstrap-js',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js',
            [],
            '1.0.0',
            true
        );

       
    }
}

add_action(
    'wp_enqueue_scripts',
    'instrumentalforme_loadAssets'
);

//1 Add action : add first name and last name in the default registration form
add_action('register_form', 'myplugin_register_form');
function myplugin_register_form()
{

    $first_name = (!empty($_POST['first_name'])) ? trim($_POST['first_name']) : '';
    $last_name = (!empty($_POST['last_name'])) ? trim($_POST['last_name']) : '';

?>
    <p>
        <label for="first_name"><?php _e('Prénom', 'mydomain') ?><br />
            <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(wp_unslash($first_name)); ?>" size="25" /></label>
    </p>

    <p>
        <label for="last_name"><?php _e('Nom', 'mydomain') ?><br />
            <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(wp_unslash($last_name)); ?>" size="25" /></label>
    </p>

<?php
}

//2. Add validation. In this case, we make sure first_name and last_name is required.
add_filter('registration_errors', 'myplugin_registration_errors', 10, 3);
function myplugin_registration_errors($errors, $sanitized_user_login, $user_email)
{

    if (empty($_POST['first_name']) || !empty($_POST['first_name']) && trim($_POST['first_name']) == '') {
        $errors->add('first_name_error', __('<strong>ERROR</strong>: Vous devez ajouter votre prénom.', 'mydomain'));
    }
    if (empty($_POST['last_name']) || !empty($_POST['last_name']) && trim($_POST['last_name']) == '') {
        $errors->add('last_name_error', __('<strong>ERROR</strong>: Vous devez ajouter votre nom.', 'mydomain'));
    }
    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action('user_register', 'myplugin_user_register');
function myplugin_user_register($user_id)
{
    if (!empty($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', trim($_POST['first_name']));
        update_user_meta($user_id, 'last_name', trim($_POST['last_name']));
    }
}

// Disable admin bar for all except admin
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_filter('get_the_excerpt', function ($excerpt) {

    // Get the 250 first characters
    return substr($excerpt, 0, 250) . '...';
});

// /**
//  * Function and filter to force archive.php to display only teacher custom post types. 
//  */
// function add_custom_types_to_archive( $query ) {
//     global $post_type;
//     if( is_archive() && empty( $query->query_var['suppress_filters'] ) ) {
//         $post_type = array( 'teacher-profile' );
//         $query->set( 'post_type', $post_type );
//         return $query;
//     }
// }
// add_filter( 'pre_get_posts', 'add_custom_types_to_archive' ); 

// function wpdocs_check_user_updated($user_id, $oldUserData)
// {
//     $oldUserFirstName = $oldUserData->first_name;
//     $oldUserLastName = $oldUserData->last_name;
//     $oldUserEmail = $oldUserData->user_email;
//     $oldUserPassword = $oldUserData->user_pass;
//     $oldUserDescription = $oldUserData->description;

//     $user = get_userdata($user_id);
//     $newUserFirstName = $user->first_name;
//     $newUserLastName = $user->last_name;
//     $newUseEmail = $user->user_email;
//     $newUserPassword = $user->user_pass;
//     $newUserDescription = $user->description;

//     if ($newUserFirstName !== $oldUserFirstName) {
//         update_user_meta($user_id, 'first_name', trim($_POST['first_name']));
//     }

//     if ($newUserLastName !== $oldUserLastName) {
//         update_user_meta($user_id, 'last_name', trim($_POST['last_name']));
//     }

//     if ($newUseEmail !== $oldUserEmail) {
//         update_user_meta($user_id, 'user_email', trim($_POST['user_email']));
//     }

//     if ($newUserPassword !== $oldUserPassword) {
//         update_user_meta($user_id, 'user_pass', trim($_POST['user_pass']));
//     }

//     if ($newUserDescription !== $oldUserDescription) {
//         update_user_meta($user_id, 'description', trim($_POST['description']));
//     }
// }
// add_action('profile_update', 'wpdocs_check_user_updated', 10, 2);
