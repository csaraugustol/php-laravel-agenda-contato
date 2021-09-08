<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\ContatoRepository;
use App\Services\Contracts\ContatoServiceInterface;
use App\Services\Contracts\TelefoneServiceInterface;
use App\Services\Params\Phone\CreatePhoneServiceParams;
use App\Services\Params\Contacts\CreateContactServiceParams;

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
     * @param CreateContactServiceParams $params
     *
     * @return ServiceResponse
     */
    public function store(CreateContactServiceParams $params): ServiceResponse
    {
        try {
            // Verifica se a contato existe
            $findContactResponse = app(ContatoService::class)->searchEqualsName($params->name);

            if (!$findContactResponse->success || is_null($findContactResponse->data)) {
                return $findContactResponse;
            }

            // Criando contato
            $createContactParams = new CreateContactServiceParams(
                $params->name,
                $params->user_id
            );

            $storeContactResponse = $this->store($createContactParams);
            if (!$storeContactResponse->success) {
                return $storeContactResponse;
            }

            $contact = $storeContactResponse->data;
        } catch (Throwable $th) {
            return $this->defaultErrorReturn($th, compact('params'));
        }

        return new ServiceResponse(
            true,
            'Contato salvo com sucesso.',
            $contact
        );
    }
}
