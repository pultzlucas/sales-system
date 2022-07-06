<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    function login(Request $request) {
        $request->validate([
            'cpf' => 'required'
        ]);

        if(!!Customer::where('cpf', '=', $request->cpf)->first()) {
            return redirect('/dashboard');
        }

        $customer = Customer::create([
            'cpf' => $request->cpf
        ]);

        $request->session()->forget('CUSTOMER_CPF');
        session(['CUSTOMER_CPF' => $customer->cpf]);
        return redirect('/dashboard');
    }
}
