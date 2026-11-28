<?php

namespace App\Services\Plans;

use App\Models\Plans\Plan;
use App\Models\Plans\PlanPrice;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlanPriceService
{
    /**
     * Lista todos os preços dos planos.
     */
    public function index(): Collection
    {
        return PlanPrice::query()
            ->with('plan')
            ->orderBy('plan_id')
            ->orderBy('billing_interval')
            ->get()
            ->map(function (PlanPrice $price) {
                return [
                    'id' => $price->id,
                    'plan_id' => $price->plan_id,
                    'plan_name' => $price->plan?->name,
                    'currency' => $price->currency,
                    'billing_interval' => $price->billing_interval,
                    'amount' => $price->amount,
                    'amount_formatted' => $price->currency . ' ' . number_format(
                        $price->amount / 100,
                        2,
                        ',',
                        '.'
                    ),
                    'is_active' => (bool) $price->is_active,
                    'created_at' => $price->created_at,
                    'updated_at' => $price->updated_at,
                ];
            })
            ->values();
    }

    /**
     * Cadastra um preço para um plano.
     */
    public function store(array $data): PlanPrice
    {
        return DB::transaction(function () use ($data) {
            return PlanPrice::create($data)
                ->load('plan');
        });
    }

    /**
     * Exibe um preço para edição.
     */
    public function show(PlanPrice $planPrice): array
    {
        $planPrice->load('plan');

        return [
            'id' => $planPrice->id,
            'plan_id' => $planPrice->plan_id,
            'currency' => $planPrice->currency,
            'billing_interval' => $planPrice->billing_interval,
            'amount' => $planPrice->amount,
            'is_active' => [
                'value' => (bool) $planPrice->is_active,
                'label' => $planPrice->is_active
                    ? __('Ativo')
                    : __('Inativo'),
            ],
            'created_at' => $planPrice->created_at,
            'updated_at' => $planPrice->updated_at,

            'plan' => $planPrice->plan
                ? [
                    'value' => $planPrice->plan->id,
                    'label' => $planPrice->plan->name,
                    'code' => $planPrice->plan->code,
                ]
                : null,
        ];
    }

    /**
     * Atualiza um preço existente.
     */
    public function update(PlanPrice $planPrice, array $data): PlanPrice
    {
        return DB::transaction(function () use ($planPrice, $data) {
            $planPrice->update($data);

            return $planPrice->refresh()
                ->load('plan');
        });
    }

    /**
     * Exclui um preço.
     */
    public function destroy(PlanPrice $planPrice): bool
    {
        return DB::transaction(function () use ($planPrice) {
            return (bool) $planPrice->delete();
        });
    }
}
