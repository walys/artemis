<?php

namespace App\Http\Controllers\web\accountSettings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;

use function Termwind\render;

class AccountSettingsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        return Inertia::render('account-settings/Index');
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $userAccount = User::where('id', $user->id)->with('country', 'company')->first();
        // dd($userAccount);

        return Inertia::render('account-settings/Index', [
            'userAccount' => $userAccount
        ]);
    }

    public function update(Request $request)
    {
        return Inertia::render('account-settings/Index');
    }
}