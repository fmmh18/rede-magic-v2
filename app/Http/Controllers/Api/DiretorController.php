<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diretor;
use Illuminate\Support\Facades\Validator;

class DiretorController extends Controller
{

    public function index()
    {
        return Diretor::all();
    }


    public function store(Request $request)
    {

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'nome' => 'required',
            'ano' => 'required|numeric'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            $result = Diretor::create($input);

            return $result;
        }
        
    }

    public function show($id)
    {
        $diretor = Diretor::findOrfail($id);

        return $diretor;
    }

    public function update(Request $request, $id)
    {
       
        $diretor = Diretor::findOrfail($id);

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'nome' => 'required',
            'ano' => 'required|numeric'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            return $diretor->update($request->all());
        }
 
    }

    public function destroy($id)
    {
        $diretor = Diretor::findOrfail($id);
        $diretor->delete();
    }
}
