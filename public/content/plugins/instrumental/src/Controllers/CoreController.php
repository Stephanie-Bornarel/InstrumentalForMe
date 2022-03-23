<?php

namespace Instrumental\Controllers;

use WP_Query;

class CoreController
{
    public function isConnected()
    {
        return is_user_logged_in();
    }

    public function show($template, $variablesForTemplate = [])
    {
        // dans les templates nous aurons potentiellement besoin du router
        // nous devons charger le router qui a été déclaré comme étant une variable globale
        global $router;

        get_template_part(
            $template,
            null, // il est possible de donner un identifiant au template
            $variablesForTemplate
        );
    }
}
