<?php
declare(strict_types=1);
namespace App\Models;

use Elo\Modelo;
class Categoria extends Modelo
{
    protected array $temMuitos = ["curso" => Curso::class];
}