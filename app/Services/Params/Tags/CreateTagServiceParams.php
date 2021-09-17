<?php

namespace App\Services\Params\Tags;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de tag
 */
class CreateTagServiceParams extends BaseServiceParams
{
    public $tag;
    public $contato_id;

    /**
     * Argumento necessários para criação da tag
     *
     * @param string      $tag
     * @param int|null    $contato_id
     */
    public function __construct(
        string $tag,
        ?int $contato_id
    ) {
        parent::__construct();
    }
}
