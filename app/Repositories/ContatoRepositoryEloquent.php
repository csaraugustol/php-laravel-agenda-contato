<?php

namespace App\Repositories;

use App\Contato;
use App\Repositories\Contracts\ContatoRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ContatoRepositoryEloquent extends BaseRepositoryEloquent implements ContatoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contato::class;
    }
}
