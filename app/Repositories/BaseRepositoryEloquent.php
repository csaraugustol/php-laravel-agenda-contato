<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;

/**
 * Class BaseRepositoryEloquent
 * @package namespace App\Repositories;
 */
abstract class BaseRepositoryEloquent extends BaseRepository implements BaseRepositoryInterface, CacheableInterface
{
    use CacheableRepository;

    protected $cacheMinutes = 1;

    protected $cacheOnly = ['find', 'findWhere'];

    /**
     * Metodo que busca um registro no banco pelo id,
     * ou retorna null caso não encontrado, este método
     * pode receber um id ou um uuid
     *
     * @param  string|int $id
     * @param  array  $columns
     *
     * @return Model|null
     */
    public function findOrNull($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->find($id, $columns);

        $this->resetModel();

        return $model;
    }

    /**
     * Deletar a model, independente de receber
     * um ID ou Uuid como parâmetro para remoção
     *
     * @param int|string $id
     *
     * @return Model|null
     */
    public function delete($id)
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->findOrNull($id);

        $model->delete();

        $this->resetModel();

        return $model;
    }
}
