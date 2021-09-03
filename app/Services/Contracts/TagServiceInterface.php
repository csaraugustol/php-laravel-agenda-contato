<?php

namespace App\Services\Contracts;

use App\Services\Responses\ServiceResponse;

interface TagServiceInterface
{
    public function find(int $idTag): ServiceResponse;
}