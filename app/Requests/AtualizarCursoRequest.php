<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class AtualizarCursoRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'titulo' => $rule->text()->length(5, 120)->optional(),
            "descricao" => $rule->text()->min(10)->optional(),
            "carga_horaria" => $rule->integer()->min(1)->optional(),
            "nivel" => $rule->text()->optional(),
            "categoria_id" => $rule->integer()->optional()
        ];
    }
}
