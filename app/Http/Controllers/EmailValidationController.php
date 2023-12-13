<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailValidationController extends Controller
{
    public function showForm()
    {
        return view('email_validation_form');
    }

    public function validateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $email = $request->input('email');

        try {
          
            $isValid = $this->validateEmailDomain($email);

            if ($isValid) {
                return redirect()->route('email.validation.form')->with('success', 'Email validation successful');
            } else {
                return redirect()->back()->with('error', 'Email domain validation failed');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function validateEmailDomain($email)
    {
       
        list(, $domain) = explode('@', $email);

        $mxRecords = checkdnsrr($domain, 'MX');

        return $mxRecords;
    }
}

