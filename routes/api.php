<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Controllers\CursoController;
use App\Controllers\HomeController;
use Haki\Haki;

$app->get('/', [HomeController::class, 'index']);


