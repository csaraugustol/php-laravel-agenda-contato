<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface TelefoneServiceInterface
{
    public function find(int $idPhone): ServiceResponse;
}