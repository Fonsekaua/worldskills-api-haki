<?php

declare(strict_types=1);

namespace App\Requests;

use Haki\Validation\FormRequest;
use Haki\Validation\Rule;

final class CadastrarCategoriaRequest extends FormRequest
{
    public function rules(Rule $rule): array
    {
        return [
            'titulo' => $rule->text()->length(3, 80),
            "descricao" => $rule->text()->max(255)->optional(""),
            "ativa" => $rule->boolean()->optional(true)
        ];
    }
}
