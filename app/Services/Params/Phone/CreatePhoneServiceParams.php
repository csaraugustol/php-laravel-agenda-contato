<?php

namespace App\Services\Params\Phone;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de telefone
 */
class CreatePhoneServiceParams extends BaseServiceParams
{
    public $phone_number;
    public $contact_id;
   
    /**
     * Argumento necessários para criação do telefone
     *
     * @param string $phone_number,
     * @param int $contact_id,
     */
    public function __construct(
        string $phone_number,
        string $contact_id
    ) {
        parent::__construct();
    }
}