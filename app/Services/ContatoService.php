<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\DB;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\ContatoRepository;
use App\Services\Contracts\ContatoServiceInterface;
use App\Services\Contracts\TelefoneServiceInterface;
use App\Services\Params\Contacts\CreateContactsServiceParams;
use App\Services\Params\Phone\CreatePhoneServiceParams;
use Illuminate\Support\Facades\Auth;

class ContatoService extends BaseService implements ContatoServiceInterface
{
    /**
     * @var ContatoRepository
     */
    private $contatoRepository;

    /**
     * @param ContatoRepository $contatoRepository
     */
    public function __construct(ContatoRepository $contatoRepository)
    {
        $this->contatoRepository = $contatoRepository;
    }

    /**
     * Obter um contato pelo id
     *
     * @param integer $idContact
     *
     * @return ServiceResponse
     */
    public function find(int $idContact): ServiceResponse
    {
        try {
            $contact = $this->contatoRepository->findOrNull($idContact);

            if (is_null($contact)) {
                return new ServiceResponse(
                    true,
                    'O contato não existe.',
                    null,
                    [
                        new InternalError(
                            'O contato não existe.',
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao procurar contato.');
        }

        return new ServiceResponse(
            true,
            'Contato encontrado com sucesso.',
            $contact
        );
    }

    /**
     * Obter busca filtrada de contato
     *
     * @param integer     $idUser
     * @param string|null $filter
     *
     * @return ServiceResponse
     */
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse
    {
        try {
            // A variável tem que indicar o que ela realmente é
            $contacts = $this->contatoRepository->filterSearch($idUser, $filter);
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao buscar filtragem.');
        }

        return new ServiceResponse(
            true,
            'Filtragem realizada com sucesso.',
            $contacts
        );
    }

    /**
     * Verificar se já existe nome cadastrado
     *
     * @param integer $idUser
     *
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function searchEqualsName(int $idUser, string $name): ServiceResponse
    {
        try {
            $search = $this->contatoRepository->searchEqualsName($idUser,  $name);
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao buscar .');
        }

        return new ServiceResponse(
            true,
            'Filtragem realizada com sucesso.',
            $search
        );
    }

    /**
     * Criar contato
     *
     * @param CreateContactsServiceParams $params
     * @return ServiceResponse
     */
    public function store(CreateContactsServiceParams $params): ServiceResponse
    {
        DB::beginTransaction();

        try {
            // Verifica se a contato existe
            $findContactResponse = app(ContatoService::class)->searchEqualsName($params->name);

            if (!$findContactResponse->success || is_null($findContactResponse->data)) {
                DB::rollback();
                return $findContactResponse;
            }

            // Criação do contato
            $contact = $this->contatoRepository->create([
                'nome'            => $params->name,
                'user_id'         => Auth::user()->id
            ]);

            //Criar telefone
            $createPhoneParams = new CreatePhoneServiceParams(
                $params->phone_number,
                $contact
            );

            $storePhoneResponse = app(TelefoneServiceInterface::class)
                ->store($createPhoneParams);

            if (!$storePhoneResponse->success || is_null($storePhoneResponse->data)) {
                DB::rollback();
                return $storePhoneResponse;
            }

        } catch (\Throwable $th) {
            return $this->defaultErrorReturn($th, compact('params'));
        }

        return new ServiceResponse(
            true,
            __('services/user.user_store_successfully'),

        );
    }
}
