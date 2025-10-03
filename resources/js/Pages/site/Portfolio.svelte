<script>
	import Login from './../login/Login.svelte';
    
</script>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- svelte-ignore a11y-invalid-attribute -->
            <a class="navbar-brand" href="#">LabManager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre Nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#funcionalidades">Funcionalidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contato">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" aria-current="page" href="/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <header id="home" class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Bem-vindo ao LabManager</h1>
            <p>Seu sistema de gerenciamento laboratorial completo.</p>
        </div>
    </header>

    <!-- Sobre Nós Section -->
    <section id="sobre" class="py-5">
        <div class="container">
            <h2>Sobre Nós</h2>
            <p>O LabManager é uma solução inovadora para o gerenciamento de laboratórios, oferecendo ferramentas para otimizar processos e aumentar a eficiência.</p>
        </div>
    </section>

    <!-- Funcionalidades Section -->
    <section id="funcionalidades" class="bg-light py-5">
        <div class="container">
            <h2>Funcionalidades</h2>
            <ul>
                <li>Gerenciamento de amostras</li>
                <li>Relatórios personalizados</li>
                <li>Integração com equipamentos</li>
                <li>Controle de estoque</li>
            </ul>
        </div>
    </section>

    <!-- Contato Section -->
    <section id="contato" class="py-5">
        <div class="container">
            <h2>Contato</h2>
            <form>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 LabManager. Todos os direitos reservados.</p>
    </footer>

 