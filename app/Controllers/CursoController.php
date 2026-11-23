<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
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
        $categoria = Categoria::buscar($data["categoria_id"]);
        if ($categoria == null || $categoria->ativa == false) {
            return $res->json([
                "status" => 404,
                "erro" => "Erro na categoria",
                "detalhes" => [
                    "linha" => "categoria",
                    "mensagem" => "Categoria não existe ou não se encontra ativa"
                ]

            ], 400);
        }
        if ($data["nivel"] == "INICIANTE" || $data["mivel"] == "INTERMEDIARIO" || $data['nivel'] == "AVANCADO") {
            $curso = $this->service->cadastrar($data);

            return $res->json([
                "mensagem" => "Curso criado com sucesso!",
                "curso" => $curso
            ], 201);
        }

        return $res->json([
            "erro" => "Dados inválidos",
            "status" => 422,
            "campos" => [
                "nivel" => ["O campo nivel precisa ser INICIANTE OU INTERMEDIARIO OU AVANCADO."],
            ]
        ]);
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
                    "campo" => "id",
                    "mensagem" => "O Curso informado (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }

        return $res->json([
            "status" => 200,
            "mensagem" => "Curso encontrado",
            "curso" => $curso,
            "categoria_curso" => Categoria::buscar($curso->categoria_id)
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
                    "campo" => "id",
                    "mensagem" => "O Curso informado (id) não consta em nosso banco de dados"
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
                    "campo" => "id",
                    "mensagem" => "O Curso informado (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }


        $this->service->deletarUm($curso);

        return $res->status(204);
    }
}
