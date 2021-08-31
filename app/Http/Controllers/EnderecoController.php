<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
