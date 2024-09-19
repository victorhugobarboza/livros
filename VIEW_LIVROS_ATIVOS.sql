CREATE OR REPLACE VIEW livros_ativos AS
SELECT 
    l.CodL AS livro_id,
    l.Titulo AS livro_titulo,
    l.Editora AS livro_editora,
    l.Edicao AS livro_edicao,
    l.AnoPublicacao AS livro_ano,
    l.valor AS livro_valor,
    a.Nome AS autor_nome,
    s.Descricao AS assunto_descricao,
    l.status AS livro_status
FROM 
    livros l
INNER JOIN 
    livro_autor la ON l.CodL = la.Livro_CodL
INNER JOIN 
    autores a ON la.Autor_CodAu = a.CodAu
INNER JOIN 
    livro_assunto ls ON l.CodL = ls.Livro_CodL
INNER JOIN 
    assuntos s ON ls.Assunto_codAs = s.codAs
WHERE 
    l.status = 1
GROUP BY 
    l.CodL, l.Titulo, l.Editora, l.Edicao, l.AnoPublicacao, l.valor, a.Nome, s.Descricao, l.status;