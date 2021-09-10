<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;
use App\Services\Params\Contacts\CreateContactServiceParams;

interface ContatoServiceInterface
{
    public function find(int $idContact): ServiceResponse;
    public function store(CreateContactServiceParams $params): ServiceResponse;
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse;
    public function countEqualsNameUserLogged(int $idUser, string $name): ServiceResponse;
}
