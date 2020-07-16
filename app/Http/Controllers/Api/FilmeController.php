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

        if($request->hasFile('cartaz')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cartaz')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cartaz')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cartaz')->storeAs('public/cartaz', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

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
            $result = Filme::create([
                'nome' => $request->nome, 
                'ano' => $request->ano, 
                'cartaz' => $fileNameToStore
            ]);
            $lastID = $result->id;
            foreach($request->atores as $ator)
            {
                $ator = FilmeElenco::create([
                    'id_filme'=> $lastID,
                    'id_ator' => $ator->id
                ]);
            }
            foreach($request->diretores as $diretor)
            {
                $ator = FilmeProducao::create([
                    'id_filme'=> $lastID,
                    'id_diretor' => $diretor->id
                ]);
            }
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
