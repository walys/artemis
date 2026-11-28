<?php

namespace App\Services\Plans;

use App\Models\Plans\Plan;
use App\Models\Plans\PlanFeature;
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
        return DB::transaction(function () use ($data) {

            // Cadastra o plano
            $plan = Plan::create($data);

            // Cria as funcionalidades padrão
            $this->createFeatures($plan);

            // Cria as descrições nos três idiomas
            $this->createDescriptions($plan);

            return $plan->load([
                'features',
                'descriptions.language',
            ]);
        });
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
     * Atualiza a ordem dos planos.
     */
    public function destroy(Plan $plan): bool
    {
        return DB::transaction(function () use ($plan) {

            // Exclui as descrições do plano
            $plan->descriptions()->delete();

            // Exclui as funcionalidades do plano
            $plan->features()->delete();

            // Exclui o plano
            return (bool) $plan->delete();
        });
    }

    /**
     * Atualiza a ordem de exibição dos planos.
     */
    public function updateOrder(array $plans): bool
    {
        return DB::transaction(function () use ($plans) {

            foreach ($plans as $plan) {
                Plan::where('id', $plan['id'])
                    ->update([
                        'sort_order' => $plan['sort_order'],
                    ]);
            }

            return true;
        });
    }

    public function createFeatures(Plan $plan)
    {
        $plan->features()->create([
                'max_exams' => 0,
                'max_laboratories' => 0,
                'max_users' => 0,
                'max_branches' => 0,
                'reports' => false,
                'financial_management' => false,
                'custom_branding' => false,
                'data_export' => false,
            ]);

        return $plan;
    }

    /**
     * Cria as descrições padrão do plano nos idiomas disponíveis.
     */
    public function createDescriptions(Plan $plan): Plan
    {
        $descriptions = [
            'pt-BR' => 'Texto de teste',
            'en-US' => 'Test text',
            'es-ES' => 'Texto de prueba',
        ];

        foreach ($descriptions as $languageCode => $description) {
            $language = \App\Models\Settings\Language::where('code', $languageCode)
                ->first();

            if (!$language) {
                continue;
            }

            $plan->descriptions()->create([
                'language_id' => $language->id,
                'description' => $description,
            ]);
        }

        return $plan;
    }
}
