<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as RequestModel;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address'];

    static function alreadyRequest($customer_id)
    {
        return !!RequestModel::where('customer_id', '=', $customer_id)->first();
    }
}
