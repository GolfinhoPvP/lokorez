SELECT * FROM detalhe_munzona

SELECT * FROM detalhe_mun

SELECT * FROM vmz_candidato

SELECT * FROM vm_partido

SELECT * FROM candidato

use [DW-Deputados]

INSERT INTO zona (zona_numero) (SELECT distinct [Coluna 10] FROM vmz_candidato)
GO
INSERT INTO uf (uf_sigla, zona_numero) (SELECT distinct [Coluna 7], [Coluna 10] FROM vmz_candidato)
GO
INSERT INTO coligacao (colig_codigo, uf_sigla, zona_numero, colig_descricao) (SELECT distinct [Coluna 28], [Coluna 7], [Coluna 10], [Coluna 29] FROM vmz_candidato)
GO
INSERT INTO partido (part_codigo, colig_codigo, uf_sigla, part_sigla) (SELECT distinct [Coluna 12], [Coluna 14], [Coluna 7], [Coluna 13] FROM vmz_partido)
GO
INSERT INTO cargo (cargo_codigo, cargo_descricao) (SELECT distinct [Coluna 10], [Coluna 11] FROM vmz_candidato)
GO
INSERT INTO situacao (situ_codigo, situ_descricao) (SELECT distinct [Coluna 19], [Coluna 20] FROM vmz_candidato)
GO
INSERT INTO sexo (sexo_codigo, sexo_descricao) (SELECT distinct [Coluna 23], [Coluna 24] FROM vmz_candidato)
GO
INSERT INTO candidato (cand_nome_urna, cand_numero, sexo_codigo, situ_codigo, part_codigo, cargo_codigo, colig_codigo, cand_nome) (SELECT distinct [Coluna 13], [Coluna 12], [Coluna 23], [Coluna 19], [Coluna 25], [Coluna 10], [Coluna 27], [Coluna 14] FROM vmz_candidato)
GO
INSERT INTO ano (ano_codigo, ano_data) (SELECT distinct [Coluna 5], [Coluna 4] FROM vmz_candidato)
GO
INSERT INTO municipio (mun_codigo, uf_sigla, mun_descricao) (SELECT distinct [Coluna 8], [Coluna 7], [Coluna 9] FROM detalhe_mun)
GO
INSERT INTO votos (mun_codigo, ano_codigo, cand_nome_urna, cand_numero, votos) ()