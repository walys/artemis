<script>
    import { _ } from "$lib/lang/lang.js";

    let { row, column } = $props();

    let isActive = $derived(row[column.id]);
</script>

{#if isActive}
    <span class="badge artemis-badge-success">{_('Ativo')}</span>
{:else}
    <span class="badge artemis-badge-pending">{_('Inativo')}</span>
{/if}
<style>
    .artemis-badge-success {
        background: #e2f3e9;
        color: #216b45;
    }

    .artemis-badge-pending {
        background: #fff0d7;
        color: #865b12;
    }
</style>