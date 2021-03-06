<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as RequestModel;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['cpf'];
    public $timestamps = false;

    static function getByCpf($cpf) {
        return Customer::where('cpf', '=', $cpf)->first();
    }

    static function alreadyRequest($customer_id)
    {
        $requests = Customer::getAllRequests($customer_id);
        foreach($requests as $req) {
            if($req->actived) {
                return true;
            }
        }
        return false;
    }

    static function getAllRequests($customer_id)
    {
        return RequestModel::where('customer_id', '=', $customer_id)->get();
    }

    static function getActivedRequest($customer_id)
    {
        return RequestModel::where([
            ['customer_id', '=', $customer_id],
            ['actived', '=', '1']
        ])->first();
    }
}
