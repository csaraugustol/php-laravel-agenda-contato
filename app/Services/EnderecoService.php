<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\EnderecoRepository;
use App\Services\Contracts\EnderecoServiceInterface;

class EnderecoService extends BaseService implements EnderecoServiceInterface
{
   /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    /**
     * @param EnderecoRepository $enderecoRepository
     */
    public function __construct(EnderecoRepository $enderecoRepository)
    {
        $this->enderecoRepository = $enderecoRepository;
    }

    /**
     * Obter um endereco pelo id
     *
     * @param integer $idAndress
     *
     * @return ServiceResponse
     */
    public function find(int $idAndress): ServiceResponse
    {
        try {
            $andress = $this->enderecoRepository->findOrNull($idAndress);

            if (is_null($andress)) {
                return new ServiceResponse(
                    true,
                    'O endereço não existe.',
                    null,
                    [
                        new InternalError(
                            'O endereço não existe.',
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao procurar endereço.');
        }

        return new ServiceResponse(
            true,
            'Endereço encontrado com sucesso.',
            $andress
        );
    }


}
