<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    function index()
    {
        return RequestModel::all();
    }
    
    function get($id)
    {
        $request = RequestModel::findOrFail($id);
        $request_products = DB::select("SELECT prod.description, prod.price FROM products AS prod
            JOIN request_products AS rp ON rp.product_id=prod.id 
            WHERE rp.request_id=$id");
        $total_price = array_reduce($request_products, function($total, $item) {return $total + $item->price;}, 0.00);

        $request->items = $request_products;
        $request->total_price = $total_price;

        return $request;
    }

    function store()
    {
        return RequestModel::create([
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
