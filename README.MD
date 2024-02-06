```
GET 'sistema/noticias' - Pegando todas as noticias
```

```
GET 'sistemas/noticias/1' - Pegando uma noticia pelo ID
```

```
POST 'sitemas/noticias/1' - Fazendo envio de dados de uma noticia
```

```
PUT 'sistemas/noticias/1' - Atualizando dados de uma noticia
```

```
DELETE 'sistemas/noticias/1' - Deletando uma noticia
```

Para iniciar projeto foi configurado um host novo. Para localizar e adicionar é preciso usar este comando:
'windows + r'

pesquisar por:
C:\Windows\System32\drivers\etc

e abrir o arquivo 'hosts' no visual studio mesmo
ao final do arquivo foi definido
'127.0.0.1 api.sistema.com.br'

depois é preciso configurar um virtual host no xampp
em:
(O caminho varia de onde o xampp estiver instalado)
'C:\xampp\apache\conf\extra'
e abrir o arquivo 'httpd-vhosts.conf'
definindo um novo virtual host:
<'VirtualHost '\'\*:80>
ServerAdmin webmaster@api.sistema.com.br
DocumentRoot "C:\xampp\htdocs\PHP\Api_PHP_3"
ServerName api.sistema.com.br
ErrorLog "logs/api.sistema.com.br-error.log"
CustomLog "logs/api.sistema.com.br-access.log" common
<'/VirtualHost>

Agora ao entrar digitar o caminho do projeto em htdocs, por conta do .htaccess na raiz do projeto, será redirecionado para o index dentro da pasta public.

Definir conexao como banco em
Src/Core/Model.php
