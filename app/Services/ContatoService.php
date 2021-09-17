<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\DB;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Services\Contracts\TagServiceInterface;
use App\Repositories\Contracts\ContatoRepository;
use App\Services\Contracts\ContatoServiceInterface;
use App\Services\Contracts\EnderecoServiceInterface;
use App\Services\Contracts\TelefoneServiceInterface;
use App\Services\Params\Tags\CreateTagServiceParams;
use App\Services\Params\Phone\CreatePhoneServiceParams;
use App\Services\Params\Adress\CreateAdressServiceParams;
use App\Services\Params\Contacts\CreateContactServiceParams;
use App\Services\Params\Contacts\CreateCompleteContactsServiceParams;

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
            $countContactName = $this->contatoRepository
                ->countEqualsNameUserLogged($idUser, $name);
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
            $findContactResponse = $this->countEqualsNameUserLogged(
                $params->user_id,
                $params->nome
            );
            if (!$findContactResponse->success || $findContactResponse->data > 0) {
                return new ServiceResponse(
                    false,
                    'Já existe um contato cadastrado com este nome.'
                );
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

    /**
     * Criar contato com nome, telefones, endereços e tags
     *
     * @param CreateCompleteContactsServiceParams $params
     *
     * @return ServiceResponse
     */
    public function storeCompleteContacts(CreateCompleteContactsServiceParams $params): ServiceResponse
    {
        DB::beginTransaction();

        try {
            //Criação do contato
            $createContactParams = new CreateContactServiceParams(
                $params->idUser,
                $params->nome
            );
            $storeContactResponse = $this->store($createContactParams);
            if (!$storeContactResponse->success) {
                DB::rollback();
                return $storeContactResponse;
            }
            $contact = $storeContactResponse->data;

            //Criação de telefone
            foreach ($params->telefones as $phone) {
                $createPhoneParams = new CreatePhoneServiceParams(
                    $phone,
                    $contact->id
                );

                $storePhoneResponse = app(TelefoneServiceInterface::class)
                    ->store($createPhoneParams);

                if (!$storePhoneResponse->success) {
                    DB::rollback();
                    return $storePhoneResponse;
                }
            }

            //Criação de endereço
            foreach ($params->enderecos as $address) {
                $createAddressParams = new CreateAdressServiceParams(
                    $address['cep'],
                    $address['endereco'],
                    $address['cidade'],
                    $address['bairro'],
                    $address['numero'],
                    $address['uf'],
                    $contact->id
                );
                $storeAddressResponse = app(EnderecoServiceInterface::class)
                    ->store($createAddressParams);
                if (!$storeAddressResponse->success) {
                    DB::rollback();
                    return $storeAddressResponse;
                }
            }

            //Criação da tag
            foreach ($params->tags as $contactTag) {
                $createTagParams = new CreateTagServiceParams(
                    $contactTag,
                    $contact->id
                );
                $storeTagResponse = app(TagServiceInterface::class)
                    ->store($createTagParams);
                if (!$storeTagResponse->success) {
                    DB::rollBack();
                    return $storeTagResponse;
                }
            }
        } catch (Throwable $th) {
            DB::Rollback();
            return $this->defaultErrorReturn($th, compact('params'));
        }

        DB::commit();

        return new ServiceResponse(
            true,
            'Contato salvo com sucesso.',
            $contact
        );
    }
}
