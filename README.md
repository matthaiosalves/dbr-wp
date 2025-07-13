# dbr-wp

## Resumo geral do projeto

**dbr-wp** é um tema WordPress customizado desenvolvido para um fã site do Habbo Hotel, servindo como blog e jornal do jogo. O objetivo principal do projeto é oferecer um ambiente organizado, moderno e de fácil manutenção para publicação de notícias e conteúdos do universo Habbo, além de migrar uma solução PHP pura (MVC) para a arquitetura WordPress, garantindo mais performance, segurança e escalabilidade.

## Principais funcionalidades

- Portal de notícias sobre Habbo Hotel
- Páginas customizadas (equipe, perfil, painel, etc.)
- Login e gerenciamento de usuários adaptado à proposta do site
- Layout personalizado e responsivo
- Organização de categorias e notícias
- Área de painel e permissões customizadas
- Estrutura modular visando fácil manutenção e evolução futura

## Como instalar e rodar

1. **Pré-requisitos**

   - Instalação padrão do WordPress (5.8+ recomendado)
   - Acesso ao painel de administração do WordPress

2. **Instalação do tema**

   - Baixe o tema (`dbr-wp`) em formato ZIP.
   - No painel do WordPress, acesse _Aparência > Temas > Adicionar novo > Enviar tema_.
   - Selecione o arquivo ZIP e clique em _Instalar agora_.
   - Após a instalação, ative o tema.

3. **Configurações adicionais**
   - Recomenda-se revisar as páginas criadas automaticamente e configurar menus, widgets e opções do tema conforme a necessidade do site.

## Principais dependências e requisitos

- **WordPress:** 5.8 ou superior
- **PHP:** 7.4 ou superior
- Não há dependências externas via Composer ou npm/yarn — a instalação é 100% padrão WordPress

## Estrutura de pastas e arquivos principais

| Arquivo                           | Descrição                                                               |
| --------------------------------- | ----------------------------------------------------------------------- |
| `404.php`                         | Página de erro padrão para URLs não encontradas                         |
| `cadastrar.php`                   | Página customizada para cadastro de usuários                            |
| `category.php`                    | Template de listagem por categoria de posts                             |
| `comments.php`                    | Template para gerenciamento e exibição de comentários                   |
| `equipe.php`                      | Página para exibição da equipe do site                                  |
| `esqueceu-senha.php`              | Página de recuperação de senha personalizada                            |
| `fale-conosco.php`                | Página de contato/fale conosco                                          |
| `footer.php`                      | Rodapé do tema, presente em todas as páginas                            |
| `functions.php`                   | Funções customizadas, hooks, integrações e registro de recursos do tema |
| `header.php`                      | Cabeçalho do tema, presente em todas as páginas                         |
| `index.php`                       | Arquivo principal, controla o carregamento do tema                      |
| `login.php`                       | Página customizada de login                                             |
| `minhas-noticias.php`             | Página personalizada para exibição de notícias do usuário               |
| `page.php`                        | Template padrão de páginas                                              |
| `painel.php`                      | Painel do usuário, com funcionalidades customizadas                     |
| `perfil.php`                      | Página de perfil do usuário                                             |
| `permissões.php`                  | Controle e exibição de permissões especiais no sistema                  |
| `search.php`                      | Página de resultados de busca                                           |
| `seja-dbr.php`                    | Página institucional para “Seja DBR”                                    |
| `sidebar.php`                     | Barra lateral do tema                                                   |
| `single-noticia.php`              | Template de exibição de uma notícia individual                          |
| `style.css`                       | Estilos principais do tema (obrigatório para temas WP)                  |
| `todas-noticias.php`              | Listagem de todas as notícias do site                                   |
| `.eslintrc` e `.stylelintrc.json` | Configurações de código e formatação para devs                          |
| `composer.json`, `package.json`   | (Não utilizados para instalação; apenas referências de projeto)         |
| `LICENSE`                         | Licença do projeto                                                      |
| `screenshot.png`                  | Imagem de preview do tema para exibição no painel WP                    |
| `README.md`, `readme.txt`         | Documentação do projeto e instruções rápidas                            |

## Exemplos de uso

- **Publicar uma nova notícia:**  
  Acesse o painel do WordPress, clique em _Posts > Adicionar novo_, preencha os dados e publique.  
  A notícia será exibida automaticamente na página inicial e nas seções correspondentes.

- **Gerenciar perfil:**  
  Usuários logados podem acessar o menu de perfil para editar informações, visualizar suas notícias e acessar áreas restritas conforme permissões.

- **Equipe e contato:**  
  As páginas de equipe e contato estão disponíveis no menu principal, facilitando a comunicação e apresentação dos colaboradores do fã site.

## Como contribuir

No momento, o projeto é fechado para contribuições externas.  
Caso queira sugerir melhorias ou relatar bugs, entre em contato diretamente com o mantenedor.

## Contato/Suporte

Para dúvidas, sugestões ou suporte, utilize o formulário de contato no site ou envie um e-mail para o administrador indicado no painel WordPress.

---
