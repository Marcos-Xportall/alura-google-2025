// js/mockData.js
console.log("JS: mockData.js está sendo carregado e processado.");

// Usar 'var' no escopo mais externo do script garante que a variável
// seja anexada ao objeto 'window' e se torne globalmente acessível
// quando este script é incluído via <script> tag.
var mockAlunos = [
    { 
        id: "1", 
        nome: "Joãozinho Silva", 
        idade: 5, 
        dataNascimento: "15/06/2019",
        perfil: "Transtorno do Espectro Autista (TEA) - Nível 2 de suporte", 
        diagnosticosCID: "F84.0 (Autismo infantil)",
        profissionalResponsavel: "Dra. Márcia Santos - Neuropediatra (CRM 45678)",
        ultimaAvaliacao: "12/02/2024",
        interesses: "Dinossauros, trens, blocos de montar, números, padrões repetitivos, luzes coloridas", 
        desafios: "Comunicação verbal limitada, interação social com pares, flexibilidade em brincadeiras, seguir instruções com múltiplos passos, hipersensibilidade auditiva",
        pontosFortesHabilidades: "Memória visual extraordinária, foco intenso em temas de interesse, reconhecimento de padrões, habilidades numéricas acima da média para a idade",
        medidasAcomodacao: "Uso de cronômetros visuais, cartões de comunicação (PECS), ambiente com estímulos sensoriais reduzidos, rotina visual com pictogramas",
        medicamentos: "Risperidona 0,5mg (noite) - monitoramento comportamental",
        terapiasAtuais: "Fonoaudiologia (2x/semana), Terapia Ocupacional (2x/semana), Psicologia comportamental (1x/semana)",
        objetivosDesenvolvimento: "Aumentar comunicação funcional, desenvolver habilidades de autocuidado, melhorar tolerância a mudanças de rotina"
    },
    { 
        id: "2", 
        nome: "Aninha Santos", 
        idade: 7, 
        dataNascimento: "23/03/2017",
        perfil: "Transtorno do Déficit de Atenção com Hiperatividade (TDAH) - tipo combinado", 
        diagnosticosCID: "F90.0 (Distúrbios da atividade e da atenção)",
        profissionalResponsavel: "Dr. Roberto Almeida - Psiquiatra infantil (CRM 56789)",
        ultimaAvaliacao: "05/04/2024",
        interesses: "Desenhar, correr, animais, música pop, jogos de tablet, construir cabanas", 
        desafios: "Manter o foco em tarefas escolares, organização de materiais, controle impulsivo, completar atividades iniciadas, tempo de espera, seguir instruções sequenciais",
        pontosFortesHabilidades: "Criatividade artística, pensamento inovador, energia para atividades físicas, facilidade em fazer amizades quando supervisionada",
        medidasAcomodacao: "Pausas frequentes durante tarefas, tarefas divididas em etapas menores, sistema de recompensas por conclusão, área de estudo com mínimo de distrações",
        medicamentos: "Metilfenidato 10mg (manhã, dias letivos) - monitoramento periódico",
        terapiasAtuais: "Psicopedagogia (1x/semana), Psicologia cognitivo-comportamental (1x/semana)",
        objetivosDesenvolvimento: "Desenvolver estratégias de autorregulação, melhorar foco sustentado, organizar materiais escolares, gerenciar tempo"
    },
    { 
        id: "3", 
        nome: "Pedrinho Oliveira", 
        idade: 4, 
        dataNascimento: "07/11/2020",
        perfil: "Desenvolvimento Típico, com foco em prontidão escolar", 
        diagnosticosCID: "",
        profissionalResponsavel: "Dra. Carla Mendes - Pediatra (CRM 34567)",
        ultimaAvaliacao: "10/01/2024",
        interesses: "Super-heróis, carrinhos, bolas, pintar com os dedos, histórias de aventura", 
        desafios: "Reconhecimento de letras e números, coordenação motora fina para escrita inicial, atenção durante leitura compartilhada",
        pontosFortesHabilidades: "Vocabulário desenvolvido, sociabilidade, criatividade em brincadeiras de faz-de-conta, curiosidade sobre o mundo",
        medidasAcomodacao: "",
        medicamentos: "",
        terapiasAtuais: "",
        objetivosDesenvolvimento: "Desenvolver pré-alfabetização, coordenação motora fina, reconhecimento de números até 20, escrita do próprio nome"
    },
    { 
        id: "4", 
        nome: "Sofia Pereira", 
        idade: 6, 
        dataNascimento: "14/02/2018",
        perfil: "Criança criativa, um pouco tímida em novas situações", 
        diagnosticosCID: "",
        profissionalResponsavel: "Dra. Luísa Campos - Pediatra (CRM 67890)",
        ultimaAvaliacao: "20/03/2024",
        interesses: "Contos de fadas, vestir fantasias, natureza, construir cabanas, desenhar", 
        desafios: "Expressar ideias verbalmente em grupo, iniciar interações sociais com desconhecidos, timidez em ambientes novos",
        pontosFortesHabilidades: "Imaginação rica, empatia, concentração em atividades de interesse, habilidades narrativas e de leitura emergente",
        medidasAcomodacao: "",
        medicamentos: "",
        terapiasAtuais: "",
        objetivosDesenvolvimento: "Desenvolver confiança em situações sociais, aprimorar a alfabetização, estimular expressão verbal em grupos maiores"
    },
    { 
        id: "5", 
        nome: "Lucas Mendes", 
        idade: 8, 
        dataNascimento: "30/09/2016",
        perfil: "Transtorno do Espectro Autista (TEA) - Nível 1 de suporte, com altas habilidades em matemática", 
        diagnosticosCID: "F84.5 (Síndrome de Asperger)",
        profissionalResponsavel: "Dr. Paulo Ribeiro - Neurologista (CRM 23456)",
        ultimaAvaliacao: "08/03/2024",
        interesses: "Matemática, astronomia, xadrez, programação de jogos simples, mapas e geografias", 
        desafios: "Compreensão de regras sociais implícitas, flexibilidade cognitiva, interpretação de linguagem figurada, escrita manual (disgrafia leve)",
        pontosFortesHabilidades: "Cálculo mental avançado, memória excepcional para fatos e datas, vocabulário amplo, foco prolongado em áreas de interesse",
        medidasAcomodacao: "Preparação prévia para transições, explicações diretas e literais, uso de computador para tarefas escritas, intervalos sensoriais",
        medicamentos: "",
        terapiasAtuais: "Terapia comportamental (1x/semana), Grupo de habilidades sociais (1x/semana)",
        objetivosDesenvolvimento: "Aprimorar habilidades sociais, desenvolver estratégias para lidar com ansiedade, melhorar coordenação motora fina"
    },
    { 
        id: "6", 
        nome: "Mariana Costa", 
        idade: 5, 
        dataNascimento: "18/07/2019",
        perfil: "Atraso global do desenvolvimento com hipotonia", 
        diagnosticosCID: "F83 (Transtornos específicos misto do desenvolvimento)",
        profissionalResponsavel: "Dra. Juliana Ferreira - Neurologista pediátrica (CRM 78901)",
        ultimaAvaliacao: "25/02/2024",
        interesses: "Músicas infantis, brinquedos com texturas diversas, animais de pelúcia, filmes animados coloridos", 
        desafios: "Atraso na fala (vocabulário de aproximadamente 30 palavras), coordenação motora global, equilíbrio, dificuldades na preensão de objetos pequenos",
        pontosFortesHabilidades: "Afetividade, memória musical, reconhecimento visual, persistência em atividades motivadoras",
        medidasAcomodacao: "Cadeira adaptada, materiais com alças e texturas para facilitar preensão, comunicação aumentativa, instruções simplificadas",
        medicamentos: "",
        terapiasAtuais: "Fisioterapia (2x/semana), Fonoaudiologia (2x/semana), Terapia Ocupacional (1x/semana)",
        objetivosDesenvolvimento: "Expandir vocabulário funcional, melhorar tônus muscular e coordenação motora, desenvolver independência em atividades diárias básicas"
    },
    { 
        id: "7", 
        nome: "Rafael Sousa", 
        idade: 9, 
        dataNascimento: "03/05/2015",
        perfil: "Dislexia e Discalculia", 
        diagnosticosCID: "F81.0 (Transtorno específico de leitura) e F81.2 (Transtorno específico da habilidade em aritmética)",
        profissionalResponsavel: "Dra. Fernanda Martins - Neuropsicóloga (CRP 12345)",
        ultimaAvaliacao: "14/04/2024",
        interesses: "Esportes coletivos, ciências com experimentos práticos, construções com blocos, histórias em quadrinhos", 
        desafios: "Dificuldade na decodificação de palavras, compreensão leitora, sequência numérica, operações matemáticas básicas, baixa autoestima acadêmica",
        pontosFortesHabilidades: "Raciocínio espacial, habilidades atléticas, pensamento criativo para resolução de problemas, excelente memória auditiva",
        medidasAcomodacao: "Tempo adicional para tarefas escritas, uso de calculadora, material de leitura adaptado, avaliações orais complementares",
        medicamentos: "",
        terapiasAtuais: "Psicopedagogia (2x/semana), Acompanhamento psicológico (1x/semana)",
        objetivosDesenvolvimento: "Desenvolver estratégias compensatórias para leitura e matemática, fortalecer autoconfiança, aprimorar método de estudo personalizado"
    }
];

