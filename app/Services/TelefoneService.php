<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\TelefoneRepository;
use App\Services\Contracts\TelefoneServiceInterface;

class TelefoneService extends BaseService implements TelefoneServiceInterface
{
   /**
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    /**
     * @param TelefoneRepository $telefoneRepository
     */
    public function __construct(TelefoneRepository $telefoneRepository)
    {
        $this->telefoneRepository = $telefoneRepository;
    }

    /**
     * Obter um telefone pelo id
     *
     * @param integer $idPhone
     *
     * @return ServiceResponse
     */
    public function find(int $idPhone): ServiceResponse
    {
        try {
            $phone = $this->telefoneRepository->findOrNull($idPhone);

            if (is_null($phone)) {
                return new ServiceResponse(
                    true,
                    'O telefone não existe.',
                    null,
                    [
                        new InternalError(
                            'O telefone não existe.',
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao procurar telefone.');
        }

        return new ServiceResponse(
            true,
            'Telefone encontrado com sucesso.',
            $phone
        );
    }


}
