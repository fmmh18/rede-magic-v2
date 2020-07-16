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
 
            $filme = Filme::create([
                'nome'=>  $request->nome,
                'ano' => $request->ano,
                'cartaz' => $fileNameToStore
            ]);
            
            $lastID = $filme->id;
            $atores = array_filter(explode(';',$request->atores));
            $diretores = array_filter(explode(';',$request->diretores));  

            for($i = 0; $i <= count($atores);$i++){
                FilmeElenco::create([
                    'filme_id'=> $lastID,
                    'ator_id' => $atores[$i]
                ]);
            } 
            for($x = 0; $x <= count($diretores);$x++){
                FilmeProducao::create([
                    'filme_id'=> $lastID,
                    'diretor_id' => $diretores[$x]
                ]); 
            }

            return  $lastID;
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
