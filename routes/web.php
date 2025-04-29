<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'API para gerenciamento de clientes',
        'version' => '1.0.0',
        'author' => 'Daniel Moreira',
        'email' => 'danielthoot@gmail.com',
        'github' => 'https://github.com/danielandrade-dev',
    ]);
});
