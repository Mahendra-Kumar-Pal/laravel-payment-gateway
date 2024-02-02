<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phonepe;
use PhonePe\PhonePe as Phone;

class PhonepeController extends Controller
{
    public function gpay()
    {
        return view('phonepe.gpay');
    }
}
