<?php
// ===============================================================
// Code inutile à modifier
// ===============================================================
global $router;

$match = $router->match();

// Si le router à validé une route
if ($match) {

    $callbackFunction = $match['target'];

    // Nous executons la fonction de callback en lui passant en argument la liste des parties "variable" de l'URL
    call_user_func_array(
        $callbackFunction,
        $match['params']
    );
} else {
    throw (new Exception('CUSTOM ROUTER : PAGE NON TROUVEE ; Y-A-T-IL UNE ROUTE DE CONFIGUREE DANS router.initialize.php')
    );
}
