CREATE OR REPLACE VIEW relatorio_livros_por_assunto AS
SELECT
    s.Descricao AS assunto_descricao,
    l.Titulo AS livro_titulo,
    l.Editora AS livro_editora,
    l.Edicao AS livro_edicao,
    l.AnoPublicacao AS livro_ano,
    l.valor AS livro_valor,
    a.Nome AS autor_nome
FROM
    livros l
JOIN
    livro_assunto ls ON l.CodL = ls.Livro_CodL
JOIN
    assuntos s ON ls.Assunto_codAs = s.codAs
JOIN
    livro_autor la ON l.CodL = la.Livro_CodL
JOIN
    autores a ON la.Autor_CodAu = a.CodAu;