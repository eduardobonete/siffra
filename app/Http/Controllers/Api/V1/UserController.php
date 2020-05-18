<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use \Illuminate\Http\Request;
use App\User;
use App\Jobs\SendUserEmail;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password)
            ]);
            SendUserEmail::dispatch($user);

            return response()->json(['message' => 'Usuário criado com id '.$user->id], 200);
        }catch(Exception $e) {
            return response()->json(['message'=> 'Falha ao salvar usuário'. $e->getMessage()], 500);
        }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try{
            $user = User::where('id', $id)
                ->update(
                    $request->all()
            );
            return response()->json(['message'=> 'Usuário alterado com sucesso'], 200);
        } catch(Exception $e) {
            return response()->json(['message'=> 'Falha ao salvar usuário'. $e->getMessage()], 500);
        }
            
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
}
