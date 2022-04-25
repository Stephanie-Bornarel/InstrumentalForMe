<?php

namespace Instrumental\CustomTaxonomy;


class Certificate
{
    public function __construct()
    {

        // IMPORTANT TAXONOMY création d'une taxonomy custom
        // DOC register_taxonomy https://developer.wordpress.org/reference/functions/register_taxonomy/

        register_taxonomy(
            'certificate',   // idenfiant de la taxonomy
            'teacher-profile',   // la taxonomy technologie peut s'appliquer sur le CPT teacherProfile 
            [
                'show_in_rest' => true, // la taxonomy est accessible en mode API ; nécessaire pour l'éditeur de bloc (Gutemberg)
                'label' => 'Certificat',
                'hierarchical' => false, // les certificats ne  peuvent pas avoir de "certificats enfants"
                'public' => true // la taxonomy est administrable depuis le backoffice de wp
            ]
        );
    }
}
