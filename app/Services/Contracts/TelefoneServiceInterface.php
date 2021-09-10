<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;
use App\Services\Params\Phone\CreatePhoneServiceParams;

interface TelefoneServiceInterface
{
    public function find(int $idPhone): ServiceResponse;
    public function store(CreatePhoneServiceParams $params): ServiceResponse;
}
