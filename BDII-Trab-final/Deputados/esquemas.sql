/*
SELECT * FROM detalhe_munzona

SELECT * FROM detalhe_mun

SELECT * FROM vmz_candidato

SELECT * FROM vm_partido

SELECT * FROM uf
*/

use [DW-Deputados]

INSERT INTO zona (zona_numero) (SELECT distinct [Coluna 10] FROM vmz_candidato)
GO
INSERT INTO uf (uf_sigla, zona_numero) (SELECT distinct [Coluna 7], [Coluna 10] FROM vmz_candidato)
GO
INSERT INTO coligacao (colig_codigo, uf_sigla, zona_numero, colig_descricao) (SELECT distinct [Coluna 28], [Coluna 7], [Coluna 10], [Coluna 29] FROM vmz_candidato)
GO
INSERT INTO partido (part_codigo, colig_codigo, uf_sigla, zona_numero, part_sigla) (SELECT distinct [Coluna 26], [Coluna 28], [Coluna 7], [Coluna 10], [Coluna 27] FROM vmz_candidato)
GO
INSERT INTO cargo (cargo_codigo, cargo_descricao) (SELECT distinct [Coluna 11], [Coluna 12] FROM vmz_candidato)
GO
INSERT INTO situacao (situ_codigo, situ_descricao) (SELECT distinct [Coluna 20], [Coluna 21] FROM vmz_candidato)
GO
INSERT INTO sexo (sexo_codigo, sexo_descricao) (SELECT distinct [Coluna 24], [Coluna 25] FROM vmz_candidato)
GO
INSERT INTO candidato (cand_nome_urna, cand_numero, sexo_codigo, situ_codigo, part_codigo, cargo_codigo, colig_codigo, cand_nome, uf_sigla, zona_numero) (SELECT distinct [Coluna 14], [Coluna 13], [Coluna 24], [Coluna 20], [Coluna 26], [Coluna 11], [Coluna 28], [Coluna 15], [Coluna 7], [Coluna 10] FROM vmz_candidato)
GO
INSERT INTO ano (ano_codigo, ano_data) (SELECT distinct [Coluna 5], [Coluna 4] FROM vmz_candidato)
GO
INSERT INTO municipio (mun_codigo, uf_sigla, zona_numero, mun_descricao) (SELECT distinct [Coluna 8], [Coluna 7], [Coluna 10], [Coluna 9] FROM vmz_candidato)
GO
INSERT INTO votos (mun_codigo, cand_nome_urna, cand_numero, part_codigo, colig_codigo, uf_sigla, zona_numero, ano_codigo, votos) (SELECT distinct [Coluna 8], [Coluna 14], [Coluna 13], [Coluna 26], [Coluna 28], [Coluna 7], [Coluna 10], [Coluna 5], [Coluna 34] FROM vmz_candidato)
GO