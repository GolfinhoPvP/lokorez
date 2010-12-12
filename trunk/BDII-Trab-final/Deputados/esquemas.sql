SELECT * FROM detalhe_munzona

SELECT * FROM vm_candidato

SELECT * FROM zona


INSERT INTO zona (zona_numero) (SELECT distinct [Coluna 10] FROM detalhe_munzona)
GO
INSERT INTO uf (uf_sigla) (SELECT distinct [Coluna 7] FROM detalhe_munzona)
GO
INSERT INTO coligacao (colig_codigo, colig_descricao, uf_sigla) (SELECT distinct [Coluna 27],[Coluna 28],[Coluna 7] FROM vm_candidato)
GO