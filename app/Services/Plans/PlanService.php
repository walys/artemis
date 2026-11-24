<?php

namespace App\Services\Plans;

use App\Models\Plans\Plan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlanService
{
    /**
     * Retorna todos os planos ordenados.
     */
    public function index(): Collection
    {
        return Plan::query()
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Cadastra um novo plano.
     */
    public function store(array $data): Plan
    {
        return Plan::create($data);
    }

    /**
     * Retorna um plano para edição.
     */
    public function show(Plan $plan): array
    {
        return array_merge($plan->toArray(), [
            'is_active' => [
                'value' => (bool) $plan->is_active,
                'label' => $plan->is_active
                    ? __('Ativo')
                    : __('Inativo'),
            ],
        ]);
    }

    /**
     * Atualiza um plano existente.
     */
    public function update(Plan $plan, array $data): Plan
    {
        $plan->update($data);

        return $plan->refresh();
    }

    /**
     * Exclui um plano.
     */
    public function destroy(Plan $plan): bool
    {
        return $plan->delete();
    }

    /**
     * Atualiza a ordem dos planos.
     */
    public function updateOrder(array $plans): void
    {
        DB::transaction(function () use ($plans) {
            foreach ($plans as $item) {
                Plan::whereKey($item['id'])
                    ->update([
                        'sort_order' => $item['sort_order'],
                    ]);
            }
        });
    }
}
