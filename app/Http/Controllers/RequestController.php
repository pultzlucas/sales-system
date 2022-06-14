<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    function index()
    {
        return RequestModel::all();
    }
    
    function get($id)
    {
        return RequestModel::findOrFail($id);
    }

    function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        return RequestModel::create([
            'product_id' => $request->product_id,
            'state' => 'pending'
        ]);
    }

    function destroy($id)
    {
        if(!RequestModel::find($id))
        {
            return [
                'message' => 'Este comando não existe'
            ];
        }
        
        if(RequestModel::destroy($id))
        {
            return [
                'message' => 'Comando foi deletado com sucesso'
            ];
        }
        return [
            'message' => 'Erro ao deletar comando'
        ];
    }

    function update(Request $request)
    {}
}
