<script>
    let { row, onaction } = $props();

    function handleEdit() {
        onaction?.({ action: "edit-item", data: { id: row.id } });
    }
</script>

<button type="button" class="btn btn-sm btn-warning" onclick={handleEdit}>
    <i class="bi bi-pencil-square"></i>
</button>