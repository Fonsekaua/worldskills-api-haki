<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CadastrarCursoRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'titulo' => $rule->text()->length(5, 120),
            "descricao" => $rule->text()->length(min:10),
            "carga_horaria" => $rule->integer()->min(1),
            "nivel" => $rule->text(),
            "categoria_id" => $rule->integer()
        ];
    }
}
