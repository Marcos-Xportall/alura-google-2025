<?php
$pageTitle = "ALFA-INCLUIR: Transformando o Desenvolvimento Infantil com IA";
// $basePath é definido no header.php e estará disponível aqui
include __DIR__ . '/partials/header.php';
?>

<main class="landing-page-alfa">

    <!-- SEÇÃO HERO: Primeiro Impacto -->
    <section id="hero" class="hero-section text-center text-white d-flex align-items-center py-5">
        <div class="container">
            <img src="https://images.squarespace-cdn.com/content/v1/5b939410f407b457934a287f/1557744081373-WIN3394FNPRAI8A6B7N3/common-1300520_1280.png" alt="Mascote Alfa Amigável" class="hero-mascote img-fluid mb-4" style="max-height: 220px;">
            <h1 class="display-2 fw-bolder mb-3 animated-text-hero">Bem-vindo ao ALFA-INCLUIR</h1>
            <p class="lead slogan mb-4 col-lg-9 mx-auto animated-text-hero delay-1">
                Sua plataforma inteligente e colaborativa para <span class="highlight-hero">enriquecer o desenvolvimento</span> de cada criança, especialmente aquelas com TEA, TDAH e outros desafios de aprendizado.
            </p>
            <p class="mb-5 col-lg-8 mx-auto animated-text-hero delay-2">
                Descubra atividades personalizadas com o poder da IA, otimize seu tempo e fortaleça o engajamento familiar de forma lúdica e eficaz.
            </p>
            <a href="<?php echo $basePath; ?>/login.php" class="btn btn-lg btn-warning cta-hero shadow-lg animated-button-hero">
                <i class="bi bi-stars me-2"></i>Experimente a Magia da IA Agora!
            </a>
        </div>
    </section>

    <!-- SEÇÃO: O PROBLEMA QUE RESOLVEMOS -->
    <section id="problema" class="problema-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold">Desafios no Apoio ao Desenvolvimento Infantil?</h2>
                <p class="lead text-muted col-lg-9 mx-auto">Pais, tutores e profissionais frequentemente enfrentam obstáculos para encontrar recursos e tempo para um acompanhamento verdadeiramente individualizado.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-6 col-lg-3">
                    <div class="problema-card p-4 shadow-sm h-100">
                        <i class="bi bi-search display-4 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Atividades Genéricas</h5>
                        <p class="small text-muted">Dificuldade em achar ou criar atividades adaptadas às necessidades e interesses únicos de cada criança.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="problema-card p-4 shadow-sm h-100">
                        <i class="bi bi-clock-history display-4 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Tempo Limitado</h5>
                        <p class="small text-muted">A rotina corrida impede o planejamento detalhado e individualizado de estímulos e intervenções.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="problema-card p-4 shadow-sm h-100">
                        <i class="bi bi-arrows-angle-contract display-4 text-primary mb-3"></i> 
                        <h5 class="fw-semibold mb-2">Falta de Continuidade</h5>
                        <p class="small text-muted">Dificuldade em garantir que as estratégias tenham seguimento consistente entre clínica, escola e casa.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="problema-card p-4 shadow-sm h-100">
                        <i class="bi bi-people-fill display-4 text-primary mb-3"></i>
                        <h5 class="fw-semibold mb-2">Isolamento e Suporte</h5>
                        <p class="small text-muted">Sentimento de solidão e carência de recursos confiáveis e troca de experiências, especialmente com necessidades especiais.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÃO: A SOLUÇÃO ALFA-INCLUIR -->
    <section id="solucao" class="solucao-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold">ALFA-INCLUIR: A Inteligência que <span class="text-primary">Conecta</span> e <span class="text-primary">Capacita</span></h2>
                <p class="lead text-muted col-lg-9 mx-auto">Nossa plataforma utiliza o poder da Inteligência Artificial do Google Gemini para oferecer suporte personalizado e colaborativo, tornando o desenvolvimento infantil uma jornada mais leve, divertida e eficaz.</p>
            </div>
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="solucao-image-placeholder bg-secondary-subtle rounded shadow-lg d-flex align-items-center justify-content-center" style="min-height: 350px;">
                        <p class="h3 text-muted p-5 fst-italic"><em>[Ilustração/Print: Interface amigável do ALFA-INCLUIR gerando uma atividade personalizada com o mascote Alfa sorrindo]</em></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="solucao-passo mb-4 d-flex">
                        <div class="icon-wrapper-solucao bg-primary text-white me-3"><i class="bi bi-person-lines-fill h3"></i></div>
                        <div>
                            <h4 class="fw-semibold">1. Perfil Detalhado e Inteligente</h4>
                            <p class="text-muted">Você nos conta sobre a criança: idade, interesses, habilidades, desafios e, se aplicável, diagnóstico e nível de suporte. Quanto mais detalhes, melhor a mágica!</p>
                        </div>
                    </div>
                    <div class="solucao-passo mb-4 d-flex">
                        <div class="icon-wrapper-solucao bg-primary text-white me-3"><i class="bi bi-robot h3"></i></div>
                        <div>
                            <h4 class="fw-semibold">2. Mágica da IA (Gemini)</h4>
                            <p class="text-muted">Nossa IA analisa as informações e, com base em conhecimento especializado e nas melhores práticas, gera sugestões de atividades lúdicas, de estímulo e pedagógicas.</p>
                        </div>
                    </div>
                    <div class="solucao-passo d-flex">
                        <div class="icon-wrapper-solucao bg-primary text-white me-3"><i class="bi bi-lightbulb-fill h3"></i></div>
                        <div>
                            <h4 class="fw-semibold">3. Atividades Sob Medida e Prontas para Usar</h4>
                            <p class="text-muted">Receba planos de atividades criativas e prontas para aplicar, adaptadas ao perfil único da criança, com materiais acessíveis e foco total no engajamento familiar e terapêutico.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÃO: CARDS SOBRE AUTISMO (INFORMATIVOS E POSITIVOS) -->
    <section id="sobre-autismo" class="sobre-autismo-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold"><i class="bi bi-puzzle text-primary me-2"></i>Desvendando o Espectro Autista com Empatia</h2>
                <p class="lead text-muted col-lg-9 mx-auto">Compreender para incluir: cada indivíduo no espectro tem uma forma singular e valiosa de perceber e interagir com o mundo. Celebramos a neurodiversidade!</p>
            </div>
            <div class="row g-4">
                <?php
                $autismo_info_cards = [
                    ['icon' => 'bi-brightness-high-fill', 'title' => 'Neurodiversidade em Foco', 'text' => 'O TEA é uma variação natural do desenvolvimento neurológico, não uma falha. Celebrar as diferentes formas de pensar e ser é fundamental para uma sociedade inclusiva.', 'card_class' => 'info-card-azul'],
                    ['icon' => 'bi-chat-heart-fill', 'title' => 'Comunicação Plural e Rica', 'text' => 'A comunicação vai muito além da fala verbal. Gestos, expressões, sistemas alternativos (PECS, pranchas) e a intensidade do olhar são ferramentas valiosas e ricas de expressão.', 'card_class' => 'info-card-verde'],
                    ['icon' => 'bi-stars', 'title' => 'Interesses como Superpoderes', 'text' => 'O hiperfoco, muitas vezes presente no autismo, pode ser um verdadeiro superpoder para o aprendizado, canalizando a paixão e a energia da criança para o desenvolvimento de talentos e habilidades incríveis.', 'card_class' => 'info-card-amarelo'],
                    ['icon' => 'bi-earbuds', 'title' => 'Universo Sensorial Único', 'text' => 'Pessoas no espectro podem ter sensibilidades aguçadas ou diminuídas a luzes, sons, texturas ou movimentos. Adaptar o ambiente com empatia promove conforto, segurança e regulação emocional.', 'card_class' => 'info-card-laranja'],
                ];
                foreach ($autismo_info_cards as $card): ?>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch">
                    <div class="info-card p-4 rounded shadow-sm text-center <?php echo $card['card_class']; ?> h-100">
                        <i class="bi <?php echo $card['icon']; ?> display-4 mb-3"></i>
                        <h5 class="fw-semibold mb-2"><?php echo $card['title']; ?></h5>
                        <p class="small text-body-secondary"><?php echo $card['text']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
             <p class="text-center text-muted mt-5 fst-italic">
                "Se você conheceu uma pessoa com autismo, você conheceu UMA pessoa com autismo." - Dr. Stephen Shore
            </p>
        </div>
    </section>

  <!-- SEÇÃO: SUA HISTÓRIA / MOTIVAÇÃO -->
    <section id="motivacao" class="motivacao-section py-5"> <!-- Removido bg-primary text-white se já estiver no CSS -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-center mb-4 mb-lg-0">
                    <!-- Usando uma imagem local e ajustando o CSS para o tamanho desejado -->
                    <img src="https://scontent-gru2-1.xx.fbcdn.net/v/t39.30808-6/453331444_8079022502158682_6081259237659172055_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=_Ocz0_qH5r8Q7kNvwHcmgpy&_nc_oc=AdlJQKbOx3ojfPLhjhRI8kj_3ltA0j1HtWnVpx27QVulIKXytOupaQWd08CqOeq47zMxquQYcm_pqa4WyLLey4m8&_nc_zt=23&_nc_ht=scontent-gru2-1.xx&_nc_gid=MSuSHYwD4pLv-e-h4StDLA&oh=00_AfLKfOlcdHGvNU5rlh_MryPl8AUeEgefpk002TjNPxmDug&oe=682EF8E5" 
                         alt="Marcos Ribeiro" 
                         class="img-fluid rounded-circle shadow-lg criador-foto" 
                         style="width: 280px; height: 280px; object-fit: cover;"> 
                         <!-- Mantive 280px, mas você pode reduzir para 150px, 200px etc. 
                              Adicionado height e object-fit para garantir que seja circular e bem preenchida -->
                </div>
                <div class="col-lg-8 text-center text-lg-start">
                    <h2 class="display-5 fw-bold mb-3">Uma Jornada Pessoal, Uma Missão Coletiva</h2>
                    <p class="lead fst-italic mb-4" style="font-size: 1.15rem;">
                        "Como pai de uma criança autista suporte 2, vivencio diariamente os desafios e as imensas alegrias dessa jornada. A busca por ferramentas que realmente entendam e atendam às necessidades únicas do meu filho me impulsionou a criar o ALFA-INCLUIR. Este é mais que um projeto, é uma missão de amor, um desejo de empoderar outras famílias e profissionais, oferecendo o suporte que eu mesmo procurei e que acredito que pode transformar vidas."
                    </p>
                    <p class="lead mb-0">- <strong>Marcos Ribeiro</strong>, Idealizador do ALFA-INCLUIR</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÃO CTA FINAL -->
    <section id="cta-final" class="cta-final-section text-center py-5 bg-light">
        <div class="container">
            <img src="<?php echo $basePath; ?>/img/logo.png"  alt="Mascote Alfa convidando" class="img-fluid mb-4" style="max-height: 180px;">
            <h2 class="display-4 fw-bolder mb-4 text-primary">Pronto para Simplificar e Potencializar o Desenvolvimento?</h2>
            <p class="lead col-lg-9 mx-auto mb-5 text-muted">
                Junte-se à comunidade ALFA-INCLUIR e descubra como a inteligência artificial pode ser sua aliada na nobre tarefa de educar e cuidar, criando um futuro mais brilhante para cada criança.
            </p>
            <a href="<?php echo $basePath; ?>/login.php" class="btn btn-lg btn-warning cta-final-button shadow-lg pulse-button-hero">
                <i class="bi bi-box-arrow-in-right me-2"></i>Acessar o Demo e Transformar Vidas!
            </a>
        </div>
    </section>

</main>

<?php
// $extraJs = ['landing-interactions.js']; // Se precisar de JS para animações ou interações futuras
include __DIR__ . '/partials/footer.php';
?>