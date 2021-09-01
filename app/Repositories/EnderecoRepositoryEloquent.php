<?php

namespace App\Repositories;

use App\Endereco;
use App\Repositories\Contracts\EnderecoRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EnderecoRepositoryEloquent extends BaseRepositoryEloquent implements EnderecoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Endereco::class;
    }
}
