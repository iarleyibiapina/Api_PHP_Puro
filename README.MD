Projeto feito com base [neste video](https://www.youtube.com/watch?v=GBE-H33xluE&lc=UgwPs05oxivbE6q4TTh4AaABAg&ab_channel=RafaelLeme)

> [!NOTE]
> O projeto pode ser configurado para ter uma url dinamica e mais proxima de um abiente de produção, ao invés do padrão `Localhost`. Porem decidi não implementar estas configurações e utilizar apenas a url 'amigavel' com htacces e com o fato de que a url exibida será a pasta do seu projeto.

> Para executar este projeto Utilizei como ferramentas o XAMPP, Um Gerenciador de banco de dados, Visual Studio e Postman.

<p>Utilizando VirtualHost por exemplo ficaria assim:</p>

- `api.sistema.com.br`

- `api.sistema.com.br/noticias`

### Configurando a url

<p> Para iniciar projeto foi configurado um host novo. Para localizar e adicionar é preciso usar este comando:</p>

`'windows + r'`

<p> pesquisar por: </p>

`C:\Windows\System32\drivers\etc`

<p>Abrir o arquivo 'hosts' no visual studio ou algum editor de texto.
No final do arquivo definir: </p>

`'127.0.0.1 api.sistema.com.br'`

<p> Depois é preciso configurar um virtual host no xampp
em: </p>

(O caminho varia dependendo de onde o xampp estiver instalado)

`'C:\xampp\apache\conf\extra'`

<p>Abrir o arquivo</p>

`'httpd-vhosts.conf'`

<p>Definindo um novo virtual host:</p>

```
<VirtualHost '\'\*:80>
ServerAdmin webmaster@api.sistema.com.br
DocumentRoot "C:\xampp\htdocs\PHP\Api_PHP_3"
ServerName api.sistema.com.br
ErrorLog "logs/api.sistema.com.br-error.log"
CustomLog "logs/api.sistema.com.br-access.log" common
</VirtualHost>
```

> Agora ao entrar e digitar o caminho do projeto em htdocs, por conta do .htaccess na raiz do projeto, será redirecionado para o index dentro da pasta public.

# Configurando o projeto (sem o uso do virtual host)

- Banco de dados

<p>Há um arquivo .sql na raiz do projeto, nele contem o sql para criar a tabela do projeto ou:</p>

<p> Crie um banco de dados MySQL ou utilize um existente. </p>

```
CREATE DATABASE teste;
```

```
USE teste;
```

```
CREATE TABLE tab_noticias (
id_noticia_tbn INT PRIMARY KEY NOT NULL,
nome_noticia_tbn VARCHAR(255),
conteudo_noticia_tbn VARCHAR(255)
);
```

- Configure a .env do projeto

Faça uma cópia do arquivo .env.example para .env e configure a conxeção com o banco:

```
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASS=
DB_DB  =[nome do seu banco]
```

O arquivo possui uma env BASE_URL, precisa ser configurado com base no caminho do seu projeto;

```
BASE_URL="localhost/.../public/"
```

<p> Para finalizar configurar o caminho do arquivo .env em

`/public/index.php`,

para que as variaveis definidas sejam carregadas no projeto. Meu Exemplo:

`Dotenv::createUnsafeImmutable("c:\\xampp\htdocs\PHP\Api_PHP_3"); `

</p>

## Testando a API

<p> Para testar utilize algum client, recomendo o POSTMAN </p>

Raiz do projeto é '{caminho_seu_projeto_htdocs}/public/';

<br>

GET - Pegando todas as noticias

```
/noticias
```

GET - Pegando uma noticia pelo ID

```
/noticias/1
```

> Chaves para os inputs em POST e PUT

- nome_noticia_tbn
- conteudo_noticia_tbn

POST - Fazendo envio de dados de uma noticia

```
/noticias/1
```

PUT - Atualizando dados de uma noticia

```
/noticias/1
```

DELETE - Deletando uma noticia

```
/noticias/1
```
