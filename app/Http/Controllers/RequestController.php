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

        // if(Customer::alreadyRequest($customer->id))
        // {
        //     return response()->json([
        //         'message' => 'Não é permitido fazer 2 ou mais pedidos ao mesmo tempo'
        //     ], 401);
        // }

        return RequestModel::create([
            'state' => '1',
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
