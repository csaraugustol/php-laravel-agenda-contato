<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface ContatoServiceInterface
{
    public function find(int $idContact): ServiceResponse;
}