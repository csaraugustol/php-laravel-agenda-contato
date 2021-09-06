<?php

namespace App\Services\Params\Contacts;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de contato
 */
class CreateContactsServiceParams extends BaseServiceParams
{
    public $name;
    public $user_id;
 
    /**
     * Argumento necessários para criação do contato
     *
     * @param string $name,
     * @param string $user_id
     */
    public function __construct(
        string $name,
        string $user_id
    ) {
        parent::__construct();
    }
}