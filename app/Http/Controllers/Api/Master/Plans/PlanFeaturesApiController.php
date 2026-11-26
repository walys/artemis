<?php

namespace App\Http\Controllers\Api\Master\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans\PlanFeature;
use App\Services\Plans\PlanFeatureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanFeaturesApiController extends Controller
{
    public function __construct(
        protected PlanFeatureService $planFeatureService
    ) {}

    /**
     * Lista os planos e suas funcionalidades.
     */
    public function index(): JsonResponse
    {
        $features = $this->planFeatureService->index();

        return response()->json([
            'features' => $features,
        ]);
    }

    /**
     * Cadastra as funcionalidades de um plano.
     */
    public function store(Request $request): JsonResponse
    {
        $this->normalize($request);
        $data = $request->validate([
            'plan_id' => [
                'required',
                'integer',
                'exists:plans,id',
                'unique:plan_features,plan_id',
            ],

            'max_exams' => ['required', 'integer', 'min:-1'],
            'max_laboratories' => ['required', 'integer', 'min:-1'],
            'max_users' => ['required', 'integer', 'min:-1'],
            'max_branches' => ['required', 'integer', 'min:-1'],

            'reports' => ['required', 'boolean'],
            'financial_management' => ['required', 'boolean'],
            'custom_branding' => ['required', 'boolean'],
            'data_export' => ['required', 'boolean'],
        ]);

        $feature = $this->planFeatureService->store($data);

        return response()->json([
            'message' => __('Funcionalidades cadastradas com sucesso.'),
            'feature' => $feature,
        ], 201);
    }

    /**
     * Exibe as funcionalidades de um plano.
     */
    public function show(PlanFeature $planFeature): JsonResponse
    {
        $feature = $this->planFeatureService->show($planFeature);
        return response()->json([
            'feature' => $feature,
        ]);
    }

    /**
     * Atualiza as funcionalidades de um plano.
     */
    public function update(Request $request, PlanFeature $planFeature): JsonResponse 
    {
        $this->normalize($request);
        $data = $request->validate([
            'plan_id' => [
                'sometimes',
                'integer',
                'exists:plans,id',
                Rule::unique('plan_features', 'plan_id')
                    ->ignore($planFeature->id),
            ],

            'max_exams' => ['sometimes', 'integer', 'min:-1'],
            'max_laboratories' => ['sometimes', 'integer', 'min:-1'],
            'max_users' => ['sometimes', 'integer', 'min:-1'],
            'max_branches' => ['sometimes', 'integer', 'min:-1'],

            'reports' => ['sometimes', 'boolean'],
            'financial_management' => ['sometimes', 'boolean'],
            'custom_branding' => ['sometimes', 'boolean'],
            'data_export' => ['sometimes', 'boolean'],
        ]);

        $feature = $this->planFeatureService->update(
            $planFeature,
            $data
        );

        return response()->json([
            'message' => __('Funcionalidades atualizadas com sucesso.'),
            'feature' => $feature,
        ]);
    }

    /**
     * Exclui as funcionalidades de um plano.
     */
    public function destroy(PlanFeature $planFeature): JsonResponse
    {
        $this->planFeatureService->destroy($planFeature);

        return response()->json([
            'message' => __('Funcionalidades excluídas com sucesso.'),
        ]);
    }

    private function normalize(Request $request): void
    {
        $fields = [
            'reports',
            'financial_management',
            'custom_branding',
            'data_export',
        ];

        foreach ($fields as $field) {
            $value = $request->input($field);

            if (is_array($value) && array_key_exists('value', $value)) {
                $request->merge([
                    $field => $value['value'],
                ]);
            }
        }
    }
}
