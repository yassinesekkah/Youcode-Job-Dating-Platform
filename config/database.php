<?php
/**
 * Configuration globale de l'application
 */

/**
 * Configuration de la base de données
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'job_dating');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * Configuration de sécurité des sessions
 * (sans logique métier)
 */
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // mettre à 1 si HTTPS
ini_set('session.cookie_samesite', 'Strict');


define('APP_DEBUG', false); // false fel production
