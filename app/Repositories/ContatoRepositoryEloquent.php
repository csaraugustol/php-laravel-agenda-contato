<?php

namespace App\Repositories;

use App\Contato;
use Illuminate\Database\Eloquent\Collection;
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

    /**
     * Obter busca filtrada de contato
     *
     * @param int $idUser
     *
     * @param string $filter
     *
     * @return Collection
     */
    public function filterSearch(int $idUser, string $filter = null): Collection
    {
        $contacts = $this
            ->where('user_id', $idUser)
            ->where(function ($query) use ($filter) {
                if (!is_null($filter)) {
                    return $query->where('nome', 'like', '%' . $filter . '%');
                }
            })
            ->orderBy('nome', 'asc')
            ->get();

        return $contacts;
    }

    /**
     * Realiza contagem de um nome de contato específico do usuário logado
     * para verificar se há repetição
     *
     * @param int $idUser
     *
     * @param string $name
     *
     * @return int
     */
    public function countEqualsNameUserLogged(int $idUser, string $name): int
    {
        $countNames = $this->model
            ->where('nome', $name)
            ->where('user_id', $idUser)
            ->count();

        return $countNames;
    }
}
