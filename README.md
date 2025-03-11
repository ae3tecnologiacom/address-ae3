## Ae3 Address

Esta lib padroniza as consultas de endereço para ser utilizada em diferentes projetos

### Requisitos

- PHP >= 8.1
- Laravel >= 10.*
- Composer >= v2

### Como configurar o projeto?

1) Adicione este repositório à lista de repositórios do composer em seu projeto laravel.

```json
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/ae3tecnologiacom/address-ae3"
    }
  ]
}

```

3) altere no composer json o minimum-stability para ficar dessa forma

```json
{
  "minimum-stability": "dev"
}

```

3) Execute o comando a seguir para baixar esta lib ao vendor do seu projeto.

```
composer require address/address-api
```

4) Configure as variáveis abaixo no .env do seu projeto.

```
ADDRESS_SERVER_URL=http:"url do servico"
ADDRESS_GRANT_TYPE="tipo da credencial"
ADDRESS_CLIENT_ID="id do cliente"
ADDRESS_CLIENT_SECRET="secret do cliente"
```

5) Execute o comando abaixo para criar a tabela de usuários e a tabela de senhas.

```
php artisan address:publish
```

6) Execute o comando abaixo para criar a tabela de address.

```
php artisan migrate
```

### Rotas

As rotas são versionadas sob o prefixo /api/v1 e exigem o middleware client.

##### Listagem de Países

`GET`
```
api/v1/address/countries
```
Método: `listCountries()`
<hr>

##### Listagem de todos Estados

`GET` 
```
api/v1/address/states
```
Método: `listStates()`
<hr>

##### Listagem de Cidades

`GET` 
```
api/v1/address/cities
```
Método: `listCities()`
<hr>

##### Listagem de Bairros

`GET`
```
api/v1/address/neighborhoods
```
Método: `listNeighborhoods()`
<hr>

##### Listagem de Estados por País

`GET`
```
api/v1/address/countries/{country_id}/states
```
Método: `listStatesByCountry($country_id)`
<hr>

##### Listagem de Cidades por Estado

`GET` 
```
api/v1/address/states/{uf}/cities
```
Método: `ListCitiesByStates($uf)`
<hr>

##### Listagem de Bairros por Cidade
`GET`
```
api/v1/address/neighborhoods/{city_id}
```
Método: `listNeighborhoodsByCity($city_id)`
<hr>

##### Busca de Endereço por CEP, Rua ou Bairro
`GET`
```
api/v1/address/zipcodes/addresses
```
Método: `searchAddress($data)`

**Body esperado para buscar endereço por cep:**
```json
{
  "q": "01001-000",
  "scope": "zipcode"
}
```

**Body esperado para buscar endereço por rua:**
```json
{
  "q": "rua sanhaçu",
  "scope": "street"
}
```
**Body esperado para buscar endereço por bairro:**
```json
{
  "q": "mecejana",
  "scope": "neighborhood"
}
```
<hr>

