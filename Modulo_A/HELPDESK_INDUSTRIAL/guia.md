Ao final da atividade, sua equipe deverá demonstrar domínio de:

• formulários HTML e recebimento de dados no PHP;
• operações de cadastro, consulta, edição e exclusão (CRUD);
• validação no servidor e consultas preparadas;
• busca, filtros e indicadores calculados a partir do banco;
• organização do código, responsividade e acessibilidade.

Técnologias: HTML, CSS, PHP e MySQL.

# Guia Banco de Dados:
Campo            | Informação e regra
Código           | Identificador único, com PRIMARY KEY e AUTO_INCREMENT.
Solicitante      | Obrigatório; de 3 a 100 caracteres.
E-mail           | Obrigatório; formato válido e até 150 caracteres.
Setor            | Produção, Administrativo, Logística ou TI.
Título           | Obrigatório; de 5 a 100 caracteres.
Descrição        | Obrigatória; de 10 a 1.000 caracteres.
Prioridade       | Baixa, Média ou Alta.
Status           | Aberto, Em atendimento ou Finalizado. Novo chamado começa como Aberto.
Data de abertura | Data e horário registrados automaticamente, sem preenchimento pelo usuário.


# Missões:

MISSÃO 1 - CRIAR O FORMULÁRIO
Crie um formulário com os campos necessários para abrir um chamado. Utilize rótulos claros, campos adequados e listas de seleção para setor e prioridade.

MISSÃO 2 - VALIDAR NO PHP
Receba os dados no servidor, remova espaços desnecessários das extremidades e verifique preenchimento, tamanho e formato. Campos contendo apenas espaços devem ser considerados vazios. Setor, prioridade e status devem aceitar somente as opções previstas, inclusive no processamento PHP. Dados inválidos não podem ser gravados.

MISSÃO 3 - SALVAR E INFORMAR O RESULTADO
Cadastre o chamado com status Aberto e data automática. Mostre uma mensagem de sucesso. Se
houver erro de validação, explique o problema e preserve os campos preenchidos. Atualizar a página após um cadastro não pode criar um registro duplicado.

MISSÃO 4 - LISTAR OS CHAMADOS
Apresente os chamados do mais recente para o mais antigo. Mostre código, título, solicitante, setor, prioridade, status e data de abertura. Disponibilize ações para consultar, editar e excluir.

MISSÃO 5 - VISUALIZAR OS DETALHES
Permita consultar todos os dados de um chamado, incluindo e-mail e descrição completa. Ao receber um código inválido ou inexistente, apresente uma mensagem amigável.

MISSÃO 6 - EDITAR UM CHAMADO
Carregue os dados atuais em um formulário e permita alterar os dados informados pelo usuário e o status. Reaplique as validações do cadastro. Preserve o código e a data de abertura.

MISSÃO 7 - EXCLUIR COM CONFIRMAÇÃO
Solicite confirmação antes de excluir. Se o usuário cancelar, o registro deve permanecer no banco. A remoção deve ocorrer por uma requisição POST. Informe o sucesso da operação.

MISSÃO 8 - LOCALIZAR SOLICITAÇÕES
Crie uma busca por título e um filtro por status. As duas condições devem funcionar simultaneamente. Disponibilize a opção de visualizar todos os status. Quando não houver resultados, apresente: “Nenhum chamado encontrado”.

MISSÃO 9 - APRESENTAR INDICADORES
Mostre a quantidade total de chamados e as quantidades de chamados Abertos, Em atendimento e Finalizados. Calcule os valores com base nos registros do banco. Os indicadores devem considerar todos os chamados, independentemente dos filtros aplicados à listagem. O painel e a listagem podem ocupar a mesma página. A equipe pode definir a organização das demais telas, mantendo a navegação consistente.

# FOCOS:

- Banco e estrutura inicial + Banco e conexão funcionando.

- Cadastro e listagem + Registros salvos e consultados.

- Consulta, edição e exclusão + Operações principais concluídas.

- Busca, painel e interface + Filtros, indicadores e usabilidade.

- Testes e entrega + Aplicação verificada e arquivos organizados.

# ENTREGA
Inclua todos os arquivos PHP, HTML, CSS necessários para executar a aplicação, além dos recursos locais utilizados.

Entregue o arquivo banco.sql com a criação do banco, estrutura da tabela e pelo menos 8 chamados fictícios, distribuídos entre os status e as prioridades.

Inclua um README.txt com nome da equipe, integrantes, configuração da conexão, instruções para importar o banco e executar a aplicação, além de funcionalidades pendentes.