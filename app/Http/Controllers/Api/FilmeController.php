<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Filme;
use App\Models\FilmeClassificacao;
use App\Models\FilmeElenco;
use App\Models\FilmeProducao;
use Illuminate\Support\Facades\Validator;

class FilmeController extends Controller
{

    public function index()
    {
        return Filme::all();
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
            $result = Filme::create($input);
            $lastID = $result->id;
            return $result->id;
        }
        
    }

    public function show($id)
    {
        $filme = Filme::findOrfail($id);

        return $filme;
    }

    public function update(Request $request, $id)
    {
       
        $filme = Filme::findOrfail($id);

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
            return $filme->update($request->all());
        }
 
    }

    public function destroy($id)
    {
        $filme = Filme::findOrfail($id);
        $filme->delete();
    }

}
