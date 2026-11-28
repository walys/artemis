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
        ], [
            'plan_id.required' => __('Selecione um plano.'),
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),
            'plan_id.unique' => __('Este plano já possui funcionalidades cadastradas.'),

            'max_exams.required' => __('Informe o limite de exames.'),
            'max_exams.integer' => __('O limite de exames deve ser um número inteiro.'),
            'max_exams.min' => __('O limite de exames deve ser no mínimo -1.'),

            'max_laboratories.required' => __('Informe o limite de laboratórios.'),
            'max_laboratories.integer' => __('O limite de laboratórios deve ser um número inteiro.'),
            'max_laboratories.min' => __('O limite de laboratórios deve ser no mínimo -1.'),

            'max_users.required' => __('Informe o limite de usuários.'),
            'max_users.integer' => __('O limite de usuários deve ser um número inteiro.'),
            'max_users.min' => __('O limite de usuários deve ser no mínimo -1.'),

            'max_branches.required' => __('Informe o limite de filiais.'),
            'max_branches.integer' => __('O limite de filiais deve ser um número inteiro.'),
            'max_branches.min' => __('O limite de filiais deve ser no mínimo -1.'),

            'reports.required' => __('Informe se o recurso de relatórios está incluído.'),
            'reports.boolean' => __('A opção de relatórios deve ser verdadeira ou falsa.'),

            'financial_management.required' => __('Informe se a gestão financeira está incluída.'),
            'financial_management.boolean' => __('A opção de gestão financeira deve ser verdadeira ou falsa.'),

            'custom_branding.required' => __('Informe se a identidade visual personalizada está incluída.'),
            'custom_branding.boolean' => __('A opção de identidade visual deve ser verdadeira ou falsa.'),

            'data_export.required' => __('Informe se a exportação de dados está incluída.'),
            'data_export.boolean' => __('A opção de exportação de dados deve ser verdadeira ou falsa.'),
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
        ], [
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),
            'plan_id.unique' => __('Este plano já possui funcionalidades cadastradas.'),

            'max_exams.integer' => __('O limite de exames deve ser um número inteiro.'),
            'max_exams.min' => __('O limite de exames deve ser no mínimo -1.'),

            'max_laboratories.integer' => __('O limite de laboratórios deve ser um número inteiro.'),
            'max_laboratories.min' => __('O limite de laboratórios deve ser no mínimo -1.'),

            'max_users.integer' => __('O limite de usuários deve ser um número inteiro.'),
            'max_users.min' => __('O limite de usuários deve ser no mínimo -1.'),

            'max_branches.integer' => __('O limite de filiais deve ser um número inteiro.'),
            'max_branches.min' => __('O limite de filiais deve ser no mínimo -1.'),

            'reports.boolean' => __('A opção de relatórios deve ser verdadeira ou falsa.'),

            'financial_management.boolean' => __('A opção de gestão financeira deve ser verdadeira ou falsa.'),

            'custom_branding.boolean' => __('A opção de identidade visual deve ser verdadeira ou falsa.'),

            'data_export.boolean' => __('A opção de exportação de dados deve ser verdadeira ou falsa.'),
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
