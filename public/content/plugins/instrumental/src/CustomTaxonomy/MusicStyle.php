<?php

namespace Instrumental\CustomTaxonomy;


class MusicStyle
{
    public function __construct()
    {

        // IMPORTANT TAXONOMY création d'une taxonomy custom
        // DOC register_taxonomy https://developer.wordpress.org/reference/functions/register_taxonomy/

        register_taxonomy(
            'music-style',   // idenfiant de la taxonomy
            [
                'teacher-profile',
                'student-profile'
            ],   
            [
                'show_in_rest' => true, 
                'label' => 'Style de musique',
                'hierarchical' => true, 
                'public' => true 
            ]
        );
    }
}
