<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as RequestModel;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

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
            'state' => '2',
            'payment' => $request->payment,
            'table_number' => $request->table ? $request->table : null
        ]);
    }
    
    function store(Request $request)
    {
        $cpf = $request->session()->get('CUSTOMER_CPF');
        $customer = Customer::getByCpf($cpf);

        $request = RequestModel::create([
            'customer_id' => $customer->id,
            'payment' => $request->payment,
            'table_number' => $request->table
        ]);

        return $request;
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
        $db_req->remove();
        
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
        
        $db = app('firebase.database');
        $db_req = $db->getReference("/requests/$id");

        if($request->state == 0 || $request->state == 4) {
            $request_el->actived = false;
        } 

        $db_req->set([
            'id' => $id,
            'state' => $request->state
        ]);

        $request_el->save();
        return $request_el;
    }
}
