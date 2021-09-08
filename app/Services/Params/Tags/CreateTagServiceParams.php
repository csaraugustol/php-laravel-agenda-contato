<?php

namespace App\Services\Params\Tags;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de tag
 */
class CreateTagServiceParams extends BaseServiceParams
{
    public $tag;
    public $contact_id;

    /**
     * Argumento necessários para criação da tag
     *
     * @param string    $tag
     * @param integer   $contact_id
     */
    public function __construct(
        string $tag,
        int $contact_id
    ) {
        parent::__construct();
    }
}
