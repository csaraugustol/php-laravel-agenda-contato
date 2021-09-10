<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;
use App\Services\Params\Tags\CreateTagServiceParams;

interface TagServiceInterface
{
    public function find(int $idTag): ServiceResponse;
    public function store(CreateTagServiceParams $params): ServiceResponse;
}
