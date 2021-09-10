<?php

namespace App\Services\Params\Adress;

use App\Services\Params\BaseServiceParams;

/**
 * Parâmetros para criação do endereço
 */
class CreateAdressServiceParams extends BaseServiceParams
{
    public $cep;
    public $endereco;
    public $cidade;
    public $bairro;
    public $numero;
    public $uf;
    public $contato_id;

    /**
     * Argumento necessários para criação do endereço
     *
     * @param string $cep
     * @param string $endereco
     * @param string $cidade
     * @param string $district
     * @param string $numero
     * @param string $uf
     * @param int    $contato_id
     */
    public function __construct(
        string $cep,
        string $endereco,
        string $cidade,
        string $bairro,
        string $numero,
        string $uf,
        int $contato_id
    ) {
        parent::__construct();
    }
}
