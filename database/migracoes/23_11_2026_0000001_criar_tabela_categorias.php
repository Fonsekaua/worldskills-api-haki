<?php 
use Elo\Migracao;
use Elo\Coluna;
use Elo\Tabela;
return new class extends Migracao {
    public function subir():void {
        Tabela::criar("categorias", [
            "titulo" => Coluna::texto(80),
            "descricao" => Coluna::texto(255),
            "ativa" => Coluna::booleano()->padrao(true)
        ]);

    
    }

        public function descer(): void
    {
        Tabela::apagar('categorias');
    }
}

?>