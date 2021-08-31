<?php

namespace App\Services;

use App\Services\Responses\ServiceResponse;

class BaseService
{
    /**
     * Retorno de erro padrão
     *
     * @param  string    $message
     *
     * @return array
     */
    protected function defaultErrorReturn(string $message): ServiceResponse {
        return new ServiceResponse(
            false,
            $message,
            null
        );
    }
}
