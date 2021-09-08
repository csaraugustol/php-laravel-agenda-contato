<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;
use App\Services\Params\Andress\CreateAndressServiceParams;

interface EnderecoServiceInterface
{
    public function find(int $idAndress): ServiceResponse;
    public function store(CreateAndressServiceParams $params): ServiceResponse;
}