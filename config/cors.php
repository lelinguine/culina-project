<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['*'], // Autorise tous les chemins

    'allowed_methods' => ['*'], // Autorise toutes les méthodes (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['*'], // Autorise toutes les origines (tous les domaines)

    'allowed_origins_patterns' => [], // Aucune restriction supplémentaire sur les origines par motifs

    'allowed_headers' => ['*'], // Autorise tous les en-têtes

    'exposed_headers' => [], // Aucun en-tête exposé supplémentaire

    'max_age' => 0, // Pas de mise en cache pour les réponses CORS

    'supports_credentials' => true, // Permet l'envoi de cookies (utile pour l'authentification via Sanctum ou autres sessions)

];
