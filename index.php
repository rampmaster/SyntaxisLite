<?php

require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/var/cache/templates',
]);

/**
 * Resuelve para la home
 *
 * @name    index.php
 * @author  PHPost Team
 */

/*
 * -------------------------------------------------------------------
 *  Validamos que mostrar home/mi
 * -------------------------------------------------------------------
 */
    // Incluimos header
	include 'header.php';

    // Checamos...
    if($tsCore->settings['c_allow_portal'] == 1 && $tsUser->is_member == true && $_GET['do'] == 'portal')
    {
        // Portal/mi
        include('inc/php/portal.php');
    } 
    else 
    {
        // Home
        include('inc/php/posts.php');
    }
