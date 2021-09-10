<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface UsuarioServiceInterface
{
    public function find(int $idUser): ServiceResponse;
}
