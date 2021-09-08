<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\EnderecoRepository;
use App\Services\Contracts\EnderecoServiceInterface;
use App\Services\Params\Andress\CreateAndressServiceParams;

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

    /**
     * Criar um endereço
     *
     * @param CreateAndressServiceParams $params
     *
     * @return ServiceResponse
     */
    public function store(CreateAndressServiceParams $params): ServiceResponse
    {
        try {
            // Criando endereço
            $createAndressParams = new CreateAndressServiceParams(
                $params->postal_code,
                $params->andress,
                $params->city,
                $params->district,
                $params->number,
                $params->state,
                $params->contact_id
            );

            $storeAndressResponse = $this->store($createAndressParams);
            if (!$storeAndressResponse->success) {
                return $storeAndressResponse;
            }

            $andress = $storeAndressResponse->data;
        } catch (Throwable $th) {
            return $this->defaultErrorReturn($th, compact('params'));
        }

        return new ServiceResponse(
            true,
            'Endereço salvo com sucesso.',
            $andress
        );
    }
}
