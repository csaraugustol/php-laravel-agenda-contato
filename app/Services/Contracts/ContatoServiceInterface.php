<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface ContatoServiceInterface
{
    public function find(int $idContact): ServiceResponse;
<<<<<<< HEAD
    public function searchEqualsName(int $idUser, string $name): ServiceResponse;
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse;
=======
>>>>>>> 63bc248cb90b710b92e02387bd4210697adf6735
}