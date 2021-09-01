<?php

namespace App\Repositories;

use App\Telefone;
use App\Repositories\Contracts\TelefoneRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TelefoneRepositoryEloquent extends BaseRepositoryEloquent implements TelefoneRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Telefone::class;
    }
}
