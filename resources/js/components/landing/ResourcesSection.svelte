<script>
    const recursos = [
        {
            icone: 'bi-clipboard2-pulse',
            titulo: 'Gestão de exames',
            descricao:
                'Uma área para organizar os processos e acompanhar os exames laboratoriais.',
        },
        {
            icone: 'bi-heart-pulse',
            titulo: 'Gestão de pacientes',
            descricao:
                'Informações dos pacientes veterinários organizadas em um só lugar.',
        },
        {
            icone: 'bi-file-earmark-medical',
            titulo: 'Resultados centralizados',
            descricao:
                'Uma proposta de centralização das informações e dos resultados laboratoriais.',
        },
    ];
</script>
<section class="content-section resources-section" id="recursos">
    <div class="container">
        <div class="section-heading text-center">
            <span class="eyebrow">RECURSOS DA PLATAFORMA</span>
            <h2 class="section-title">
                Um ambiente pensado para o laboratório.
            </h2>
            <p class="section-description mx-auto">
                Conheça as áreas previstas para apoiar a organização
                da operação laboratorial.
            </p>
        </div>

        <div class="row g-4 mt-3">
            {#each recursos as recurso}
                <div class="col-12 col-md-6 col-lg-4">
                    <article class="feature-card">
                        <div class="feature-icon">
                            <i class={`bi ${recurso.icone}`}></i>
                        </div>

                        <h3>{recurso.titulo}</h3>
                        <p>{recurso.descricao}</p>
                        <span class="planned-label">
                            Recurso previsto
                        </span>
                    </article>
                </div>
            {/each}
        </div>
    </div>
</section>