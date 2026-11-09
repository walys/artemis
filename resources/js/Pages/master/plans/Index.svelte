
<script>
    import {_} from "$lib/lang/lang.js";
    import Layout from "$components/landing-master/Layout.svelte";
    import Tanstack from "$components/tanstack-table/Tanstack-Table.svelte";

    let breadcrumb = _("Planos");

</script>

<Layout breadcrumb={breadcrumb}>
    <section class="dashboard-section">
        <Tanstack />
    </section>
</Layout>

