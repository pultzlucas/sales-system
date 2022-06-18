<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Models\Customer;
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

    function store(Request $request)
    {
        $customer = Customer::where('ip_address', '=', $request->ip())->first();
        if(!$customer)
        {
            $customer = Customer::create([
                'ip_address' => $request->ip()
            ]);
        }

        if(Customer::alreadyRequest($customer->id))
        {
            return response()->json([
                'message' => 'Não é permitido fazer 2 ou mais pedidos ao mesmo tempo'
            ], 401);
        }

        return RequestModel::create([
            'state' => 'pending',
            'customer_id' => $customer->id
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
