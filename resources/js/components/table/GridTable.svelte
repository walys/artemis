<script>
    import { onMount } from "svelte";
    import { _ } from "$lib/lang/lang.js";
    import { crud } from "$lib/crud/crud.js";
    import { Grid, Willow } from "@svar-ui/svelte-grid";
    import { Pager, Locale } from "@svar-ui/svelte-core";
    import { ptBR } from "$lib/utils/locale-grid.js";
    import Overlay from "$components/table/Overlay.svelte";

    let {
        columns,
        urlGrid,
        dataKey = 'data',
        initPagination,
        filters = {},
        reorder,
        onReorder = null,
        onEdit = null
    } = $props();

    let data = $state([]);
    let showOverlay = $state(false);
    let currentPage = $state(1);

    let api = $state();
    let left = 3;

    // Quantidade de registros por página
    let pageSize = $derived(Number(initPagination) || 5);

    // Busca os dados da API
    async function getData() {
        showOverlay = true;

        try {
            const response = await crud.get(urlGrid);

            data = (response?.[dataKey] ?? []).map((item, index) => ({
                ...item,
                number: index + 1
            }));

        } catch (error) {
            console.error("Erro ao buscar dados:", error);
            data = [];

        } finally {
            showOverlay = false;
        }
    }

    onMount(async () => {
        await getData();
    });

    // Normaliza valores para pesquisa
    function normalizeSearchValue(value) {
        if (typeof value === 'boolean') {
            return value ? 'true ativo' : 'false inativo';
        }

        if (value !== null && typeof value === 'object') {
            value = value.label ?? value.value ?? '';
        }

        return String(value ?? '').trim().toLocaleLowerCase();
    }

    // Filtra os dados
    let filteredData = $derived.by(() => {
        const activeFilters = Object.entries(filters ?? {})
            .filter(([_, value]) =>
                value !== '' &&
                value !== null &&
                value !== undefined
            );

        if (activeFilters.length === 0) {
            return data;
        }

        return data.filter((item) =>
            activeFilters.every(([field, value]) => {
                const itemValue = normalizeSearchValue(item[field]);
                const filterValue = normalizeSearchValue(value);

                return itemValue.includes(filterValue);
            })
        );
    });

    // Dados da página atual
    let currentPageData = $derived.by(() => {
        const start = (currentPage - 1) * pageSize;
        const end = start + pageSize;

        return filteredData.slice(start, end);
    });

    // Inicialização da Grid
    const init = (gridApi) => {
        gridApi.exec("sort-rows", {
            key: "id",
            order: "asc"
        });

        gridApi.on("edit-item", (ev) => {
            onEdit?.(ev.id);
        });

        if (reorder && typeof onReorder === 'function') {
            gridApi.on("move-item", (ev) => {
                if (ev.inProgress === false) {
                    const currentData = gridApi.getState().data;

                    onReorder({
                        event: ev,
                        data: currentData
                    });
                }
            });
        }
    };

    // Paginação
    function setPage(ev) {
        if (ev?.value !== undefined) {
            currentPage = Number(ev.value);
        } else if (ev?.from !== undefined) {
            currentPage = Math.floor(ev.from / pageSize) + 1;
        }
    }

    // Garante que a página atual continue válida
    $effect(() => {
        const totalPages = Math.ceil(filteredData.length / pageSize);

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        if (totalPages === 0) {
            currentPage = 1;
        }
    });

    // Estilo das células
    function cellStyle(row, col) {
        return "center";
    }

    // Recarrega os dados
    export async function reload(delay = 0) {
        showOverlay = true;

        if (delay > 0) {
            await new Promise(resolve => setTimeout(resolve, delay));
        }

        await getData();
    }
</script>

