<?php

namespace App\Repositories;

use App\Contato;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\ContatoRepository;
use phpDocumentor\Reflection\Types\Integer;

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
     * @param integer $idUser
     *
     * @param string $filter
     *
     * @return Collection
     */
    public function filterSearch(int $idUser, string $filter = null): Collection
    {
        $contacts = $this->where('user_id', $idUser)
            ->where(function ($query) use ($filter) {
                if (!is_null($filter)) {
                    return $query->where('nome', 'like', '%' . $filter . '%');
                }
                return;
            })
            ->orderBy('nome', 'asc')->get();

        return $contacts;
    }

    /**
     * Verificar se já existe nome cadastrado
     *
     * @param integer $idUser
     *
     * @param string $name
     *
     * @return Integer
     */
    public function searchEqualsName(int $idUser, string $name): Integer
    {
        $names = $this->where('contatos')
        ->where('nome', $name)
        ->where('user_id',  $idUser)
        ->count();

        return $names;
    }
}
