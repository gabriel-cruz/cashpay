# Safecash

Safecash é uma API responsável por realizar transações monetárias entre os usuários.

### Arquitetura e stack
Detalhes da stack:
- A implementação é feita em *PHP* na versão 7.4
- Uso do framework *Laravel 8* 
- Persistência de dados é feita em um banco *MySQL*, acesse o [modelo de dados](https://drive.google.com/file/d/1JYqI-0nPYiIk9HYrZV2uGybam6BEkTqd/view?usp=sharing) para uma versão resumida do modelo.

A API está organizada de acordo com o *Design Pattern* [*Repository Pattern*](https://renicius-pagotto.medium.com/entendendo-o-repository-pattern-fcdd0c36b63b), seguindo o modelo, a solução foi dividida em 4 subcamadas, que são: 
- ***Models***: Responsável pela criação das entidades da aplicação;
- ***Repositories***: É a camada onde está toda a comunicação com o banco de dados: *selects, inserts, updates e deletes*;
- ***Services***: Onde é realizada toda a manipulação das regras de negócio do sistema;
- ***Controllers***: Responsável pela comunicação direta com as rotas, sendo, basicamente os *endpoints* da aplicação;

### Execução do código
Faça o clone do [projeto](https://github.com/gabriel-cruz/cashbank.git).
No terminal, para carregar todas as dependências do projeto, execute o comando:
```sh
composer install
```
Em seguida, execute as migrations e os seeds:
```sh
php artisan migrate
php artisan db:seed
```

### A solução

De acordo com o design proposto para a solução, de início foram criadas as entidades, as *models*:
- ***User***: Usado para manipular as funções de usuário;
- ***Wallet***: A carteira do usuário, onde é armazenado o valor que ele tem na plataforma.
- ***Transaction***: Entidade responsável por manipular as transações feitas pelos usuários.

Partindo para a próxima camada, os *repositories*, as classes foram modeladas para seguirem os princípios do SOLID, principalmente o **Princípio da Responsabilidade Única**, as classes são:

- ***UserRepository***: Classe responsável para realizar a comunicação com a tabela *users* e coletar informações do usuário.
- ***WalletRepository***: Utiizado para fazer operações referentes a carteira (*wallets*) do usuário, que são: coletar o valor atual da carteira (getAmount) e fazer depósitos e retiradas de valores (*deposit* e *subtract*).
- ***TransactionRepository***: Tem como objetivo salvar as transações realizadas pelo usuário, acionando a carteira para fazer o depósito e a retirada do valor referente à transação.

A camada *services*, segue o mesmo princípio dos *repositories* e mais uma regra: uma classe *service* só conhece apenas o seu *repository* referente, ou seja, a classe *UserService* só conhece um único *repository*, que é o *UserRepository*. Nessa parte da aplicação, cada entidade tem o seu serviço específico. 
Além dos serviços referente a cada repositório, há também as classes que se comunicam com *mocks* externos para fazer validações, são elas: *AuthorizeService*, que é responsável por fazer a comunicação com um serviço para verificar se a transação foi autorizada. E a *NotificationService*, para validar se uma notificação foi enviada para o usuário após a transação ser realizada.

No *controller* há única classe, a *TransactionController*, que foi utilizada para criar o endpoint da API, ela recebe as informações por meio de uma request e onde é realizada todas as chamadas de métodos dos *services* para que a transação seja realizada, além de tratar todas as exceções que podem ocasionar na execução.

## Execução
Primeiro, é necessario ativar o servidor da aplicação, para isso utilize o comando no terminal:
```sh
php artisan serve
```
Com o servidor ativo é necessário utilizar um serviço que possa realizar requisições HTTP, como o [*postman*](https://www.postman.com/).
Faça uma requisição do tipo *POST* para a url /transaction com o payload no formato:
```json
{
    "value": 100.0,
    "sender": 4,
    "receiver": 15
}
```

Caso a transação seja realizada com sucesso, a saída será:
[imagem da saída]

## Testes e validação
Os testes foram escritos utilizando a biblioteca *PHPUnit*. Para rodar os testes da aplicação é necessário executar, na pasta raiz do projeto, o comando:
```sh
./vendor/bin/phpunit
```
