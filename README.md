# Passaporte.io

Projeto de conclusão de bimestre. Sistema para cadastro de eventos e inscrição de participantes.

**Aluno:** [seu nome]  
**Disciplina:** [nome da disciplina]

## Tecnologias

- Laravel 12
- PHP 8.4+
- MySQL
- Blade
- DaisyUI
- Tailwind CSS

## Como rodar localmente

1. Clone o repositório e entre na pasta do projeto.

2. Instale as dependências:

```bash
composer install
npm install
```

3. Copie o arquivo de ambiente e gere a chave:

```bash
copy .env.example .env
php artisan key:generate
```

4. Crie o banco no MySQL:

```sql
CREATE DATABASE passaporte_io;
```

5. Ajuste o `.env` se precisar (usuário/senha do MySQL):

```
DB_DATABASE=passaporte_io
DB_USERNAME=root
DB_PASSWORD=
```

6. Rode as migrations e os seeders:

```bash
php artisan migrate --seed
php artisan storage:link
```

7. Compile os assets e inicie o servidor:

```bash
npm run build
php artisan serve
```

Acesse `http://localhost:8000`.

O MySQL precisa estar rodando (no Laragon: **Start All**).

## Usuários do seeder

Depois do `--seed`, estes usuários ficam disponíveis:

| Tipo | E-mail | Senha |
|------|--------|-------|
| Organizador | organizador@passaporte.io | password |
| Participante | participante@passaporte.io | password |

## Perfis de acesso

**Visitante** — vê a listagem e os detalhes dos eventos.

**Participante** — faz login, se inscreve, cancela inscrição e vê seus ingressos em `/meus-eventos`.

**Organizador** — cria, edita e exclui eventos em `/organizador/eventos` (somente os próprios).

## Banco de dados

- `users` — usuários com role (`participant` ou `organizer`)
- `categories` — categorias dos eventos
- `events` — eventos criados pelos organizadores
- `event_user` — inscrições (código do ingresso e status)

## Regras implementadas

- Data do evento não pode ser no passado
- Banner: só imagem, até 2 MB
- Não exclui evento com inscritos
- Bloqueia inscrição duplicada e evento lotado
- Gera código do ingresso com `Str::random(10)`

## Subir no GitHub

### 1. Criar o repositório

1. Acesse [github.com/new](https://github.com/new)
2. Escolha um nome (ex: `passaporte-io`)
3. Deixe **sem** README, .gitignore ou licença (já existem no projeto)
4. Clique em **Create repository**

### 2. Enviar o código pelo terminal

Na pasta do projeto:

```bash
git init
git add .
git commit -m "Projeto Passaporte.io - gerenciamento de eventos"
git branch -M main
git remote add origin https://github.com/SEU-USUARIO/passaporte-io.git
git push -u origin main
```

Troque `SEU-USUARIO` pelo seu usuário do GitHub.

Se o Git pedir login, use seu usuário e um **Personal Access Token** como senha (GitHub → Settings → Developer settings → Personal access tokens).

### 3. Conferir antes do push

O `.gitignore` já ignora:

- `.env` (senhas e configurações locais)
- `vendor/`
- `node_modules/`

Nunca commite o arquivo `.env`.
