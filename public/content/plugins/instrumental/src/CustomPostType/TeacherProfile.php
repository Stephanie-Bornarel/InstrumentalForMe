<?php

namespace Instrumental\CustomPostType;

class TeacherProfile
{
    public function __construct()
    {
        register_post_type(
            'teacher-profile',
            [
                'label' => 'Teacher profile',

                'show_in_rest' => true,

                'public' => true,

                'hierarchical' => false,

                'menu_icon' => 'dashicons-buddicons-buddypress-logo',

                'has_archive' => true,
                
                // NOTICE PLUGIN, fonctionnalités activable pour un cpt :  ‘title’, ‘editor’, ‘comments’, ‘revisions’, ‘trackbacks’, ‘author’, ‘excerpt’, ‘page-attributes’, ‘thumbnail’, ‘custom-fields’, and ‘post-formats’.
                'supports' => [
                    'title',
                    'excerpt',
                    'thumbnail',
                    'editor',
                    'author',
                ],

                'capability_type' => 'teacher-profile',
                'map_meta_cap' => true,
            ]
        );
    }
}
