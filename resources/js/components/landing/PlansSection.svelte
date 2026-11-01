 <script>
    import {_} from "$lib/lang/lang.js";
    const planos = [
        {
            nome: _("Essencial"),
            descricao: _("Para laboratórios que buscam organizar sua rotina."),
        },
        {
            nome: _("Profissional"),
            descricao: _("Para operações que precisam de mais recursos."),
        },
        {
            nome: _("Personalizado"),
            descricao: _("Para necessidades específicas de cada laboratório."),
        },
    ];
</script>
<section class="plans-section" id="planos">
    <div class="container">
        <div class="section-heading text-center">
            <span class="eyebrow">{_("PLANOS")}</span>
            <h2 class="section-title">
                {_("Uma solução que pode acompanhar seu laboratório.")}
            </h2>
            <p class="section-description mx-auto">
                {_("Estamos estruturando as modalidades de contratação do Artemis para diferentes necessidades laboratoriais.")}
            </p>
        </div>

        <div class="row g-4 mt-3">
            {#each planos as plano}
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="plan-card">
                        <div class="plan-icon">
                            <i class="bi bi-layers"></i>
                        </div>

                        <h3>{plano.nome}</h3>
                        <p>{plano.descricao}</p>

                        <span class="plan-status">
                            <i class="bi bi-info-circle"></i>
                            {_("Em definição")}
                        </span>

                        <a href="#contato" class="plan-link">
                            {_("Tenho interesse")}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>
            {/each}
        </div>

        <p class="plans-disclaimer">
            {_("Valores, limites e recursos de cada plano serão definidos antes do início das contratações.")}
        </p>
    </div>
</section>