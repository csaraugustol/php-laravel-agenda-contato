<?php

namespace App\Services\Params\Contacts;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de contato
 */
class CreateContactServiceParams extends BaseServiceParams
{
    public $name;
    public $user_id;
 
    /**
     * Argumento necessários para criação do contato
     *
     * @param string    $name
     * @param integer   $user_id
     */
    public function __construct(
        string $name,
        int $user_id
    ) {
        parent::__construct();
    }
}