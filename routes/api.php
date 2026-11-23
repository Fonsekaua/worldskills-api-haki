<?php

declare(strict_types=1);

use App\Controllers\CategoriaController;
use App\Controllers\CursoController;
use App\Controllers\HomeController;
use Haki\Haki;

$app->get('/', [HomeController::class, 'index']);

$app->group("/api", function (Haki $app) {
    $app->group("/categorias", function (Haki $app) {
        $app->post('/', [CategoriaController::class, "cadastrar"]);
        $app->get('/', [CategoriaController::class, "verTodos"]);
        $app->get('/{id}', [CategoriaController::class, "verUm"]);
        $app->put('/', [CategoriaController::class, "atualizarUm"]);
        $app->delete('/', [CategoriaController::class, "deletarUm"]);
    });

        $app->group("/cursos", function (Haki $app) {
        $app->post('/', [CursoController::class, "cadastrar"]);
        $app->get('/', [CursoController::class, "verTodos"]);
        $app->get('/{id}', [CursoController::class, "verUm"]);
        $app->put('/', [CursoController::class, "atualizarUm"]);
        $app->delete('/', [CursoController::class, "deletarUm"]);
    });
});
