<?php
/* 
Plugin Name: Instrumental
*/
use Instrumental\Plugin;

require __DIR__ .'/vendor-instrumental/autoload.php';

// STEP E9 ROUTER chargement du fichier d'initialisation du router custom
require __DIR__ .'/router-initialize.php';

//instanciation du plugin Instrumental
$pluginInstrumental = new plugin();

register_activation_hook(
   
    __FILE__, 
    [$pluginInstrumental, 'activate']
 );


 register_deactivation_hook(
    __FILE__,
    [$pluginInstrumental, 'deactivate']
 );

