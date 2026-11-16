<script>
    import { Button } from "@svar-ui/svelte-core";
    let { row, column } = $props();// access row and column data
</script>

<Button type="primary" disabled={!row[column.id]}>
    Show on map
</Button>