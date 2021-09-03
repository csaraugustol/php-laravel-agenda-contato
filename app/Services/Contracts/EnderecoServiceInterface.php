<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface EnderecoServiceInterface
{
    public function find(int $idAndress): ServiceResponse;
}