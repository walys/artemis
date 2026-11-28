<?php

namespace App\Http\Controllers\Api\Master\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans\Plan;
use App\Services\Plans\PlanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlansApiController extends Controller
{
    public function __construct(
        protected PlanService $planService
    ) {}

    /**
     * Lista todos os planos.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'plans' => $this->planService->index(),
        ]);
    }

    /**
     * Cadastra um novo plano.
     */
    public function store(Request $request): JsonResponse
    {
        $this->normalizeActiveStatus($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:plans,code'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => __('Informe o nome do plano.'),
            'name.string' => __('O nome do plano deve ser um texto válido.'),
            'name.max' => __('O nome do plano não pode ter mais de 255 caracteres.'),

            'code.required' => __('Informe o código do plano.'),
            'code.string' => __('O código do plano deve ser um texto válido.'),
            'code.max' => __('O código do plano não pode ter mais de 50 caracteres.'),
            'code.unique' => __('Este código já está sendo utilizado por outro plano.'),

            'is_active.required' => __('Informe se o plano está ativo.'),
            'is_active.boolean' => __('O status do plano deve ser ativo ou inativo.'),
        ]);

        $plan = $this->planService->store($validated);

        return response()->json([
            'success' => true,
            'message' => __('Plano cadastrado com sucesso.'),
            'plan' => $plan,
        ], 201);
    }

    /**
     * Retorna um plano específico.
     */
    public function show(Plan $plan): JsonResponse
    {
        return response()->json([
            'plan' => $this->planService->show($plan),
        ]);
    }

    /**
     * Atualiza um plano existente.
     */
    public function update(Request $request, Plan $plan): JsonResponse
    {
        $this->normalizeActiveStatus($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                'unique:plans,code,' . $plan->id,
            ],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => __('Informe o nome do plano.'),
            'name.string' => __('O nome do plano deve ser um texto válido.'),
            'name.max' => __('O nome do plano não pode ter mais de 255 caracteres.'),

            'code.required' => __('Informe o código do plano.'),
            'code.string' => __('O código do plano deve ser um texto válido.'),
            'code.max' => __('O código do plano não pode ter mais de 50 caracteres.'),
            'code.unique' => __('Este código já está sendo utilizado por outro plano.'),

            'is_active.required' => __('Informe se o plano está ativo.'),
            'is_active.boolean' => __('O status do plano deve ser ativo ou inativo.'),
        ]);

        $updatedPlan = $this->planService->update($plan, $validated);

        return response()->json([
            'success' => true,
            'message' => __('Plano atualizado com sucesso.'),
            'plan' => $updatedPlan,
        ]);
    }

    /**
     * Exclui um plano.
     */
    public function destroy(Plan $plan): JsonResponse
    {
        $this->planService->destroy($plan);

        return response()->json([
            'success' => true,
            'message' => __('Plano excluído com sucesso.'),
        ]);
    }

    /**
     * Atualiza a ordem dos planos.
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'plans' => ['required', 'array', 'min:1'],
            'plans.*.id' => ['required', 'integer', 'exists:plans,id'],
            'plans.*.sort_order' => ['required', 'integer', 'min:1'],
        ], [
            'plans.required' => __('Informe os planos para atualizar a ordem.'),
            'plans.array' => __('A lista de planos enviada é inválida.'),
            'plans.min' => __('Informe pelo menos um plano para atualizar.'),

            'plans.*.id.required' => __('O identificador do plano é obrigatório.'),
            'plans.*.id.integer' => __('O identificador do plano deve ser um número inteiro.'),
            'plans.*.id.exists' => __('Um dos planos informados não foi encontrado.'),

            'plans.*.sort_order.required' => __('A posição de cada plano é obrigatória.'),
            'plans.*.sort_order.integer' => __('A posição de cada plano deve ser um número inteiro.'),
            'plans.*.sort_order.min' => __('A posição de cada plano deve ser no mínimo 1.'),
        ]);

        $this->planService->updateOrder($validated['plans']);

        return response()->json([
            'success' => true,
            'message' => __('Ordem dos planos atualizada com sucesso.'),
        ]);
    }

    /**
     * Normaliza o valor do campo is_active.
     */
    private function normalizeActiveStatus(Request $request): void
    {
        $isActive = $request->input('is_active');

        if (is_array($isActive) && array_key_exists('value', $isActive)) {
            $request->merge([
                'is_active' => $isActive['value'],
            ]);
        }
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
