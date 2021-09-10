<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\ContatoRepository;
use App\Services\Contracts\ContatoServiceInterface;
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
     * @param int $idContact
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
     * @param int         $idUser
     * @param string|null $filter
     *
     * @return ServiceResponse
     */
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse
    {
        try {
            $contacts = $this->contatoRepository->filterSearch($idUser, $filter);
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Já existe contato com esse nome.');
        }

        return new ServiceResponse(
            true,
            'Filtragem realizada com sucesso.',
            $contacts
        );
    }

    /**
     * Realiza contagem de um nome de contato específico do usuário logado
     * para verificar se há repetição
     *
     * @param int    $idUser
     *
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function countEqualsNameUserLogged(int $idUser, string $name): ServiceResponse
    {
        try {
            $countContactName = $this->contatoRepository->countEqualsNameUserLogged($idUser, $name);
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao buscar.');
        }

        return new ServiceResponse(
            true,
            'Filtragem realizada com sucesso.',
            $countContactName
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
            $findContactResponse = $this->countEqualsNameUserLogged($params->user_id, $params->nome);

            if (!$findContactResponse->success || $findContactResponse->data > 0) {
                return $findContactResponse;
            }

            $contact = $this->contatoRepository->create($params->toArray());
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
