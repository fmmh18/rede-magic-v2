<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ator;
use Illuminate\Support\Facades\Validator;

class AtorController extends Controller
{

    public function index()
    {
        return Ator::all();
    }


    public function store(Request $request)
    {

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'nome' => 'required'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            $result = Ator::create($input);

            return $result;
        }
        
    }

    public function show($id)
    {
        $ator = Ator::findOrfail($id);

        return $ator;
    }

    public function update(Request $request, $id)
    {
       
        $ator = Ator::findOrfail($id);

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'nome' => 'required'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            return $ator->update($request->all());
        }
 
    }

    public function destroy($id)
    {
        $ator = Ator::findOrfail($id);
        $ator->delete();
    }
}
