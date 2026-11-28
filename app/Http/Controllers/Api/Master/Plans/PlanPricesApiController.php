<?php

namespace App\Http\Controllers\Api\Master\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plans\PlanPrice;
use App\Services\Plans\PlanPriceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanPricesApiController extends Controller
{
    public function __construct(
        protected PlanPriceService $planPriceService
    ) {}

    /**
     * Lista os preços dos planos.
     */
    public function index(): JsonResponse
    {
        $prices = $this->planPriceService->index();

        return response()->json([
            'prices' => $prices,
        ]);
    }

    /**
     * Cadastra um preço.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'plan_id' => [
                'required',
                'integer',
                'exists:plans,id',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'billing_interval' => [
                'required',
                'string',
                Rule::in(['monthly', 'yearly']),
            ],

            'amount' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ], [
            'plan_id.required' => __('Selecione um plano.'),
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),

            'currency.required' => __('Informe a moeda.'),
            'currency.string' => __('A moeda deve ser um texto válido.'),
            'currency.size' => __('A moeda deve possuir exatamente 3 caracteres.'),

            'billing_interval.required' => __('Selecione a periodicidade.'),
            'billing_interval.in' => __('A periodicidade selecionada é inválida.'),

            'amount.required' => __('Informe o valor.'),
            'amount.integer' => __('O valor deve ser informado em centavos, sem casas decimais.'),
            'amount.min' => __('O valor não pode ser negativo.'),

            'is_active.required' => __('Informe o status do preço.'),
            'is_active.boolean' => __('O status informado é inválido.'),
        ]);

        $exists = PlanPrice::query()
            ->where('plan_id', $data['plan_id'])
            ->where('currency', $data['currency'])
            ->where('billing_interval', $data['billing_interval'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => __('Este plano já possui um preço cadastrado para essa moeda e periodicidade.'),
                'errors' => [
                    'billing_interval' => [
                        __('Este plano já possui um preço cadastrado para essa moeda e periodicidade.'),
                    ],
                ],
            ], 422);
        }

        $price = $this->planPriceService->store($data);

        return response()->json([
            'success' => true,
            'message' => __('Preço cadastrado com sucesso.'),
            'price' => $price,
        ], 201);
    }

    /**
     * Exibe um preço.
     */
    public function show(PlanPrice $planPrice): JsonResponse
    {
        $price = $this->planPriceService->show($planPrice);

        return response()->json([
            'price' => $price,
        ]);
    }

    /**
     * Atualiza um preço.
     */
    public function update(
        Request $request,
        PlanPrice $planPrice
    ): JsonResponse {
        $planId = $request->input('plan_id', $planPrice->plan_id);
        $currency = $request->input('currency', $planPrice->currency);
        $billingInterval = $request->input(
            'billing_interval',
            $planPrice->billing_interval
        );

        $data = $request->validate([
            'plan_id' => [
                'sometimes',
                'integer',
                'exists:plans,id',
            ],

            'currency' => [
                'sometimes',
                'string',
                'size:3',
            ],

            'billing_interval' => [
                'sometimes',
                'string',
                Rule::in(['monthly', 'yearly']),
            ],

            'amount' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ], [
            'plan_id.integer' => __('O plano selecionado é inválido.'),
            'plan_id.exists' => __('O plano selecionado não foi encontrado.'),

            'currency.string' => __('A moeda deve ser um texto válido.'),
            'currency.size' => __('A moeda deve possuir exatamente 3 caracteres.'),

            'billing_interval.in' => __('A periodicidade selecionada é inválida.'),

            'amount.integer' => __('O valor deve ser informado em centavos, sem casas decimais.'),
            'amount.min' => __('O valor não pode ser negativo.'),

            'is_active.boolean' => __('O status informado é inválido.'),
        ]);

        $exists = PlanPrice::query()
            ->where('plan_id', $planId)
            ->where('currency', $currency)
            ->where('billing_interval', $billingInterval)
            ->where('id', '!=', $planPrice->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => __('Este plano já possui um preço cadastrado para essa moeda e periodicidade.'),
                'errors' => [
                    'billing_interval' => [
                        __('Este plano já possui um preço cadastrado para essa moeda e periodicidade.'),
                    ],
                ],
            ], 422);
        }

        $price = $this->planPriceService->update($planPrice, $data);

        return response()->json([
            'success' => true,
            'message' => __('Preço atualizado com sucesso.'),
            'price' => $price,
        ]);
    }

    /**
     * Exclui um preço.
     */
    public function destroy(PlanPrice $planPrice): JsonResponse
    {
        $this->planPriceService->destroy($planPrice);

        return response()->json([
            'success' => true,
            'message' => __('Preço excluído com sucesso.'),
        ]);
    }
}
