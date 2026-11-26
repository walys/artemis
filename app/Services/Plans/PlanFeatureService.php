<?php

namespace App\Services\Plans;

use App\Models\Plans\Plan;
use App\Models\Plans\PlanFeature;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PlanFeatureService
{
    /**
     * Retorna todos os planos com suas funcionalidades.
     */
    public function index(): Collection
    {
        return Plan::query()
            ->with('features')
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Cadastra as funcionalidades de um plano.
     */
    public function store(array $data): PlanFeature
    {
        return DB::transaction(function () use ($data) {
            return PlanFeature::create($data)->load('plan');
        });
    }

    /**
     * Retorna os detalhes das funcionalidades.
     */
    public function show(PlanFeature $planFeature): array
    {
        return array_merge($planFeature->toArray(), [
            'reports' => [
                'value' => (bool) $planFeature->is_active,
                'label' => $planFeature->is_active
                    ? __('Incluído')
                    : __('Não incluído'),
            ],
            'financial_management' => [
                'value' => (bool) $planFeature->financial_management,
                'label' => $planFeature->financial_management
                    ? __('Incluído')
                    : __('Não incluído'),
            ],
            'custom_branding' => [
                'value' => (bool) $planFeature->custom_branding,
                'label' => $planFeature->custom_branding
                    ? __('Incluído')
                    : __('Não incluído'),
            ],
            'data_export' => [
                'value' => (bool) $planFeature->data_export,
                'label' => $planFeature->data_export
                    ? __('Incluído')
                    : __('Não incluído'),
            ],
        ]);
    }

    /**
     * Atualiza as funcionalidades de um plano.
     */
    public function update(
        PlanFeature $planFeature,
        array $data
    ): PlanFeature {
        return DB::transaction(function () use ($planFeature, $data) {
            $planFeature->update($data);

            return $planFeature->refresh()->load('plan');
        });
    }

    /**
     * Exclui as funcionalidades de um plano.
     */
    public function destroy(PlanFeature $planFeature): bool
    {
        return DB::transaction(function () use ($planFeature) {
            return (bool) $planFeature->delete();
        });
    }
}
