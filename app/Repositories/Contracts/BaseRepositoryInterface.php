<?php

namespace App\Repositories\Contracts;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BaseRepositoryInterface
 * @package namespace App\Repositories\Contracts;
 */
interface BaseRepositoryInterface extends RepositoryInterface
{
    public function model();
    public function updateNotIn($notInColumn, array $notInValues, array $attributes);
    public function countWhere(array $where): int;
    public function getQueryFile($filename, array $params);
    public function syncByDate(Carbon $timestamp = null): LengthAwarePaginator;
}
