<?php

namespace App\Services\Params\Andress;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação do endereço
 */
class CreateAndressServiceParams extends BaseServiceParams
{
    public $postal_code;
    public $andress;
    public $city;
    public $district;
    public $number;
    public $state;
    public $contact_id;
   
    /**
     * Argumento necessários para criação do endereço
     *
     * @param string     $postal_code
     * @param string     $andress
     * @param string     $city
     * @param string     $district
     * @param string     $number
     * @param string     $state
     * @param integer    $contact_id
     */
    public function __construct(
        string $tag,
        int $contact_id
    ) {
        parent::__construct();
    }
}