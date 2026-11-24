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
            <label for={forCol}>{label}</label>
        </div>
    </div>
<!-- </div> -->
