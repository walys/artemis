<?php

namespace App\Http\Controllers\web\accountSettings;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use App\Services\AccountSettings\AccountSettingService;

use function Termwind\render;

class AccountSettingsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    protected $accountSettingService;

    public function __construct(AccountSettingService $accountSettingService)
    {
        $this->accountSettingService = $accountSettingService;
    }

    public function index()
    {
        dd('index');
        return Inertia::render('account-settings/Index');
    }

    public function create(Request $request)
    {
        $userAccount = $this->accountSettingService->getAccountSettings();
        return Inertia::render('account-settings/Index', [
            'userAccount' => $userAccount
        ]);
    }

    public function store(Request $request)
    {
        
    }

    public function destroy(Request $request)
    {
        
    }

    public function edit(Request $request)
    {
        dd('edit');
        return Inertia::render('account-settings/Index');
    }

    public function show(Request $request)
    {
        dd('show');
        return Inertia::render('account-settings/Index');
    }

    public function update(Request $request)
    {
        dd('update');
        return Inertia::render('account-settings/Index');
    }
}