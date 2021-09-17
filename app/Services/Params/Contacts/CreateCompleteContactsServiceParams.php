<?php

namespace App\Services\Params\Contacts;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação de contato completo
 */
class CreateCompleteContactsServiceParams extends BaseServiceParams
{
    public $idUser;
    public $nome;
    public $telefones;
    public $enderecos;
    public $tags;

    /**
     * Argumento necessários para criação do contato completo
     *
     * @param int    $idUser
     * @param string $nome
     * @param array  $telefones
     * @param array  $enderecos
     * @param array  $tags
     */
    public function __construct(
        int $idUser,
        string $nome,
        array $telefones,
        array $enderecos,
        array $tags
    ) {
        parent::__construct();
    }
}
