<?php

namespace App\Services\Contracts;

use App\Services\Params\Contacts\CreateContactsServiceParams;
use App\Services\Responses\ServiceResponse;

interface ContatoServiceInterface
{
    public function find(int $idContact): ServiceResponse;
    public function searchEqualsName(int $idUser, string $name): ServiceResponse;
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse;
    public function store(CreateContactsServiceParams $params): ServiceResponse;
}