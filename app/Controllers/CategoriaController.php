<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Models\Curso;
use App\Requests\AtualizarCategoriaRequest;
use App\Requests\CadastrarCategoriaRequest;
use App\Services\CategoriaService;
use Haki\Http\Request;
use Haki\Http\Response;

final class CategoriaController
{
    public function __construct(readonly private CategoriaService $service) {}

    public function cadastrar(CadastrarCategoriaRequest $req, Response $res): Response
    {
        $data = $req->validated();

        $categoria = $this->service->cadastrar($data);

        return $res->json([
            "mensagem" => "Categoria criada com sucesso!",
            "categoria" => $categoria
        ], 201);
    }

    public function verTodos(Response $res): Response
    {
        return $res->json([
            "mensagem" => "Lista de categorias",
            "categorias" => $this->service->verTodos()
        ], 200);
    }

    public function verUm(int $id, Response $res): Response
    {
        $categoria = $this->service->verUm($id);

        if ($categoria == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Categoria não encontrada",
                "detalhes" => [
                    "campo" => "A categoria informada (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }
        $cursos = Curso::buscarPor("categoria_id", $id);

        return $res->json([
            "status" => 200,
            "mensagem" => "Categoria encontrada",
            "categoria" => $categoria,
            "lista_cursos" => $cursos

        ], 200);
    }

    public function atualizarUm(int $id, AtualizarCategoriaRequest $req, Response $res): Response {
        $categoria = $this->service->verUm($id);

        if ($categoria == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Categoria não encontrada",
                "detalhes" => [
                    "campo" => "A categoria informada (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }
        $dados = $req->validated();

        $this->service->atualizarUm($categoria,$dados);

        return $res->json([
            "mensagem" => "Categoria atualizada com sucesso!"
        ],200);


    }


        public function deletarUm(int $id, Response $res): Response {
        $categoria = $this->service->verUm($id);

        if ($categoria == null) {
            return $res->json([
                "status" => 404,
                "erro" => "Categoria não encontrada",
                "detalhes" => [
                    "campo" => "A categoria informada (id) não consta em nosso banco de dados"
                ]

            ], 404);
        }
    

        $this->service->deletarUm($categoria);

        return $res->status(204);


    }

}
