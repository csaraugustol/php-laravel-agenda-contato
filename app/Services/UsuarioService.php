<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\UsuarioRepository;
use App\Services\Contracts\UsuarioServiceInterface;

class UsuarioService extends BaseService implements UsuarioServiceInterface
{
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * @param UsuarioRepository $usuarioRepository
     */
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Obter um usuário pelo id
     *
     * @param int $idUser
     *
     * @return ServiceResponse
     */
    public function find(int $idUser): ServiceResponse
    {
        try {
            $user = $this->usuarioRepository->findOrNull($idUser);

            if (is_null($user)) {
                return new ServiceResponse(
                    true,
                    'O usuário não existe.',
                    null,
                    [
                        new InternalError(
                            'O usuário não existe.',
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao procurar usuário.');
        }

        return new ServiceResponse(
            true,
            'Usuário encontrado com sucesso.',
            $user
        );
    }
}
