<?php 

?><?php 
use Elo\Migracao;
use Elo\Coluna;
use Elo\Tabela;
return new class extends Migracao {
    public function subir():void {
        Tabela::criar("cursos", [
            "titulo" => Coluna::texto(120),
            "descricao" => Coluna::textoLongo(),
            "carga_horaria" => Coluna::inteiro(),
            "nivel" => Coluna::opcoes(["INICIANTE","INTERMEDIARIO","AVANCADO"]),
            "categoria_id" => Coluna::pertenceA("categorias")
        ]);

    
    }

        public function descer(): void
    {
        Tabela::apagar('cursos');
    }
}

?>