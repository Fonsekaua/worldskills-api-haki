<?php

use App\Models\Curso;

final class CursoService {
    public function __construct() {}

    public function cadastrar(array $dados):Curso {
        $curso = Curso::criar($dados);
        return $curso;
    }

    public function verTodos(): Array {
        $cursos = Curso::buscarTodos();
        return $cursos;
    }

    public function verUm(int $id): Curso {
        $curso = Curso::buscar($id);
        return $curso;
    }

    public function atualizarUm(Curso $curso, array $dados): void {
        $curso->atualizar($dados);
    }

    public function deletarUm(Curso $curso) {
        $curso->excluir();
    }
}   

?>