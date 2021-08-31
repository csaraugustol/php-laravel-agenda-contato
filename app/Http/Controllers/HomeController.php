<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contato;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::where("user_id", Auth::user()
        ->id)
        ->orderBy('nome', 'asc')
        ->get();
        return view('contato.index', ['contatos' =>  $contatos]);


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
