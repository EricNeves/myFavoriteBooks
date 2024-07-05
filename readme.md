<h4 align="center">
  <br />
  <img src="resources/screenshots/icon.png">
  <br />
    My Favorite Books
  <br />
</h4>

<p align="center">Aplicação desenvolvida com <strong>PHP</strong> puro, baseado nos princípios <strong>SOLID</strong> e na arquitetura <strong>package-by-feature</strong>, garantindo maior legibilidade e organização do código, bem como a implementação de <strong>testes automatizados</strong>.</p>

<p align="center">Data de criação: Jun 9, 2024</p>

<p align="center">
  <img src="https://img.shields.io/github/last-commit/ericneves/solidprinciples?display_timestamp=author&style=flat-square&logo=github&color=%2303AED2" alt="Github">
  <img src="https://img.shields.io/github/languages/count/ericneves/solidprinciples?style=flat-square&logo=progress&color=%2341B06E">
  <img src="https://img.shields.io/github/languages/top/ericneves/solidprinciples?style=flat-square&logo=typescript&logoColor=%23FFBB70&color=%23FFBB70">
  <img src="https://img.shields.io/github/license/ericneves/solidprinciples?style=flat-square&logo=git&color=%23F05032">
</p>

<img src="resources/screenshots/screenshot.png">

#### Intro 📜

É sempre um desafio desenvolver um app com funcionalidades de um determinado framework, seja a utilização de rotas, middlewares dinâmicos, banco de dados e etc. Partindo desse principio, este projeto tem como foco o desenvolvido de um app baseado na arquitetura package-by-feature e princípios SOLID com PHP puro.

A arquitetura package-by-feature jutamente com os principais princípios SOLID, facilitam o desenvolvimento, manutenção e escalabiliade de um app, uma vez que o sistema é separado por funcionalidades e casos de uso.

#### Features 💡

- 📁 Padrão Package By Feature
  - 🙍 User
    - Criar usuário
    - Autenticação - JWT
    - Informações do Usuário
    - Editar Usuário
  - 📚 Book
    - Criar livro
    - Editar livro
    - Informações de um livro
    - Todos os livros
    - Remover um livro
- ⚡ Dependencies:
  - phpunit/phpunit: `^10.5`
  - vlucas/phpdotenv: `^5.6`
  - @angular/cli: `^17.3.8`
  - primeng: `^17.18.1`,
  - and more...

#### Doc 📑

##### Routes 

>
> [!NOTE]
> Para adicionar uma nova **rota**, deve-se levar em consideração os `Use Cases`, `Controllers` e as `Factories`. 
>

```
|-- routes
|   |-- api.php
|-- config
|   |-- factories.php
|-- UseCases
|   |-- Intro
|   |   |-- WelcomeMessage
|   |   |   |-- WelcomeMessageController.php
|   |   |   |-- WelcomeMessageFactory.php
|   |   |   |-- IWelcomeMessageUseCase.php
|   |   |   |-- WelcomeMessageUseCase.php
```

Em `routes/api.php` referencie o `controller` através do `namespace`, pórem, deve-se remover o `App\UseCases\` matendo apenas o restante, nesse caso, `Intro\WelcomeMessage\WelcomeMessageController`.

```php 

<?php 

use App\Http\Router;

Route::get('/', 'Intro\WelcomeMessage\WelcomeMessageController');

```

Agora, em `config/factories.php`, associe o **controller** passado na **rota** com a `Factory` do `Use Case`.

>
> [!NOTE]
> A `factory` é responsável por criar as **instâncias** e injetar as **depedências**.
>

```php 

return [
  'Intro\WelcomeMessage\WelcomeMessageController' => App\Intro\WelcomeMessage\WelcomeMessageFactory.php
];

```

##### Use Cases

De modo geral, será exemplificado a criação de um Use Case incluindo recursos como Banco de Dados.

```
|-- Providers
|   |-- IUserPostgresProvider.php
|   |-- Implementation
|   |   |-- UserPostgresProvider.php
|-- Repositories
|   |-- UserRepository.php
|-- UseCases
|   |-- User
|   |   |-- FetchUser
|   |   |   |-- FetchUserController.php
|   |   |   |-- FetchUserFactory.php
|   |   |   |-- IFetchUserUseCase.php
|   |   |   |-- FetchUserUseCase.php
```
`IUserPostgresProvider`

```php 
<?php 

namespace App\Providers;

interface IUserPostgresProvider
{
  public function fetch(int $id): array;
}

```

`UserPostgresProvider`

```php 

<?php

namespace App\Providers\Implementations;

use App\Providers\IUserPostgresProvider;
use PDO;

class UserPostgresProvider implements IUserPostgresProvider
{
    public function __construct(private PDO $pdo)
    {
    }

    public function fetch(int $id): array 
    {
      return $this->pdo->query("...");
    }
}

```

`IFetchUserUseCase`

```php 

<?php

namespace App\UseCases\User\FetchUser;

interface IFetchUserUseCase
{
    public function execute(int | string $userId): array;
}


```

`Controller`

> [!NOTE]
> No **construtor** do `controller` é passado como **Inversão de Depedência** a **interface** `IFetchUserUseCase`.

```php

<?php

namespace App\UseCases\User\FetchUser;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\User\FetchUser\IFetchUserUseCase;

class FetchUserController
{
    public function __construct(private IFetchUserUseCase $fetchUserUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        return $response->json([
            "data" => $this->fetchUserUseCase->execute($request->user()->id),
        ]);
    }
}


```

##### Middlewares

#### Execution ⚙️

>
> [!NOTE]
> Siga os passos abaixo para a execução do projeto.

O primeiro passo, é nomear o arquivo `.env.example` para `.env`.

```sh 

# Install Deps
$ cd app && pnpm install

# Docker
$ docker-compose -f "docker-compose-dev.yml" up -d --build

# Tests
$ pnpm test
$ pnpm test:coverage

```

#### Alive 🔋

Após o processo de instalação o serviço estará disponível na porta `3030`. 
Acessando o endpoint `127.0.0.1:3030/doc`, terá a documentação para o uso da `api`.

Em produção, o projeto está hospedado no serviço gratuito da empresa [Render](https://render.com/), rodando todo o app em `docker`.

>
> [!NOTE]
> Por ser um serviço gratuito, leva alguns segundos ou minutos para abrir a conexão, após isso, poderá usar o serviço normalmente.
> 

Link: ([SOLID Principles API](https://solidprinciples-api.onrender.com))

#### Author 🦆

<table>
  <tr>
    <td align="center">
      <a href="https://www.instagram.com/ericneves_dev/">
        <img src="https://avatars.githubusercontent.com/u/32256029" width="100px;" alt=""/>
        <br />
        <sub>
          <b>Eric Neves</b>
        </sub>
      </a>
    </td>
  </tr>
  <tr>
    <td>
      <a href="https://www.instagram.com/ericneves_dev/">
        <img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white" width="100%">
      </a> 
      <br />
      <a href="https://linkedin.com/in/ericnevesrr"> 
        <img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white" width="100%">
      </a>
    </td>
  </tr>
</table>

#### License 📋

<img src="https://img.shields.io/github/license/ericneves/solidprinciples?style=flat-square&logo=git&color=%23F05032">
