<script>
    import {_} from "$lib/lang/lang.js";
    export let loadingProgress = 0;
</script>
    <!-- Tela de Loading -->
    <div class="loading-screen">
        <div class="loading-container">
            <div class="loading-logo">
                <img 
                    src="/sneat/logo/logo_name_sf.png" 
                    alt="Logo" 
                    class="logo-spin"
                />
            </div>
            
            <div class="loading-text">
                <h3>Artemis</h3>
                <p>{_("Carregando sistema")}...</p>
            </div>
            
            <div class="progress-container">
                <div class="progress-bar">
                    <div 
                        class="progress-fill" 
                        style={`width: ${loadingProgress}%`}
                    ></div>
                </div>
                <span class="progress-text">{loadingProgress}%</span>
            </div>
            
            <div class="spinner"></div>
        </div>
    </div>
<style>
    /* Tela de Loading */
    .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        font-family: 'Public Sans', sans-serif;
    }

    .loading-container {
        text-align: center;
        color: white;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .loading-logo {
        margin-bottom: 2rem;
    }

    .loading-logo img {
        /* width: 190px; */
        height: 190px;
        border-radius: 0%;
        object-fit: cover;
        animation: pulse 2s infinite ease-in-out;
    }

    /* Animação do logo */
    .logo-spin {
        animation: spinAndPulse 3s infinite ease-in-out;
    }

    .loading-text h3 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
        background: linear-gradient(45deg, #fff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .loading-text p {
        font-size: 1.1rem;
        opacity: 0.8;
        margin-bottom: 2rem;
    }

    /* Barra de progresso */
    .progress-container {
        width: 300px;
        margin: 0 auto 2rem;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 10px;
        transition: width 0.3s ease;
        animation: shimmer 2s infinite;
    }

    .progress-text {
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Spinner alternativo */
    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    /* Animações */
    @keyframes spinAndPulse {
        0% {
            transform: scale(1) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: scale(1.1) rotate(180deg);
            opacity: 0.8;
        }
        100% {
            transform: scale(1) rotate(360deg);
            opacity: 1;
        }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes shimmer {
        0% { background-position: -200px 0; }
        100% { background-position: 200px 0; }
    }

    /* Responsivo */
    @media (max-width: 768px) {
        .loading-container {
            padding: 1.5rem;
            margin: 1rem;
        }

        .loading-logo img {
            width: 100px;
            height: 100px;
        }

        .loading-text h3 {
            font-size: 2rem;
        }

        .progress-container {
            width: 250px;
        }
    }

    /* Garante que os submenus funcionem */
    .menu-sub {
        display: none;
    }
    
    .menu-item.active.open .menu-sub {
        display: block;
    }
    
    /* Remove qualquer estilo que possa estar conflitando */
    .layout-menu .menu-item.active > .menu-link {
        background: rgba(255, 255, 255, 0.1);
    }
</style>