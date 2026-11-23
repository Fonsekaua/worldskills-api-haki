<?php 
declare(strict_types=1);
use Elo\Migracao;
use Elo\Coluna;
use Elo\Tabela;
return new class extends Migracao {
    public function subir():void {
        Tabela::criar("categorias", [
            "nome" => Coluna::texto(80)->unico(),
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