<?php

namespace App\Services;

use Throwable;
use App\Services\Responses\InternalError;
use App\Services\Responses\ServiceResponse;
use App\Repositories\Contracts\TagRepository;
use App\Services\Contracts\TagServiceInterface;

class TagService extends BaseService implements TagServiceInterface
{
   /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Obter uma tag pelo id
     *
     * @param integer $idTag
     *
     * @return ServiceResponse
     */
    public function find(int $idTag): ServiceResponse
    {
        try {
            $tag = $this->tagRepository->findOrNull($idTag);

            if (is_null($tag)) {
                return new ServiceResponse(
                    true,
                    'A Tag não existe.',
                    null,
                    [
                        new InternalError(
                            'A Tag não existe.',
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn('Erro ao procurar tag.');
        }

        return new ServiceResponse(
            true,
            'Tag encontrada com sucesso.',
            $tag
        );
    }


}
