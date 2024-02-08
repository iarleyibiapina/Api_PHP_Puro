use teste;
use test;

create table tab_noticias (
    id_noticia_tbn INT PRIMARY KEY NOT NULL,
    nome_noticia_tbn VARCHAR(255),
    conteudo_noticia_tbn VARCHAR(255)
);

SELECT * FROM tab_noticias;

UPDATE tab_noticias SET  nome_noticia_tbn =  teste,  conteudo_noticia_tbn = teste  WHERE id_noticias_tbn = 29