console.log("JS: mockAlunos definidos em mockData.js. Quantidade:", (typeof mockAlunos !== 'undefined' ? mockAlunos.length : 'indefinido'));

// Dados mockados para profissionais parceiros
var mockProfissionais = [
    { 
        id: 1, 
        nome: "Dra. Márcia Santos", 
        especialidade: "Neuropediatria", 
        registro: "CRM 45678", 
        localAtendimento: "Centro Clínico Saúde Plena",
        telefone: "(11) 3456-7890",
        atendePlano: true
    },
    { 
        id: 2, 
        nome: "Dr. Roberto Almeida", 
        especialidade: "Psiquiatria Infantil", 
        registro: "CRM 56789", 
        localAtendimento: "Instituto Neurobehavioral",
        telefone: "(11) 4567-8901", 
        atendePlano: true
    },
    { 
        id: 3, 
        nome: "Patrícia Lima", 
        especialidade: "Fonoaudiologia", 
        registro: "CRFa 12345", 
        localAtendimento: "Clínica Desenvolver",
        telefone: "(11) 2345-6789", 
        atendePlano: false
    },
    { 
        id: 4, 
        nome: "Carlos Eduardo Gomes", 
        especialidade: "Terapia Ocupacional", 
        registro: "CREFITO 34567", 
        localAtendimento: "Centro de Reabilitação Integrar",
        telefone: "(11) 5678-9012", 
        atendePlano: true
    },
    { 
        id: 5, 
        nome: "Ana Beatriz Ferreira", 
        especialidade: "Psicologia ABA", 
        registro: "CRP 23456", 
        localAtendimento: "Instituto Comportamental Avançado",
        telefone: "(11) 6789-0123", 
        atendePlano: false
    }
];

