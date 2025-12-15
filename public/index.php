<?php
// ========================================
// MODE MAINTENANCE TEMPORAIRE
// ========================================
$maintenance = true;

// IP autorisées (accès au site même en maintenance)
$allowedIps = [
    '46.231.218.218',
];

$clientIp = $_SERVER['REMOTE_ADDR'] ?? '';

if ($maintenance && !in_array($clientIp, $allowedIps, true)) {

    http_response_code(503);
    header('Retry-After: 3600');
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site temporairement indisponible</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

        <style>
            body {
                margin: 0;
                height: 100vh;
                background: #96A596;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Open Sans', sans-serif;
                color: #ffffff;
            }

            .maintenance {
                text-align: center;
            }

            .maintenance img.logo {
                max-width: 180px;
                margin-bottom: 30px;
            }

            .maintenance h1 {
                font-weight: 600;
                font-size: 28px;
                margin: 0 0 10px;
                letter-spacing: 0.5px;
            }

            .maintenance p {
                font-size: 16px;
                opacity: 0.9;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div class="maintenance">
            <img class="logo" src="/uploads/images/bzs0.png" alt="Logo">
            <h1>Site temporairement indisponible</h1>
            <p>
                Nous procédons actuellement à une mise à jour.<br>
                Merci de votre compréhension.
            </p>
        </div>
    </body>
    </html>
    <?php
    die();
}

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
