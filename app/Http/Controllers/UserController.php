<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\animals;
use App\Models\typeanimals;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:8',
        ]);
        User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => Hash::make($validData['password']),
        ]);
        return response()->json(['message' => 'Usuario registrado'], 201);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('name', 'password'))) {
            return response()->json(['message' => 'Credenciales invalidas'], 401);
        }
        //$user = User::all();
        $user = User::where('name', $request->name)->first();
        $token = $request->user()->createToken('auth_token')->plainTextToken;
        return response()->json(
            [
                'accesToken'=>$token,
                'tokenType'=>'Bearer',
            ],
            200

        );

    }

    // Mostrar lista de animales

    public function showAnimal(){
        $a = animals::where('eliminado', 1)->get();
        return response()->json($a, 200);
    }

    // Mostrar Lista de tipos de animales

    public function showTipoAnimal(){
        $a = typeanimals::where('eliminado', 1)->get();
        return response()->json($a, 200);
    }


    //Registar Animales
        public function registerAnimal(Request $request)
        {
            $validData = $request->validate([
                'id_tiposanimal' => 'required',
                'nombre' => 'required|string|max:255',
                'imagen' => 'required',
            ]);
            animals::create([
                'id_tiposanimal' => $validData['id_tiposanimal'],
                'nombre' => $validData['nombre'],
                'imagen' => $validData['imagen'],
                'eliminado' => 1,
            ]);
            //$this->logo->store('','fotos');
            return response()->json(['message' => 'Se Registro Correctamente Animal'], 201);
        }

        // Editar Animales

        public function editAnimal($id)
        {
            $a = animals::find($id);
            if (is_null($a)) {
                return response()->json(['message' => 'Animal NO Encontrado'], 404);
            }
            return response()->json($a, 200);    
        } 

        // Actualizar Animales

        public function updateAnimal(Request $request, $id)
        {
            $a = animals::find($id);
            if (is_null($a)) {
                return response()->json(['message' => 'Animal NO encontrado'], 404);
            }
            $validateData = $request->validate([
                'id_tiposanimal' => 'required',
                'nombre' => 'required|string|max:255',
                'imagen' => 'required',
            ]);
            $a->id_tiposanimal = $validateData['id_tiposanimal'];
            $a->nombre = $validateData['nombre'];
            $a->imagen= $validateData['imagen'];
            $a->save();
            return response()->json(['message' => 'Actualizado Correctamente'], 201);
        }

        //Borrar Animal
            public function destroyAnimal($id)
                {
                    $delete = animals::find($id);
                    if (is_null($delete)) {
                        return response()->json(['message' => 'Animal NO Encontrado'], 404);
                    }
                    $delete->eliminado = 0;
                    $delete->save();
                    return response()->json(['message' => 'Eliminado Correctamente'], 200);
                }

}
