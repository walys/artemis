
<script>
    import {_} from "$lib/lang/lang.js";

    export let plans = [];

    const language = typeof window !== "undefined"
        ? localStorage.getItem("lang") || "pt-BR"
        : "pt-BR";

    const featureLabels = {
        "pt-BR": {
            max_exams: "Exames por mês",
            max_laboratories: "Laboratórios",
            max_users: "Usuários",
            max_branches: "Filiais",
            reports: "Relatórios avançados",
            financial_management: "Gestão financeira",
            custom_branding: "Identidade visual personalizada",
            data_export: "Exportação de dados",
        },
        "en-US": {
            max_exams: "Exams per month",
            max_laboratories: "Laboratories",
            max_users: "Users",
            max_branches: "Branches",
            reports: "Advanced reports",
            financial_management: "Financial management",
            custom_branding: "Custom branding",
            data_export: "Data export",
        },
        "es-ES": {
            max_exams: "Exámenes por mes",
            max_laboratories: "Laboratorios",
            max_users: "Usuarios",
            max_branches: "Sucursales",
            reports: "Informes avanzados",
            financial_management: "Gestión financiera",
            custom_branding: "Identidad visual personalizada",
            data_export: "Exportación de datos",
        },
    };

    const paymentLabels = {
        pix: "Pix",
        credit_card: _("Cartão de crédito"),
        boleto: _("Boleto bancário"),
    };

    function getDescription(plan) {
        const descriptions = plan.descriptions || [];

        return (
            descriptions.find(
                item => item.language?.code === language
            )?.description ||
            descriptions.find(
                item => item.language?.code === "pt-BR"
            )?.description ||
            ""
        );
    }

    function getPrice(plan, interval) {
        return plan.prices?.find(
            price =>
                price.billing_interval === interval &&
                price.is_active
        );
    }

    function formatPrice(amount) {
        return new Intl.NumberFormat(
            language,
            {
                style: "currency",
                currency: "BRL",
            }
        ).format(amount / 100);
    }

    function getFeatureLabel(key) {
        return featureLabels[language]?.[key]
            || featureLabels["pt-BR"][key]
            || key;
    }

    function getFeatureValue(value) {
        if (value === -1) {
            return _("Ilimitado");
        }

        if (value === 0) {
            return _("Não incluído");
        }

        if (typeof value === "boolean") {
            return value
                ? _("Incluído")
                : _("Não incluído");
        }

        return value;
    }

    function getPaymentLabel(method) {
        return paymentLabels[method] || method;
    }

    function getActiveFeatures(plan) {
        return (plan.features || []).filter(feature => {
            return feature.feature_value !== false;
        });
    }
</script>

<section class="plans-section" id="planos">
    <div class="container">
        <div class="section-heading text-center">
            <span class="eyebrow">{_("PLANOS")}</span>

            <h2 class="section-title">
                {_("Uma solução que pode acompanhar seu laboratório.")}
            </h2>

            <p class="section-description mx-auto">
                {_("Conheça os planos disponíveis e escolha aquele que melhor atende às necessidades do seu laboratório.")}
            </p>
        </div>

        <div class="row g-4 mt-3">
            {#each plans as plan (plan.id)}
                {@const monthlyPrice = getPrice(plan, "monthly")}
                {@const yearlyPrice = getPrice(plan, "yearly")}

                <div class="col-12 col-md-6 col-lg-3">
                    <article class="plan-card">
                        <div class="plan-icon">
                            <i class="bi bi-award"></i>
                        </div>

                        <h3>{plan.name}</h3>

                        <p>{getDescription(plan)}</p>

                        <div class="plan-prices">
                            {#if monthlyPrice}
                                <div class="plan-price">
                                    <strong>
                                        {monthlyPrice.amount === 0
                                            ? _("Gratuito")
                                            : formatPrice(monthlyPrice.amount)}
                                    </strong>

                                    {#if monthlyPrice.amount > 0}
                                        <span>{_("/ mês")}</span>
                                    {/if}
                                </div>
                            {/if}

                            {#if yearlyPrice && yearlyPrice.amount > 0}
                                <div class="plan-yearly-price">
                                    {formatPrice(yearlyPrice.amount)}
                                    {_(" / ano")}
                                </div>
                            {/if}
                        </div>

                        <div class="plan-features">
                            {#each getActiveFeatures(plan) as feature (feature.id)}
                                <div class="plan-feature">
                                    <i class="bi bi-check-circle"></i>

                                    <span>
                                        {getFeatureLabel(feature.feature_key)}:

                                        <strong>
                                            {getFeatureValue(feature.feature_value)}
                                        </strong>
                                    </span>
                                </div>
                            {/each}
                        </div>

                        {#if plan.payment_methods?.length > 0}
                            <div class="plan-payment-methods">
                                <small>{_("Formas de pagamento")}</small>

                                <div>
                                    {#each plan.payment_methods as method (method.id)}
                                        <span>
                                            {getPaymentLabel(method.payment_method)}
                                        </span>
                                    {/each}
                                </div>
                            </div>
                        {/if}

                        <a href="#contato" class="plan-link">
                            {_("Tenho interesse")}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>
            {:else}
                <div class="col-12 text-center">
                    <p>{_("Nenhum plano disponível no momento.")}</p>
                </div>
            {/each}
        </div>

        <p class="plans-disclaimer">
            {_("Os preços e recursos apresentados correspondem às condições cadastradas para cada plano.")}
        </p>
    </div>
</section>
<style>

.plan-prices {
    margin: 1.5rem 0;
}

.plan-price strong {
    font-size: 1.8rem;
    font-weight: 700;
}

.plan-price span {
    font-size: 0.9rem;
    color: var(--bs-secondary-color);
}

.plan-yearly-price {
    margin-top: 0.4rem;
    font-size: 0.85rem;
    color: var(--bs-secondary-color);
}

.plan-features {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin: 1.5rem 0;
}

.plan-feature {
    display: flex;
    align-items: flex-start;
    gap: 0.6rem;
    font-size: 0.9rem;
}

.plan-feature i {
    color: var(--bs-success);
}

.plan-payment-methods {
    margin: 1.5rem 0;
}

.plan-payment-methods small {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--bs-secondary-color);
}

.plan-payment-methods div {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.plan-payment-methods span {
    padding: 0.3rem 0.65rem;
    border-radius: 20px;
    background: var(--bs-tertiary-bg);
    font-size: 0.8rem;
}

</style>