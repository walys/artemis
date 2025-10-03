<?php

namespace App\Http\Controllers\web\settings;

use App\Models\auth\User;
use function Termwind\render;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as Controller;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CompanyController extends Controller
{

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $user = User::find(Auth::user()->id)->with('company')->first();
        $company = $user->company::with('country:id,name')->first();

        return Inertia::render('settings/company/Index' , [
            'company' => $company,
        ]);
    }
}