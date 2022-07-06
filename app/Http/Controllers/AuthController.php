<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AuthController extends Controller
{
    function login(Request $request) {
        $request->validate([
            'cpf' => 'required'
        ]);

        // validate cpf
        if (strlen($request->cpf) != 11 || cpfHasInvalidSequence($request->cpf)) {
            return redirect('/')->with('error', 'CPF inválido');
        }

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

function cpfHasInvalidSequence($cpf) {
    return $cpf == '00000000000' || 
    $cpf == '11111111111' || 
    $cpf == '22222222222' || 
    $cpf == '33333333333' || 
    $cpf == '44444444444' || 
    $cpf == '55555555555' || 
    $cpf == '66666666666' || 
    $cpf == '77777777777' || 
    $cpf == '88888888888' || 
    $cpf == '99999999999';
}
