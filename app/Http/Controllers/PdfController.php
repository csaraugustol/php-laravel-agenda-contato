<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Contato;
use PDF;
use App\Exports\ContatosExport;


class PdfController extends Controller
{
    public function retornaContPdf()
    {


        $contatos = ContatosExport::query();


        $pdf = PDF::loadView('exportacao.pdf', ['contatos' => $contatos])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->stream('contatos.pdf');
    }

    public function find(string $idUser): ServiceResponse
    {
        try {
            $user = $this->userRepository->findOrNull($idUser);

            if (is_null($user)) {
                return new ServiceResponse(
                    true,
                    __('services/user.user_not_found'),
                    null,
                    [
                        new InternalError(
                            __('services/user.user_not_found'),
                            146001001
                        )
                    ]
                );
            }
        } catch (Throwable $th) {
            return $this->defaultErrorReturn($th, compact('idUser'));
        }

        return new ServiceResponse(
            true,
            __('services/user.user_found_successfully'),
            $user
        );
    }
}
