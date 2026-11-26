<script>
    let {
        classCol,
        classDiv,
        forCol = '',
        label
    } = $props();
</script>
<!-- <div class="container-fluid"> -->
    <div class={classCol}>
        <div class={classDiv}>
            <slot />
            <label for={forCol} class="form-label">{label}</label>
        </div>
    </div>
<!-- </div> -->
