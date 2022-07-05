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

    function getByState($state)
    {
        return RequestModel::getAllFullInfoByState((string) $state);
    }

    function adminStore(Request $request) {
        return RequestModel::create([
            'state' => '2'
        ]);
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
            'customer_id' => $customer->id,
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

        $db = app('firebase.database');
        $db_req = $db->getReference("/requests/$id");
        $db_req->set(null);
        
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

    function update($id, Request $request)
    {
        $request_el = RequestModel::findOrFail($id);
        $request_el->state = $request->state;
        $request_el->save();

        $db = app('firebase.database');
        $db_req = $db->getReference("/requests/$id");
        $db_req->set([
            'id' => $id,
            'state' => $request->state
        ]);

        return $request_el;
    }
}
