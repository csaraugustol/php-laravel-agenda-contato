<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\DB;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\TelefoneRepository;
use App\Services\Contracts\TelefoneServiceInterface;
use App\Services\Params\Phone\CreatePhoneServiceParams;

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

    public function store(CreatePhoneServiceParams $params): ServiceResponse
    {
        DB::beginTransaction();

        try {
            // Criando telefones
            foreach ($params->phone_number as $phone_number) {
                $createPhoneServiceParams = new CreatePhoneServiceParams(
                    $params->phone_number,
                    $params->ComoPassarOIdDoContatoAqui,
                );
                $storePhoneResponse = $this->store($createPhoneServiceParams);
                if (!$storePhoneResponse->success) {
                    DB::rollback();

                    return $storePhoneResponse;
                }
            }

            DB::commit();

            $accountHolder = $storePhoneResponse->data;
        } catch (Throwable $th) {
            DB::rollback();
            return $this->defaultErrorReturn($th, compact('params'));
        }

        return new ServiceResponse(
            true,
            'Telefone salvo com sucesso.',
            $accountHolder
        );
    }
}
