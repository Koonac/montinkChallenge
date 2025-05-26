# 🛒 Mini ERP - Controle de Pedidos, Produtos, Cupons e Estoque
Este projeto é um mini ERP desenvolvido com PHP puro, utilizando o padrão MVC, boas práticas de desenvolvimento e foco em código limpo e manutenível. Ele permite o gerenciamento de produtos, controle de estoque, criação de pedidos com regras de frete, integração com a API ViaCEP, e outras funcionalidades essenciais para um sistema de vendas.

---

## 🚀 Funcionalidades

- Cadastro e atualização de produtos com:
  - Nome
  - Preço
  - Variações
  - Estoque (associado corretamente à tabela de produtos)
- Adição de produtos a um carrinho de compras com controle de estoque.
- Cálculo automático de frete, baseado no valor do subtotal:
  - R$52,00 até R$166,59 → R$15,00 de frete
  - Acima de R$200,00 → Frete grátis
  - Outros valores → R$20,00 de frete
- Verificação de CEP via API ViaCEP

---

## 🧱 Tecnologias utilizadas

- PHP Puro (sem frameworks)
- Banco de Dados: MySQL
- Frontend: Javascript + Bootstrap
- Padrão de Arquitetura: MVC

---

## 🔧 Como executar o projeto

1. Clone este repositório:
```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
```
2. Importe o banco de dados (arquivo `montink_erp_challenge.sql` incluso no repositório).
3. Configure a conexão com o banco no arquivo `config.php`.
4. Acesse `http://localhost/montinkChallenge/` no navegador.
