<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Curso;
use App\Requests\AtualizarCategoriaRequest;
use App\Requests\AtualizarCursoRequest;
use App\Requests\CadastrarCursoRequest;
use App\Services\CursoService;
use Haki\Http\Request;
use Haki\Http\Response;

final class CursoController
{
    public function __construct(readonly private CursoService $service) {}

    public function cadastrar(CadastrarCursoRequest $req, Response $res): Response
    {
        $data = $req->validated();

        $curso = $this->service->cadastrar($data);

        return $res->json([
            "mensagem" => "Curso criado com sucesso!",
            "curso" => $curso
        ], 201);
    }

    public function verTodos(Request $req, Response $res): Response
    {
        $categoria_id = $req->param("categoria_id");

        if ($categoria_id != null) {
            return $res->json([
                "mensagem" => "Lista de cursos",
                "cursos" => Curso::buscarPor("categoria_id", (int) $categoria_id)
            ], 200);
        }

        return $res->json([
            "mensagem" => "Lista de cursos",
            "cursos" => $this->service->verTodos()
        ], 200);
    }

    public function verUm(int $id, Response $res): Response
    {
        $curso = $this->service->verUm($id);

        if ($curso == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Curso não encontrado",
                "detalhes" => [
                    "campo" => "O Curso informado (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }

        return $res->json([
            "status" => 200,
            "mensagem" => "Curso encontrado",
            "curso" => $curso
        ], 200);
    }

    public function atualizarUm(int $id, AtualizarCursoRequest $req, Response $res): Response
    {
        $curso = $this->service->verUm($id);

        if ($curso == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Curso não encontrado",
                "detalhes" => [
                    "campo" => "O Curso informado (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }
        $dados = $req->validated();

        $this->service->atualizarUm($curso, $dados);

        return $res->json([
            "mensagem" => "Curso atualizado com sucesso!"
        ], 200);
    }


    public function deletarUm(int $id, Response $res): Response
    {
        $curso = $this->service->verUm($id);

        if ($curso == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Curso não encontrado",
                "detalhes" => [
                    "campo" => "O Curso informado (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }


        $this->service->deletarUm($curso);

        return $res->status(204);
    }
}
