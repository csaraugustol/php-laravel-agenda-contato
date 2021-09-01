<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\ContatoRepository;
use App\Services\Contracts\ContatoServiceInterface;

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
     * @param integer $idUser
     *
     * @param string $filter
     *
     * @return ServiceResponse
     */
    public function filterSearch(int $idUser, string $filter = null): ServiceResponse
    {
        try {
            $search = $this->contatoRepository->filterSearch($idUser,  $filter);
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao buscar filtragem.');
        }

        return new ServiceResponse(
            true,
            'Filtragem realizada com sucesso.',
            $search
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
            return $this->defaultErrorReturn('Erro ao buscar nome.');
        }

        return new ServiceResponse(
            true,
            'Busca realizada com sucesso.',
            $search
        );
    }
}