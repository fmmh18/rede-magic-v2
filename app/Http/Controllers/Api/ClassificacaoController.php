<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\FilmeClassificacao;

class ClassificacaoController extends Controller
{
    public function index()
    {
        return FilmeClassificacao::all();
    }


    public function store(Request $request)
    {

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'classificacao' => 'required',
            'id_filme' => 'required|numeric'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            $result = FilmeClassificacao::create($input);

            return $result;
        }
        
    }

    public function show($id)
    {
        $classficacao = FilmeClassificacao::findOrfail($id);

        return $classficacao;
    }

    public function update(Request $request, $id)
    {
       
        $classficacao = FilmeClassificacao::findOrfail($id);

        $input = $request->all();

        $messages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O campo :attribute é numérico.',
        ];

        $rules = [ 
            'classficacao' => 'required',
            'id_filme' => 'required|numeric'
        ];
            
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
            return $classficacao->update($request->all());
        }
 
    }
    public function destroy($id)
    {
        $ator = FilmeClassificacao::findOrfail($id);
        $ator->delete();
    }
}
