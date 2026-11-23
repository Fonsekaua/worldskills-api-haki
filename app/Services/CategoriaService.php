<?php
declare(strict_types=1);
namespace App\Services;
use App\Models\Categoria;

final class CategoriaService {
    public function __construct() {}

    public function cadastrar(array $dados):Categoria {
        $categoria = Categoria::criar($dados);
        return $categoria;
    }

    public function verTodos(): Array {
        $cursos = Categoria::buscarTodos();
        return $cursos;
    }

    public function verUm(int $id): Categoria {
        $categoria = Categoria::buscar($id);
        return $categoria;
    }

    public function atualizarUm(Categoria $categoria, array $dados): void {
        $categoria->atualizar($dados);
    }

    public function deletarUm(Categoria $categoria) {
        $categoria->excluir();
    }
}   

?>