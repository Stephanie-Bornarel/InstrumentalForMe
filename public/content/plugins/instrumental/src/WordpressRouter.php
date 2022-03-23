<?php

namespace Instrumental;

class WordpressRouter
{

    protected $customRoutes = [
        
        'user-all' => 'user/.*', // cette route peut remplacer toutes les précédentes
        'model-tests' => 'model-tests/.*', // accepte toutes les urls de la forme /model-tests/ANYTHING..
        'teacher-all' => 'teacher/.*',
        'student-all' => 'student/.*',
    ];

    public function __construct()
    {
        $this->registerRoutes();
    }

    public function registerRoutes()
    {
        foreach ($this->customRoutes as $routeName => $uri) {
            add_rewrite_rule(
                // regexp de validation de l'url demandée par le visiteur
                // lorsque dans l'url il y aura la chaine "user" suivi d'un "/" optionnel, suivi de n'importe quoi
                // NOTICE ROUTER attention wordpress ne gère pas le / au début de la regexp
                $uri,
                // "URL virtuelle" comprise par wordpress
                // de façon nous définissons une variable "$_GET" userRoute=true
                'index.php?' . $routeName . '=true',
                // la règle se mettre en haut de la pile de priorité (donc sera la plus importante)
                // Nous n'avons pas envie que wordpress gère avant "nous" la route
                'top'
            );
        }


        // Wp enregistre les routes en bdd, il faut rafraichir les routes
        flush_rewrite_rules();

        add_filter('query_vars', [$this, 'watchVariables']);

        add_filter('template_include', [$this, 'loadCustomRouter']);
    }

    public function watchVariables($query_vars)
    {
        foreach ($this->customRoutes as $routeName => $uri) {
            $query_vars[] = $routeName;
        }
        return $query_vars;
    }

    public function loadCustomRouter($templateFile)
    {

        // si nous sommes sur une route custom, nous ne laisson pas wordpress choisir son template
        foreach ($this->customRoutes as $routeName => $uri) {

            $variableExists = get_query_var($routeName);

            if ($variableExists) {
                // si wordpress a détecté dans l"url "virtuelle" une variable GET portant le nom d'une de nos routes ; nous chargeons le fichier qui lance notre router
                return __DIR__ . '/../router-run.php';
            }
        }

        // par défaut (si aucune route custom n'a été trouvée) ; nous laissons wordpress choisir son template
        return $templateFile;
    }
}
