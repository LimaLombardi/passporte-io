# Passaporte.io

Projeto de conclusão de bimestre. Sistema para cadastro de eventos e inscrição de participantes.

**Aluno:** Enzo de Lima Lombardi 
**Disciplina:** 3DSA

## Tecnologias

- Laravel 12
- PHP 8.4+
- MySQL
- DaisyUI
- Tailwind CSS

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

- `.env` (senhas e configurações locais)
- `vendor/`
- `node_modules/`
