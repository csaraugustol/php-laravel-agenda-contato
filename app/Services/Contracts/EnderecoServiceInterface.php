<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;
use App\Services\Params\Adress\CreateAdressServiceParams;

interface EnderecoServiceInterface
{
    public function find(int $idAdress): ServiceResponse;
    public function store(CreateAdressServiceParams $params): ServiceResponse;
}
