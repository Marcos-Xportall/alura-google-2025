// js/app.js

// A variável window.APP_BASE_PATH é definida no header.php pelo PHP
// Fornecemos um fallback crucial caso ela não seja definida por algum motivo.
const APP_BASE_PATH = typeof window.APP_BASE_PATH !== 'undefined' ? window.APP_BASE_PATH : '/alfa-incluir-demo-php';

// Função utilitária global para escapar HTML
function htmlspecialchars(str) {
    if (typeof str !== 'string') return String(str);
    return str.replace(/&/g, '&amp;')
              .replace(/</g, '&lt;')
              .replace(/>/g, '&gt;')
              .replace(/"/g, '&quot;')
              .replace(/'/g, '&#039;');
}

const app = {
    simulateLogin: function(roleKey) {
        if (roleKey) {
            let targetUrl = APP_BASE_PATH + '/login.php?sim_role=' + encodeURIComponent(roleKey);
            console.log("JS: Tentando redirecionar para (simulateLogin):", targetUrl);
            window.location.href = targetUrl;
        } else {
            console.error("JS: Função simulateLogin chamada sem um 'roleKey'.");
        }
    },

    initGeradorAtividadesForm: function() {
        console.log("JS: app.js - initGeradorAtividadesForm INICIADA");
        const form = document.getElementById('formGeradorAtividades');
        if (!form) {
            console.warn("JS: app.js - Formulário 'formGeradorAtividades' não encontrado no DOM.");
            return;
        }

        const alunoSelect = document.getElementById('alunoSelect');
        if (alunoSelect) {
            if (typeof mockAlunos !== 'undefined' && Array.isArray(mockAlunos) && mockAlunos.length > 0) {
                alunoSelect.innerHTML = '<option value="" selected disabled>Selecione uma criança...</option>';
                mockAlunos.forEach(aluno => {
                    const option = document.createElement('option');
                    option.value = String(aluno.id);
                    option.textContent = `${aluno.nome} (Idade: ${aluno.idade}, Perfil: ${aluno.perfil})`;
                    alunoSelect.appendChild(option);
                });
                console.log("JS: app.js - Select de alunos populado com", mockAlunos.length, "crianças.");
            } else {
                console.warn("JS: app.js - 'mockAlunos' não está disponível, é um array vazio ou não é um array. Verifique mockData.js e a ordem de carregamento dos scripts.");
                console.log("JS: app.js - typeof mockAlunos:", typeof mockAlunos);
                if (Array.isArray(mockAlunos)) {
                    console.log("JS: app.js - mockAlunos.length:", mockAlunos.length);
                }
                alunoSelect.innerHTML = '<option value="" selected disabled>Nenhuma criança encontrada nos dados</option>';
            }
        } else {
            console.warn("JS: app.js - Elemento 'alunoSelect' não encontrado no DOM.");
        }

        if (this.handleGerarAtividadeSubmitBound) {
            form.removeEventListener('submit', this.handleGerarAtividadeSubmitBound);
        }
        this.handleGerarAtividadeSubmitBound = this.handleGerarAtividadeSubmit.bind(this);
        form.addEventListener('submit', this.handleGerarAtividadeSubmitBound);
        console.log("JS: app.js - Event listener do Gerador de Atividades ADICIONADO/ATUALIZADO.");
    },

    handleGerarAtividadeSubmitBound: null, // Para guardar a referência da função com 'this' vinculado

    handleGerarAtividadeSubmit: async function(event) {
        event.preventDefault();
        console.log("JS: Formulário Gerador de Atividades SUBMETIDO.");

        const form = event.target;
        const submitButton = form.querySelector('button[type="submit"]');
        const btnSpinner = document.getElementById('gerarBtnSpinner');
        const btnIcon = document.getElementById('gerarBtnIcon');
        const btnText = document.getElementById('gerarBtnText');
        const resultadoDiv = document.getElementById('resultadoAtividade');

        if (!resultadoDiv) {
            console.error("JS: Div 'resultadoAtividade' não encontrada no DOM.");
            return;
        }

        const alunoSelect = document.getElementById('alunoSelect');
        if (!alunoSelect.value) { // Verifica se uma opção válida (não o placeholder) foi selecionada
            resultadoDiv.innerHTML = '<p class="text-danger text-center fw-bold mt-3">Por favor, selecione uma criança/aluno.</p>';
            if (alunoSelect.classList) alunoSelect.classList.add('is-invalid'); // Adiciona feedback visual Bootstrap
            return;
        }
        if (alunoSelect.classList) alunoSelect.classList.remove('is-invalid'); // Remove feedback se válido

        // Ativar estado de carregamento no botão e na área de resultado
        if (submitButton) submitButton.disabled = true;
        if (btnSpinner) btnSpinner.classList.remove('d-none');
        if (btnIcon) btnIcon.classList.add('d-none');
        if (btnText) btnText.textContent = 'Gerando, aguarde...';

        resultadoDiv.innerHTML = `
            <div class="d-flex justify-content-center align-items-center flex-column text-center" style="min-height: 200px;">
                <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Gerando...</span>
                </div>
                <p class="text-muted fw-semibold">Nossa IA está preparando uma atividade incrível para você...</p>
                <p class="small text-muted">Isso pode levar alguns segundos.</p>
            </div>`;

        const alunoId = alunoSelect.value;
        const tipoAtividade = document.getElementById('tipoAtividade')?.value.trim();
        const detalhesAdicionais = document.getElementById('detalhesAdicionais')?.value.trim();

        // Acessa mockAlunos que deve ser global (definido em mockData.js e carregado antes deste script)
        const alunoSelecionado = (typeof mockAlunos !== 'undefined' && Array.isArray(mockAlunos))
            ? mockAlunos.find(a => String(a.id) === String(alunoId))
            : null;

        if (!alunoSelecionado) {
            resultadoDiv.innerHTML = '<p class="text-danger text-center fw-bold mt-3">Erro: Aluno selecionado não foi encontrado nos dados. Por favor, recarregue a página e tente novamente.</p>';
            if (submitButton) submitButton.disabled = false;
            if (btnSpinner) btnSpinner.classList.add('d-none');
            if (btnIcon) btnIcon.classList.remove('d-none');
            if (btnText) btnText.textContent = 'Gerar Atividade com IA';
            return;
        }

        // Construção do Prompt para a IA
        let prompt = `Atue como um especialista em desenvolvimento infantil e pedagogia inclusiva.
        Crie uma sugestão de atividade detalhada, criativa e prática para uma criança com o seguinte perfil:
        - Idade: ${alunoSelecionado.idade} anos.
        - Perfil Principal/Diagnóstico (para direcionar o estímulo): ${alunoSelecionado.perfil}.
        - Principais Interesses (use-os para engajar a criança): ${alunoSelecionado.interesses}.
        - Desafios Atuais ou Habilidades a serem desenvolvidas (este é o foco principal da atividade): ${alunoSelecionado.desafios}.
        ${tipoAtividade ? `\n- Tipo de Atividade Solicitada: ${tipoAtividade}.` : ''}
        ${detalhesAdicionais ? `\n- Observações e Detalhes Adicionais Fornecidos: ${detalhesAdicionais}.` : ''}

        A atividade deve ser:
        * Segura para aplicação em ambiente doméstico, escolar ou terapêutico.
        * Utilizar materiais acessíveis, de baixo custo e comuns.
        * Altamente estimulante, lúdica e perfeitamente adequada à idade e ao perfil da criança.
        * Promover a participação ativa e o engajamento.

        Por favor, estruture sua resposta de forma clara e organizada, utilizando os seguintes tópicos em negrito, cada um seguido por uma explicação concisa e útil:
        **1. Título Criativo da Atividade:** (Ex: Aventura dos Exploradores Sonoros, Missão Resgate das Formas Geométricas)
        **2. Objetivo Principal da Atividade:** (Ex: Desenvolver a discriminação auditiva e a atenção sustentada; Estimular o reconhecimento de formas geométricas e a coordenação motora fina.)
        **3. Materiais Necessários:** (Liste de forma clara, ex: - Papel colorido; - Tesoura sem ponta; - Cola bastão; - Potes de iogurte vazios; - Grãos diversos (feijão, arroz, milho))
        **4. Passo a Passo para Realizar a Atividade:** (Instruções em etapas numeradas, linguagem simples e direta, como se fosse um guia prático.)
        **5. Dicas de Adaptação e Variações:** (Sugestões para simplificar a atividade para crianças com mais dificuldades, ou para torná-la mais desafiadora para aquelas que avançarem rapidamente. Inclua variações para manter o interesse.)
        **6. Observações para Pais/Educadores:** (Pontos cruciais de atenção durante a aplicação, como mediar a interação, o que observar no comportamento da criança, como dar feedback positivo, e como conectar a atividade com outros aprendizados ou rotinas.)

        Use uma linguagem positiva, acolhedora e encorajadora. Evite jargões técnicos desnecessários. A praticidade e a aplicabilidade são essenciais.
        O resultado deve ser um plano de atividade completo e inspirador.`;

        console.log("JS: Enviando prompt para o proxy...");
        // console.log("JS: Prompt completo:", prompt); // Descomente para ver o prompt exato

        try {
            const response = await fetch(APP_BASE_PATH + '/api/gemini_proxy.php', {
                method: 'POST', // <<--- MÉTODO POST EXPLICITAMENTE DEFINIDO
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ prompt: prompt }) // Envia o prompt dentro de um objeto JSON
            });

            let responseDataText = await response.text(); // Pega como texto primeiro para depurar
            console.log("JS: Resposta crua do proxy:", responseDataText);

            if (!response.ok) {
                let errorMsg = `Erro do servidor ao chamar o proxy (${response.status})`;
                try {
                    const errorJson = JSON.parse(responseDataText);
                    errorMsg = errorJson.message || errorJson.error || `Erro ${response.status}: ${response.statusText}`;
                } catch (e) {
                    // Se não for JSON, usa o texto cru se houver, senão o statusText
                    if (responseDataText.trim() !== '') {
                        errorMsg = responseDataText;
                    } else {
                        errorMsg = `Erro ${response.status}: ${response.statusText}`;
                    }
                }
                throw new Error(errorMsg);
            }

            const data = JSON.parse(responseDataText); // Tenta parsear como JSON
            if (data.error) {
                throw new Error(data.error); // Erro específico retornado pelo proxy PHP
            }

            let htmlResposta = data.text || "A IA não forneceu uma sugestão de texto no momento. Tente novamente.";
            // Formatação básica da resposta da IA para HTML
            htmlResposta = htmlResposta.replace(/\*\*(.*?):\*\*/g, '<h5 class="mt-3 mb-2 fw-semibold text-primary">$1:</h5>');
            htmlResposta = htmlResposta.split(/\n\s*\n/).map(paragraph => { // Separa por blocos de parágrafo
                if (paragraph.trim() !== '') {
                    // Transforma linhas que começam com '-' ou '*' em itens de lista dentro do parágrafo
                    let listItems = paragraph.split(/\n/).map(line => {
                        line = line.trim();
                        if (line.startsWith('- ') || line.startsWith('* ')) {
                            return `<li>${line.substring(2)}</li>`;
                        }
                        return line; // Mantém linhas que não são de lista, serão <br>
                    }).join('\n'); // Reagrupa linhas (algumas podem ser <li>, outras texto normal)

                    // Se houver itens de lista, envolve em <ul>
                    if (listItems.includes('<li>')) {
                        listItems = `<ul>${listItems.replace(/\n(?!\s*<li)/g, '<br>').replace(/\n/g, '')}</ul>`; // Remove <br> entre <li>
                    } else {
                        listItems = listItems.replace(/\n/g, '<br>'); // Apenas <br> para outras quebras de linha
                    }
                    return `<p>${listItems}</p>`;
                }
                return '';
            }).join('');
            htmlResposta = htmlResposta.replace(/<p>\s*<\/p>/g, '').replace(/<p><br><\/p>/gi, ''); // Limpa parágrafos vazios

            resultadoDiv.innerHTML = htmlResposta;

        } catch (error) {
            console.error("JS: Erro ao gerar atividade via proxy:", error);
            resultadoDiv.innerHTML = `<div class="alert alert-danger text-center mt-3"><strong>Ops! Algo deu errado ao se comunicar com a IA:</strong><br>${error.message}. <br>Por favor, tente novamente ou verifique o console para mais detalhes.</div>`;
        } finally {
            // Restaurar o estado do botão
            if (submitButton) submitButton.disabled = false;
            if (btnSpinner) btnSpinner.classList.add('d-none');
            if (btnIcon) btnIcon.classList.remove('d-none');
            if (btnText) btnText.textContent = 'Gerar Atividade com IA';
        }
    },

    // Outras funções do app
    adicionarNovoAlunoPlaceholder: function() {
        alert("Simulação: Formulário para adicionar novo perfil apareceria aqui.");
    },
    
    escapeJsString: function(str) { 
        // Implementação da função escapeJsString
        if (typeof str !== 'string') return String(str);
        return str.replace(/\\/g, '\\\\')
                 .replace(/"/g, '\\"')
                 .replace(/'/g, "\\'")
                 .replace(/\n/g, '\\n')
                 .replace(/\r/g, '\\r')
                 .replace(/\t/g, '\\t');
    }
};

// A inicialização de `app.initGeradorAtividadesForm()` é feita no final do
// arquivo `pages/dashboard/gerador-atividades.html` para garantir que o DOM
// daquela view específica esteja pronto.