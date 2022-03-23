<?php
namespace Instrumental\Models;

class CoreModel
{

    protected $wpdb;


    public function __construct()
    {
        // récupération de l'objet wpdb de wordpress
        // la variable $wpdb est globale ; c'est "historique"
        // DOC E10 wpdb https://developer.wordpress.org/reference/classes/wpdb/
        global $wpdb;
        $this->wpdb = $wpdb;
    }
}
