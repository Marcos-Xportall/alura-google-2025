```markdown
# ALFA-INCLUIR - Plataforma de Apoio ao Desenvolvimento Infantil

ALFA-INCLUIR é uma aplicação web projetada para auxiliar pais, educadores e terapeutas na criação de atividades personalizadas e recursos visuais para crianças, com foco especial em necessidades de desenvolvimento.

## Funcionalidades Principais

*   **Painel de Controle (Dashboard):** Acesso centralizado a todas as funcionalidades.
*   **Gerador de Atividades Personalizadas:** Utiliza IA (simulada ou integrada) para sugerir atividades com base no perfil, interesses e desafios da criança.
*   **Gerador de Etiquetas Visuais:** Criação e impressão de etiquetas com ícones e texto para auxiliar na comunicação e aprendizado (ex: identificar objetos, rotinas).
*   **Gestão de Perfis:**
    *   Para usuários domésticos: "Meus Filhos".
    *   Para usuários profissionais: "Gerenciar Alunos".
*   **Recursos e Dicas:** Acesso a artigos e materiais de apoio.
*   **Simulação de Login:** Permite testar diferentes perfis de usuário (Doméstico, Profissional, Admin).

## Pré-requisitos

*   **XAMPP:** Recomendamos o uso do XAMPP para um ambiente de desenvolvimento local fácil de configurar, que inclui Apache (servidor web) e PHP.
    *   Faça o download em: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)
*   **Navegador Web Moderno:** Chrome, Firefox, Edge, Safari.
*   **Conexão com a Internet:** Necessária para carregar bibliotecas externas (Bootstrap, Font Awesome, etc.) via CDN e para a funcionalidade de IA (se conectada a uma API externa).

## Configuração e Instalação com XAMPP

1.  **Instale o XAMPP:**
    *   Siga as instruções de instalação do XAMPP para o seu sistema operacional (Windows, macOS, Linux).
    *   Durante a instalação, certifique-se de que os componentes **Apache** e **PHP** estão selecionados. MySQL não é estritamente necessário para a versão atual do projeto (que usa `mockData.js` e não um banco de dados real), mas pode ser útil para futuras expansões.

2.  **Clone ou Baixe o Projeto:**
    *   Se estiver usando Git:
        ```bash
        git clone <URL_DO_SEU_REPOSITORIO_GIT> alfa-incluir-demo-php
        ```
        (Substitua `<URL_DO_SEU_REPOSITORIO_GIT>` pela URL real do seu repositório. Se estiver clonando pela primeira vez, o nome da pasta será `alfa-incluir-demo-php` por padrão se o repositório tiver esse nome, ou você pode especificar o nome da pasta como no exemplo.)
    *   Ou baixe o arquivo ZIP do projeto e extraia-o para uma pasta chamada `alfa-incluir-demo-php`.

3.  **Mova os Arquivos do Projeto para a Pasta `htdocs` do XAMPP:**
    *   A pasta `htdocs` é o diretório raiz do servidor web Apache no XAMPP.
    *   **Windows:** Geralmente `C:\xampp\htdocs\`
    *   **macOS:** Geralmente `/Applications/XAMPP/xamppfiles/htdocs/`
    *   **Linux:** Geralmente `/opt/lampp/htdocs/`
    *   Mova a pasta `alfa-incluir-demo-php` (contendo todos os arquivos do projeto) para dentro de `htdocs`.
        *   Estrutura final esperada: `C:\xampp\htdocs\alfa-incluir-demo-php\[arquivos_do_projeto]`

4.  **Verifique o Caminho Base da Aplicação (APP_BASE_PATH):**
    *   O projeto utiliza uma variável `APP_BASE_PATH` para construir URLs corretamente. Ela é definida em `partials/header.php` e também usada em `app.js`, `dashboard.php` e `login.php`.
    *   Por padrão, esta variável está configurada como `/alfa-incluir-demo-php`.
    *   **Se você manteve o nome da pasta do projeto como `alfa-incluir-demo-php` dentro de `htdocs` (conforme recomendado), nenhuma alteração é necessária nesta configuração.**
    *   Caso você, por algum motivo, tenha renomeado a pasta do projeto dentro de `htdocs` para algo diferente, você precisaria atualizar esta variável nos seguintes locais para corresponder ao novo nome da pasta (ex: se renomeou para `/meu-alfa/`, atualize para `/meu-alfa`):
        *   `partials/header.php` (variável `$basePath`)
        *   `app.js` (constante `APP_BASE_PATH` no fallback)
        *   `dashboard.php` (variável `$_localBasePath`)
        *   `login.php` (variável `$base_url_project`)
    *   **Observação:** É crucial que este caminho comece com uma barra `/` e corresponda exatamente ao nome da pasta do projeto dentro de `htdocs`.

5.  **Inicie os Módulos do XAMPP:**
    *   Abra o Painel de Controle do XAMPP.
    *   Inicie os módulos **Apache**.
    *   Se você encontrar problemas de porta bloqueada para o Apache (geralmente a porta 80), o XAMPP geralmente oferece opções para alterar a porta ou você pode precisar parar outros serviços que estejam usando a mesma porta (como Skype ou IIS).

## Como Usar a Aplicação

1.  **Acesse o Projeto no Navegador:**
    *   Após iniciar o Apache no XAMPP, abra seu navegador web.
    *   Digite a URL: `http://localhost/alfa-incluir-demo-php/`
    *   Você deverá ser redirecionado para a página de login (`login.php`).

