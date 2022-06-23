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
        return RequestModel::getFullInfo($id);
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

        return RequestModel::create([
            'customer_id' => $customer->id
        ]);
    }

    function destroy($id)
    {
        if(!RequestModel::find($id))
        {
            return [
                'message' => 'Este pedido não existe'
            ];
        }
        
        if(RequestModel::destroy($id))
        {
            return [
                'message' => 'Pedido foi deletado com sucesso'
            ];
        }
        return [
            'message' => 'Erro ao deletar pedido'
        ];
    }

    function update(Request $request)
    {}
}