// Dados mockados para recursos educacionais
var mockRecursos = [
    { 
        id: 1, 
        titulo: "Entendendo o TDAH na Infância", 
        descricao: "Guia completo para pais e educadores sobre como identificar e apoiar crianças com TDAH",
        tipo: "E-book", 
        categoria: "TDAH",
        linkAcesso: "#recurso-tdah",
        dataCriacao: "10/01/2024"
    },
    { 
        id: 2, 
        titulo: "Atividades Sensoriais para Crianças com TEA", 
        descricao: "Coletânea de 50 atividades práticas para estimulação sensorial adequadas para diferentes perfis sensoriais",
        tipo: "Guia Prático", 
        categoria: "TEA",
        linkAcesso: "#recurso-tea-sensorial",
        dataCriacao: "15/02/2024"
    },
    { 
        id: 3, 
        titulo: "Alfabetização para Crianças com Dislexia", 
        descricao: "Métodos e estratégias multissensoriais para apoiar o processo de alfabetização",
        tipo: "Curso Online", 
        categoria: "Dislexia",
        linkAcesso: "#recurso-dislexia",
        dataCriacao: "05/03/2024"
    },
    { 
        id: 4, 
        titulo: "Comunicação Alternativa: Guia de Implementação", 
        descricao: "Tutorial passo a passo para implementar sistemas de comunicação aumentativa e alternativa em casa",
        tipo: "Tutorial", 
        categoria: "Comunicação",
        linkAcesso: "#recurso-comunicacao",
        dataCriacao: "20/03/2024"
    },
    { 
        id: 5, 
        titulo: "Brincadeiras que Estimulam o Desenvolvimento", 
        descricao: "Sugestões de jogos e atividades lúdicas que promovem habilidades fundamentais para todas as crianças",
        tipo: "Infográfico", 
        categoria: "Geral",
        linkAcesso: "#recurso-brincadeiras",
        dataCriacao: "12/04/2024"
    }
];

// Dados mockados para histórico de atividades geradas
var mockHistoricoAtividades = [
    {
        id: 1,
        idAluno: "1",
        dataGeracao: "10/05/2024",
        titulo: "Caça ao Tesouro dos Dinossauros",
        foco: "Comunicação funcional e interação",
        aplicada: true,
        feedbackPai: "Ele adorou! Ficou super engajado e usou várias palavras novas",
        notaEficacia: 5
    },
    {
        id: 2,
        idAluno: "1",
        dataGeracao: "03/05/2024",
        titulo: "Estação de Classificação de Trens por Cores",
        foco: "Permanência na tarefa e categorização",
        aplicada: true,
        feedbackPai: "Atividade excelente, mas precisamos adaptar para ter menos itens",
        notaEficacia: 4
    },
    {
        id: 3,
        idAluno: "2",
        dataGeracao: "12/05/2024",
        titulo: "Circuito de Obstáculos com Desafios Artísticos",
        foco: "Controle inibitório e coordenação",
        aplicada: false,
        feedbackPai: "",
        notaEficacia: 0
    },
    {
        id: 4,
        idAluno: "5",
        dataGeracao: "08/05/2024",
        titulo: "Criação de Sistema Solar em Escala",
        foco: "Habilidades sociais através de interesse específico",
        aplicada: true,
        feedbackPai: "Perfeito! Lucas conseguiu explicar o projeto para os colegas",
        notaEficacia: 5
    },
    {
        id: 5,
        idAluno: "3",
        dataGeracao: "11/05/2024",
        titulo: "Fazendinha Alfabética",
        foco: "Reconhecimento de letras",
        aplicada: true,
        feedbackPai: "Divertido e educativo. Vamos repetir!",
        notaEficacia: 5
    }
];