<div class="table-container">

    <Locale words={ptBR}>
        <Willow>

            <div class="grid-wrapper">
                <div class="grid-content">
                    <Grid
                        data={currentPageData}
                        {columns}
                        {init}
                        bind:this={api}
                        overlay={showOverlay ? Overlay : null}
                        split={{ left }}
                        reorder={reorder}
                        {cellStyle}
                    />
                </div>
            </div>

            <!-- Paginação -->
            {#if filteredData.length > 0}
                <Pager
                    total={filteredData.length}
                    pageSize={pageSize}
                    value={currentPage}
                    onchange={setPage}
                />
            {:else if !showOverlay}
                <div class="text-center text-muted py-4">
                    <i class="bi bi-search fs-3 d-block mb-2"></i>
                    {_("Nenhum registro encontrado.")}
                </div>
            {/if}

        </Willow>
    </Locale>

</div>


<style>
    /* ========================================
       ALINHAMENTO DA GRID
    ======================================== */

    :global(.wx-willow-theme .wx-text) {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center !important;
        text-align: center !important;
    }

    :global(.center) {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    /* ========================================
       CONTAINER PRINCIPAL
    ======================================== */

    .table-container {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        padding: 1.5rem;

        background: #FFFFFF;
        border: 1px solid #B8D4E8;
        border-radius: 14px;
        box-shadow: 0 4px 20px rgba(31, 52, 66, 0.05);

        box-sizing: border-box;
        overflow: hidden;
    }

    /* ========================================
       ESTRUTURA DA GRID
    ======================================== */

    .grid-wrapper {
        width: 100%;
        max-width: 100%;
        min-width: 0;

        display: flex;
        justify-content: center;

        overflow-x: auto;
        box-sizing: border-box;
    }

    .grid-content {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        flex: 1 1 auto;
        box-sizing: border-box;
    }

    /* ========================================
       TEMA SVAR — ARTEMIS
    ======================================== */

    :global(.wx-willow-theme) {
        --wx-color-primary: #2E6B8A;
        --wx-color-font: #1F3442;

        /* Cabeçalho */
        --wx-table-header-background: #E8F0F8;
        --wx-table-header-color: #1F3442;
        --wx-header-font-weight: 600;
        --wx-table-header-border: 1px solid #B8D4E8;
        --wx-table-header-cell-border: 1px solid #B8D4E8;

        /* Bordas */
        --wx-table-border: 1px solid #E8F0F8;
        --wx-table-cell-border: 1px solid #E8F0F8;
        --wx-table-footer-cell-border: 1px solid #B8D4E8;

        /* Seleção */
        --wx-table-select-background: #E8F0F8;
        --wx-table-select-focus-background: #B8D4E8;
        --wx-table-select-color: #1F3442;
        --wx-table-select-border: inset 4px 0 #2E6B8A;

        /* Colunas fixas e editores */
        --wx-table-fixed-column-right-border: 2px solid #B8D4E8;
        --wx-table-editor-dropdown-border: 1px solid #B8D4E8;
        --wx-table-editor-dropdown-shadow: 0 8px 24px rgba(31, 52, 66, 0.12);
    }

    /* ========================================
       INTERAÇÕES DA GRID
    ======================================== */

    :global(.wx-willow-theme .wx-row:hover) {
        background-color: #F5F9FC;
        transition: background-color 0.2s ease;
    }

    :global(.wx-willow-theme .menu) {
        box-shadow: 0 8px 24px rgba(31, 52, 66, 0.12);
        outline: 1px solid #B8D4E8;
        border-radius: 8px;
    }

    /* ========================================
       PAGINAÇÃO SVAR
    ======================================== */

    :global(.wx-pager) {
        width: 100%;
        max-width: 100%;
        min-width: 0;

        margin-top: 1rem;
        padding-top: 1rem;

        border-top: 1px solid #E8F0F8;

        box-sizing: border-box;
        overflow: hidden;
    }

    :global(.wx-willow-theme .wx-pager button) {
        border-radius: 8px;
        color: #6BA3C8;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    :global(.wx-willow-theme .wx-pager button:hover) {
        background-color: #E8F0F8;
        color: #2E6B8A;
    }

    :global(.wx-willow-theme .wx-pager button.wx-active) {
        background-color: #2E6B8A;
        color: #FFFFFF;
    }

    /* ========================================
       RESPONSIVIDADE
    ======================================== */

    @media (max-width: 768px) {
        .table-container {
            padding: 0.75rem;
        }

        .grid-wrapper {
            justify-content: flex-start;
        }
    }
</style>
