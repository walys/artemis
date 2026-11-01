<script>
    import {_} from "$lib/lang/lang.js";
    import '../../css/landing/landing.css';
    import SiteHeader from "$components/landing/SiteHeader.svelte";
    import HeroSection from "$components/landing/HeroSection.svelte";
    import IntroStrip from "$components/landing/IntroStrip.svelte";
    import AboutSection from "$components/landing/AboutSection.svelte";
    import ResourcesSection from "$components/landing/ResourcesSection.svelte";
    import PlansSection from "$components/landing/PlansSection.svelte";
    import ContactSection from "$components/landing/ContactSection.svelte";
    import SiteFooter from "$components/landing/SiteFooter.svelte";

</script>

<svelte:head>
    <title>Artemis | Gestão Laboratorial Veterinária</title>
    <meta
        name="description"
        content="{_("Conheça o Artemis, uma proposta de plataforma para organização e gestão de laboratórios veterinários.")}"
    />
</svelte:head>

<div class="site-page">
    <SiteHeader />

    <main>
        <HeroSection />

        <IntroStrip />

        <AboutSection />

        <ResourcesSection />

        <PlansSection />

        <ContactSection />
    </main>

    <SiteFooter />
    
</div>

