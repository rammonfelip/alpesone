
## 1. Instruções

Clone o projeto

```bash
  git clone https://github.com/rammonfelip/alpesone
```

Entre no diretório do projeto

```bash
  cd alpesone
```

Crie um arquivo .env a partir do arquivo .env.example

```bash
  cp .env.example .env
```

Execute os seguintes comandos para construir o ambiente

```bash
composer install
php artisan key:generate
php artisan migrate
```

Isso irá instalar as dependências, gerar a chave da aplicação e executar as migrações no banco de dados.

Para iniciar o servidor

```bash
  php artisan serve --port=8080
```
Ou outra porta se preferir

## 2. Executar o Comando de Importação

```bash
  php artisan veiculos:update
```

## 3. Rodando os Testes
```bash
  php artisan test
```

## 4. Postman Collection
Se você deseja rodar testes da API com o Postman, você pode importar a collection de testes fornecida. Siga as instruções abaixo:

- Localize a collection salva na raiz do projeto alpesone_postman.json
- Abra o Postman e clique em Import.
- Selecione o arquivo JSON da collection e importe.

Após importar, você poderá rodar as rotas de API diretamente no Postman.

## 5. Hospedagem
   O projeto está configurado para rodar em um servidor NGINX hospedado em uma instância EC2 na AWS.

Endereço DNS da aplicação:
http://ec2-18-229-162-154.sa-east-1.compute.amazonaws.com/api/v1
