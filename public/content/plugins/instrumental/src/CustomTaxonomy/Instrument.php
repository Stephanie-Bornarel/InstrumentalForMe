<?php

namespace Instrumental\CustomTaxonomy;


class Instrument
{
    public function __construct()
    {

        // IMPORTANT TAXONOMY création d'une taxonomy custom
        // DOC register_taxonomy https://developer.wordpress.org/reference/functions/register_taxonomy/

        register_taxonomy(
            'instrument',   // idenfiant de la taxonomy
            
                'teacher-profile',
                
           
            [
                'show_in_rest' => true, 
                'label' => 'Instrument',
                'hierarchical' => true, 
                'public' => true 
            ]
        );
    }
}
