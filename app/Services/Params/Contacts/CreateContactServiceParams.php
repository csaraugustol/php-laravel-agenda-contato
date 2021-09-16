<?php

namespace App\Services\Params\Contacts;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de contato
 */
class CreateContactServiceParams extends BaseServiceParams
{
    public $user_id;
    public $nome;

    /**
     * Argumento necessários para criação do contato
     *
     * @param int    $user_id
     * @param string $nome
     */
    public function __construct(
        int $user_id,
        string $nome
    ) {
        parent::__construct();
    }
}
