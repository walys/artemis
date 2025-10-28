<?php

namespace App\Http\Controllers\api\V1\AccountSettings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use App\Services\AccountSettings\AccountSettingService;

class ApiAccountSettingsController extends Controller
{

    protected $accountSettingService;

    public function __construct(AccountSettingService $accountSettingService)
    {
        $this->accountSettingService = $accountSettingService;
    }

    public function index(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        dd('store', $request->all());
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "cpf" => "required",
            "email" => "required",
            "birthday" => "required",
            "country" => "required",
            'country_id' => "required",
            "language" => "required",
            "phone_mobile" => "required",
        ]);

        // if($request->fails()){
        //     return array(
        //         'message' => $request->errors(),
        //         'status' => 422
        //     );
        // }

        return $this->accountSettingService->save($request);
    }

    public function destroy(Request $request)
    {
        
    }
}