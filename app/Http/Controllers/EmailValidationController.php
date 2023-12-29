<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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
          
            $isValidDomain = $this->validateEmailDomain($email);
            $isvalidDisposal = $this->checkDisposableDomain($email);
            $result = $this->checkDisposableDomain($email);
            
            if ($isValidDomain && $isvalidDisposal ) {
                return redirect()->route('email.validation.form')->with('success', 'Email validation successful')->with('disposalStatus',$result);
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

    private function checkDisposableDomain($email)
    {
        
        $userEmailDomain = strtolower(explode('@', $email)[1]);
        $filePath = storage_path('app/domains.txt');
        $content = Storage::get('domains.txt');
        $disposableDomains = array_map('trim', array_map('strtolower', explode("\n", $content)));
        $result = in_array($userEmailDomain, $disposableDomains) ? 'Disposable' : 'Not Disposable';

        return $result;
    }

}

