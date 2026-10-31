 <script>
    const planos = [
        {
            nome: 'Essencial',
            descricao: 'Para laboratórios que buscam organizar sua rotina.',
        },
        {
            nome: 'Profissional',
            descricao: 'Para operações que precisam de mais recursos.',
        },
        {
            nome: 'Personalizado',
            descricao: 'Para necessidades específicas de cada laboratório.',
        },
    ];
</script>
<section class="plans-section" id="planos">
    <div class="container">
        <div class="section-heading text-center">
            <span class="eyebrow">PLANOS</span>
            <h2 class="section-title">
                Uma solução que pode acompanhar seu laboratório.
            </h2>
            <p class="section-description mx-auto">
                Estamos estruturando as modalidades de contratação
                do Artemis para diferentes necessidades laboratoriais.
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
                            Em definição
                        </span>

                        <a href="#contato" class="plan-link">
                            Tenho interesse
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </article>
                </div>
            {/each}
        </div>

        <p class="plans-disclaimer">
            Valores, limites e recursos de cada plano serão definidos
            antes do início das contratações.
        </p>
    </div>
</section>