<?php

namespace App\Http\Controllers;

use App\Contato;
use App\Exports\ContatosExport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {




       $contatosExcel =  ContatosExport::query();

      // dd($contatosExcel);

        //return Excel::download(new ContatosExport, 'contatos.xlsx');

        return   Excel::download(new ContatosExport, 'contatos.xlsx');


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
