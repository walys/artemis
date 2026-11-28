<?php

namespace App\Http\Controllers\Api\Master\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans\PlanDescription;
use App\Models\Plans\Plan;
use App\Services\Plans\PlanDescriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanDescriptionsApiController extends Controller
{
    public function __construct(
        protected PlanDescriptionService $planDescriptionService
    ) {}

    /**
     * Lista os planos e suas funcionalidades.
     */
    public function index(): JsonResponse
    {
        $descriptions = $this->planDescriptionService->index();
        return response()->json([
            'descriptions' => $descriptions,
        ]);
    }

    /**
     * Cadastra uma descrição.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'plan_id' => [
                'required',
                'integer',
                'exists:plans,id',
            ],

            'language_id' => [
                'required',
                'integer',
                'exists:languages,id',
                Rule::unique('plan_descriptions', 'language_id')
                    ->where(fn ($query) => $query->where('plan_id', $request->input('plan_id'))),
            ],

            'description' => ['required', 'string'],
        ], [
            'plan_id.required' => __('Selecione um plano.'),
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),

            'language_id.required' => __('Selecione um idioma.'),
            'language_id.integer' => __('O idioma selecionado é inválido.'),
            'language_id.exists' => __('O idioma selecionado não foi encontrado.'),
            'language_id.unique' => __('Este plano já possui uma descrição cadastrada para o idioma selecionado.'),

            'description.required' => __('Informe a descrição do plano.'),
            'description.string' => __('A descrição deve ser um texto válido.'),
        ]);

        $description = $this->planDescriptionService->store($data);

        return response()->json([
            'success' => true,
            'message' => __('Descrição cadastrada com sucesso.'),
            'description' => $description,
        ], 201);
    }

    /**
     * Exibe uma descrição.
     */
    public function show(PlanDescription $planDescription): JsonResponse
    {
        $description = $this->planDescriptionService->show($planDescription);

        return response()->json([
            'description' => $description,
        ]);
    }

    /**
     * Atualiza uma 
     *  .
     */
    public function update(Request $request, PlanDescription $planDescription): JsonResponse
    {
        $planId = $request->input('plan_id', $planDescription->plan_id);
        // dd($request);
        $data = $request->validate([
            'plan_id' => [
                'sometimes',
                'integer',
                'exists:plans,id',
            ],

            'language_id' => [
                'sometimes',
                'integer',
                'exists:languages,id',
                Rule::unique('plan_descriptions', 'language_id')
                    ->where(fn ($query) => $query->where('plan_id', $planId))
                    ->ignore($planDescription->id),
            ],

            'description' => ['sometimes', 'string'],
        ], [
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),

            'language_id.integer' => __('O idioma selecionado é inválido.'),
            'language_id.exists' => __('O idioma selecionado não foi encontrado.'),
            'language_id.unique' => __('Este plano já possui uma descrição cadastrada para o idioma selecionado.'),

            'description.string' => __('A descrição deve ser um texto válido.'),
        ]);

        $description = $this->planDescriptionService->update($planDescription, $data);

        return response()->json([
            'success' => true,
            'message' => __('Descrição atualizada com sucesso.'),
            'description' => $description,
        ]);
    }

    /**
     * Exclui uma descrição.
     */
    public function destroy(PlanDescription $planDescription): JsonResponse
    {
        $this->planDescriptionService->destroy($planDescription);

        return response()->json([
            'success' => true,
            'message' => __('Descrição excluída com sucesso.'),
        ]);
    }

    public function planList(): JsonResponse
    {
        $plan = Plan::selet('id as value', 'name as label')
            ->orderBy('sort_order')
            ->get();
        $plans = $plan->toArray();
        return response()->json(['plans' => $plans]);
    }
}