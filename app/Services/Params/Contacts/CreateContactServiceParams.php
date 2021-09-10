<?php

namespace App\Services\Params\Contacts;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de contato
 */
class CreateContactServiceParams extends BaseServiceParams
{
    public $nome;
    public $user_id;

    /**
     * Argumento necessários para criação do contato
     *
     * @param string $nome
     * @param int    $user_id
     */
    public function __construct(
        string $nome,
        int $user_id
    ) {
        parent::__construct();
    }
}
