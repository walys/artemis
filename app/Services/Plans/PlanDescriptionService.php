<?php

namespace App\Services\Plans;

use App\Models\Plans\PlanDescription;
use App\Models\Plans\Plan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlanDescriptionService
{
    public function index(): Collection
    {
        return Plan::query()
            ->with(['descriptions.language'])
            ->orderBy('sort_order')
            ->get()
            ->map(function (Plan $plan) {
                return [
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'code' => $plan->code,
                    'is_active' => (bool) $plan->is_active,
                    'sort_order' => $plan->sort_order,
                    'created_at' => $plan->created_at,
                    'updated_at' => $plan->updated_at,
                    'descriptions' => $plan->descriptions->map(function (PlanDescription $description) use ($plan) {
                        return [
                            'id' => $description->id,
                            'plan' => $plan->name,
                            'plan_id' => $description->plan_id,
                            'language_id' => $description->language_id,
                            'language' => $description->language?->name,
                            'description' => $description->description,
                            'created_at' => $description->created_at,
                            'updated_at' => $description->updated_at,
                        ];
                    })->values(),
                ];
            })
            ->values();
    }

     /**
     * Cadastra uma descrição para um plano.
     */
    public function store(array $data): PlanDescription
    {
        return DB::transaction(function () use ($data) {
            return PlanDescription::create($data)
                ->load(['plan', 'language']);
        });
    }

    /**
     * Exibe uma descrição.
     */
    public function show(PlanDescription $planDescription): array
    {
        $planDescription->load(['plan', 'language']);

        return [
            'id' => $planDescription->id,
            'plan_id' => $planDescription->plan_id,
            'language_id' => $planDescription->language_id,
            'description' => $planDescription->description,
            'created_at' => $planDescription->created_at,
            'updated_at' => $planDescription->updated_at,

            'plan' => $planDescription->plan?->is_active
                ? [
                    'value' => $planDescription->plan->id,
                    'label' => $planDescription->plan->name,
                    'code' => $planDescription->plan->code,
                    'is_active' => (bool) $planDescription->plan->is_active,
                    'sort_order' => $planDescription->plan->sort_order,
                    'created_at' => $planDescription->plan->created_at,
                    'updated_at' => $planDescription->plan->updated_at,
                ]
                : null,

            'language' => $planDescription->language
                ? [
                    'value' => $planDescription->language->id,
                    'label' => $planDescription->language->name,
                ]
                : null,
        ];
    }

    /**
     * Atualiza uma descrição.
     */
    public function update(PlanDescription $planDescription, array $data): PlanDescription
    {
        return DB::transaction(function () use ($planDescription, $data) {
            $planDescription->update($data);

            return $planDescription->refresh()
                ->load(['plan', 'language']);
        });
    }

    /**
     * Exclui uma descrição.
     */
    public function destroy(PlanDescription $planDescription): bool
    {
        return DB::transaction(function () use ($planDescription) {
            return (bool) $planDescription->delete();
        });
    }
}