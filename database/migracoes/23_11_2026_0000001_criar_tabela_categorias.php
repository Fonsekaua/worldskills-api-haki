<?php 
use Elo\Migracao;
use Elo\Coluna;
use Elo\Tabela;
return new class extends Migracao {
    public function subir():void {
        Tabela::criar("categorias", [
            "titulo" => Coluna::texto(120),
            "descricao" => Coluna::textoLongo(),
            "ativa" => Coluna::booleano()->padrao(true)
        ]);
    }
}

?>