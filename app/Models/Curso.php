<?php

namespace App\Models;

use Elo\Modelo;

class Curso extends Modelo
{
    protected array $pertenceA = [
        "categoria" =>  [Categoria::class]
    ];
}
