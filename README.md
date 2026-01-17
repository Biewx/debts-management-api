# Debts Management API

API backend para controle de dívidas pessoais, desenvolvida com foco em **regras de negócio explícitas**, **modelo de domínio claro** e **organização de código**, evitando overengineering.

Este projeto não tem frontend e não pretende ser um sistema completo, mas sim um **exercício consciente de modelagem e arquitetura backend**.

---

## Visão Geral

O sistema permite:

- Criar dívidas
- Registrar pagamentos (parciais ou totais)
- Atualizar automaticamente o estado da dívida
- Manter um histórico imutável de pagamentos
- Consultar dívidas por status
- Consultar histórico de pagamentos de uma dívida

O foco principal **não é CRUD**, mas sim:

- estados da dívida
- regras de negócio no domínio
- separação clara entre domínio e infraestrutura

---

## Escopo do Projeto

### O que o projeto faz

- Controle de dívidas com estados explícitos (`OPEN`, `PARTIAL`, `PAID`)
- Pagamentos parciais e totais
- Histórico de pagamentos imutável
- API REST simples e direta
- Código organizado para ser facilmente explicável em entrevistas

### O que o projeto não faz

- Autenticação / autorização
- Controle de usuários
- Parcelamento automático
- Relatórios avançados
- Interface gráfica
- Regras financeiras complexas

Essas decisões foram **intencionais** para manter o foco em domínio e arquitetura.

---

## Modelo de Domínio

### Debt

Representa uma dívida.

Características:

- Possui valor total
- Mantém quanto já foi pago
- Controla seu próprio estado
- Decide suas próprias regras

Estados possíveis:

- `OPEN` — nenhum pagamento realizado
- `PARTIAL` — pagamento parcial
- `PAID` — dívida quitada

As regras de negócio **não ficam no controller**.  
A própria entidade decide se um pagamento é válido e como o estado deve mudar.

---

### Payment

Representa um **fato ocorrido**, não algo editável.

Características:

- Valor do pagamento
- Data/hora do pagamento
- Referência à dívida
- Imutável após criado

Um pagamento **sempre nasce a partir de uma dívida**, como consequência de um ato de pagamento.

---

## Decisões Arquiteturais

- O domínio **não depende do Laravel**
- Controllers apenas orquestram chamadas
- Regras de negócio ficam nas entidades
- Persistência é abstraída por repositórios
- Infraestrutura (Eloquent) é isolada do domínio
- Entidades não conhecem banco de dados

Essas decisões tornam o código:

- mais legível
- mais testável
- mais fácil de explicar

Trade-off consciente:  
algumas leituras retornam dados simples, sem reconstruir entidades completas, para evitar complexidade desnecessária.

---

## Fluxo Principal: Pagamento de Dívida

1. A API recebe o valor do pagamento
2. A dívida valida as regras de negócio
3. Um pagamento é criado como registro histórico
4. O estado da dívida é atualizado automaticamente
5. Ambos são persistidos

O controller **não decide regras**, apenas coordena o fluxo.

---

## Tecnologias Utilizadas

- PHP
- Laravel
- MySQL
- Eloquent ORM

---

## Como Rodar o Projeto

```bash
git clone <repo>
cd debts-management-api
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

---
````
## Possíveis Melhorias

Uso explícito de transações

Testes automatizados

Autenticação

Relatórios

Paginação em consultas

Essas melhorias foram deixadas fora do escopo atual intencionalmente.

## Considerações Finais

Este projeto foi desenvolvido com foco em clareza, decisões conscientes e domínio explícito, buscando representar um nível de maturidade esperado de um desenvolvedor backend em início de carreira profissional.
```
