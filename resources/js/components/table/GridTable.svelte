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

    let currentPageData = $state([]);
    let api = $state();
    let left = 3;

    async function getData() {
        showOverlay = true;
        try {
            const response = await crud.get(urlGrid);
            // data = response?.[dataKey] ?? [];
            data = response[dataKey].map((item, index) => ({
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

    function normalizeSearchValue(value) {
        if (typeof value === 'boolean') {
            return value
                ? 'true ativo'
                : 'false inativo';
        }

        if (value !== null && typeof value === 'object') {
            value = value.label ?? value.value ?? '';
        }

        return String(value ?? '').trim().toLocaleLowerCase();
    }

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
        const { from, to } = ev;

        currentPageData = filteredData.slice(from, to);
    }

    function cellStyle(row, col) {
        return "center";
    }

    export function reload(delay = 2000) {
        showOverlay = true;
        setTimeout(() => {
            getData();   // sem await
        }, delay);
    }

    $effect(() => {
        filteredData;
        initPagination;

        setPage({
            from: 0,
            to: initPagination
        });
    });
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

            {#if filteredData.length > 0}
                <Pager
                    total={filteredData.length}
                    pageSize={initPagination}
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
    :global(.wx-willow-theme .wx-text) {
        width: 100%;
        text-align: center !important;
        display: flex;
        justify-content: center !important;
        align-items: center;
    }

    :global(.center) {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .table-container {
        width: 100%;
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #B8D4E8;
        box-shadow: 0 4px 20px rgba(31, 52, 66, 0.05);
        overflow: hidden;
        padding: 1.5rem;
    }

    /* Centralização horizontal do Grid */
    .grid-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
        overflow-x: auto;
    }

    .grid-content {
        width: fit-content;
        max-width: 100%;
        flex: 0 0 auto;
    }

    /* Identidade visual Artemis */
    :global(.wx-willow-theme) {
        --wx-color-primary: #2E6B8A;
        --wx-color-font: #1F3442;

        --wx-table-header-background: #E8F0F8;
        --wx-table-header-color: #1F3442;
        --wx-header-font-weight: 600;
        --wx-table-header-border: 1px solid #B8D4E8;
        --wx-table-header-cell-border: 1px solid #B8D4E8;

        --wx-table-border: 1px solid #E8F0F8;
        --wx-table-cell-border: 1px solid #E8F0F8;
        --wx-table-footer-cell-border: 1px solid #B8D4E8;

        --wx-table-select-background: #E8F0F8;
        --wx-table-select-focus-background: #B8D4E8;
        --wx-table-select-color: #1F3442;
        --wx-table-select-border: inset 4px 0 #2E6B8A;

        --wx-table-fixed-column-right-border: 2px solid #B8D4E8;
        --wx-table-editor-dropdown-border: 1px solid #B8D4E8;
        --wx-table-editor-dropdown-shadow: 0 8px 24px rgba(31, 52, 66, 0.12);
        
    }

    :global(.wx-willow-theme .wx-row:hover) {
        background-color: #F5F9FC;
        transition: background-color 0.2s ease;
    }

    :global(.wx-willow-theme .menu) {
        box-shadow: 0 8px 24px rgba(31, 52, 66, 0.12);
        outline: 1px solid #B8D4E8;
        border-radius: 8px;
    }

    :global(.wx-willow-theme .wx-pager) {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #E8F0F8;
    }

    :global(.wx-willow-theme .wx-pager button) {
        border-radius: 8px;
        color: #6BA3C8;
        font-weight: 500;
        transition: all 0.2s;
    }

    :global(.wx-willow-theme .wx-pager button:hover) {
        background-color: #E8F0F8;
        color: #2E6B8A;
    }

    :global(.wx-willow-theme .wx-pager button.wx-active) {
        background-color: #2E6B8A;
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .table-container {
            padding: 0.75rem;
        }

        .grid-wrapper {
            justify-content: flex-start;
        }
    }
</style>
