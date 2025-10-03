<script>
    export let title = "";
    export let forName = "";
    export let classInput = "";
</script>
<div class={classInput}>
    {#if forName !== ""}
        <label for={forName}>{title}</label>
    {/if}
    <slot />
</div>