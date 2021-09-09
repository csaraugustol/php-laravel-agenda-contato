<?php

namespace App\Services\Params\Phone;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de telefone
 */
class CreatePhoneServiceParams extends BaseServiceParams
{
    public $telefone;
    public $contato_id;
   
    /**
     * Argumento necessários para criação do telefone
     *
     * @param string    $telefone
     * @param integer   $contato_id
     */
    public function __construct(
        string $telefone,
        int $contato_id
    ) {
        parent::__construct();
    }
}