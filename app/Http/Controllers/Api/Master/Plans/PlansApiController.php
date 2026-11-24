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
}