2.  **Login (Simulado):**
    *   A página de login oferece botões para simular o login com diferentes perfis de usuário:
        *   "Entrar como Doméstico"
        *   "Entrar como Profissional"
        *   "Entrar como Administrador"
    *   Clique em um dos botões para acessar o painel de controle com as permissões correspondentes.

3.  **Navegando no Dashboard:**
    *   O painel principal exibirá cards para as diferentes funcionalidades disponíveis para o seu perfil.
    *   Clique em um card para acessar a funcionalidade desejada.

4.  **Gerador de Atividades:**
    *   Selecione uma criança/aluno da lista (os dados são carregados de `js/mockData.js`).
    *   Opcionalmente, defina um foco principal para a atividade.
    *   Adicione detalhes e observações.
    *   Clique em "Gerar Atividade com IA". A sugestão aparecerá ao lado.
        *   *Nota: A "IA" é uma simulação que envia um prompt para `api/gemini_proxy.php`. Para uma IA real, este proxy precisaria ser conectado a um serviço como a API do Google Gemini, e você precisaria de uma chave de API.*

5.  **Gerador de Etiquetas Visuais:**
    *   Digite o nome de um item e clique em "Adicionar". Um ícone (de Font Awesome) será sugerido.
    *   Escolha a cor da borda e o layout das etiquetas (vertical ou horizontal).
    *   A pré-visualização mostrará como as etiquetas aparecerão em uma folha A4.
    *   Clique em "Gerar PDF para Impressão (A4)" para baixar o arquivo PDF.

## Estrutura do Projeto

```
/alfa-incluir-demo-php/
|-- api/
|   |-- gemini_proxy.php       # Proxy para simulação/integração com IA
|-- assets/
|   |-- css/
|   |   |-- style.css          # Estilos principais
|   |-- img/                   # Imagens da aplicação
|   |-- js/
|   |   |-- app.js             # Lógica JavaScript principal
|   |   |-- mockData.js        # Dados simulados de alunos/crianças
|-- pages/
|   |-- dashboard/
|   |   |-- admin/             # Views específicas do admin
|   |   |-- geradorAtividades.html
|   |   |-- gerarEtiquetas.html
|   |   |-- meus-filhos.html
|   |   |-- ... (outras views do dashboard)
|   |-- errors/
|   |   |-- 403.php
|   |   |-- 404.php
|-- partials/
|   |-- footer.php
|   |-- header.php
|-- index.php                  # Página inicial da landing page
|-- dashboard.php              # Roteador e layout principal do painel
|-- login.php                  # Página de login e simulação de papéis
|-- logout.php                 # Script de logout
|-- README.md                  # Este arquivo
|-- ... (outros arquivos raiz como .htaccess, se houver)
```

## Solução de Problemas Comuns

*   **Página em Branco ou Erro 404 ao acessar `http://localhost/alfa-incluir-demo-php/`:**
    *   Verifique se o Apache está rodando no XAMPP.
    *   Confirme se o nome da pasta no URL (`alfa-incluir-demo-php`) está correto.
    *   Verifique se há um arquivo `index.php` ou `login.php` na raiz da pasta do projeto.
*   **Estilos CSS ou JavaScript Não Carregam (Página sem formatação, funcionalidades quebradas):**
    *   Abra as ferramentas de desenvolvedor do navegador (geralmente F12) e verifique a aba "Console" por erros de "404 Not Found" para arquivos CSS ou JS.
    *   Confirme se os caminhos para os arquivos CSS/JS no `partials/header.php` e `partials/footer.php` estão corretos em relação à `APP_BASE_PATH`.
*   **"Objeto não encontrado!" ou erros similares ao clicar em links:**
    *   Verifique se a configuração de `APP_BASE_PATH` (conforme o passo 4 da instalação) está correta e consistente em todos os arquivos mencionados.
    *   Se você estiver usando um arquivo `.htaccess` para URLs amigáveis, certifique-se de que o módulo `mod_rewrite` do Apache está habilitado (no XAMPP, geralmente está por padrão, mas pode ser verificado no `httpd.conf` ou pelo painel do XAMPP).
*   **Problemas com a "IA" no Gerador de Atividades:**
    *   Se a funcionalidade de IA não retornar resultados, verifique o console do navegador e a aba "Rede" (Network) para ver a requisição para `gemini_proxy.php` e sua resposta.
    *   O arquivo `gemini_proxy.php` atual é uma simulação. Para uma IA real, ele precisaria ser configurado com uma chave de API válida para um serviço como Google Gemini.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir *issues* para bugs ou sugestões de novas funcionalidades, ou *pull requests* com melhorias.
```

**Para usar este arquivo:**