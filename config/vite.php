<?php

return [
    // Forzar la ruta base de los assets de Vite para entornos personalizados (como Laragon)
    'build_path' => 'public/build',
    'manifest_path' => 'public/build/manifest.json',
    'hot_file' => 'public/hot',
    'asset_url' => null, // Puedes poner una URL absoluta si usas CDN
];
