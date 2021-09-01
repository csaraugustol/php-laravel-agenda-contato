<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Contracts\UsuarioRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UsuarioRepositoryEloquent extends BaseRepositoryEloquent implements UsuarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
