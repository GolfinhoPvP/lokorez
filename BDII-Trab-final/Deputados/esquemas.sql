/*
SELECT * FROM vmz_candidato

SELECT * FROM detalhe_munzona

SELECT * FROM partido

DELETE FROM votos where cand_nome_urna = 'ABELARDO JUREMA'
DELETE FROM votos where cand_nome_urna = 'ALEXANDRE O GRANDE'
DELETE FROM votos where cand_nome_urna = 'ALOISIO ERNESTO'
DELETE FROM votos where cand_nome_urna = 'AMPARO LANDIM'

SELECT * FROM votos where cand_nome_urna = 'AMPARO LANDIM'
*/

use [DW-Deputados]
GO
DELETE FROM[votos] 
GO
DELETE FROM [ano] 
GO
DELETE FROM [municipio] 
GO
DELETE FROM [candidato] 
GO
DELETE FROM [situacao] 
GO
DELETE FROM [sexo] 
GO
DELETE FROM [partido] 
GO
DELETE FROM [cargo] 
GO
DELETE FROM [coligacao] 
GO
DELETE FROM[uf] 
GO
DELETE FROM [uf2] 
GO
DELETE FROM [zona] 
GO
INSERT INTO zona (zona_numero) (SELECT distinct [Coluna 10] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO uf (uf_sigla) (SELECT distinct [Coluna 7] FROM vmz_candidato  WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO uf2 (uf2_sigla, zona_numero) (SELECT distinct [Coluna 7], [Coluna 10] FROM vmz_candidato  WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO cargo (cargo_codigo, cargo_descricao) (SELECT distinct [Coluna 11], [Coluna 12] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO situacao (situ_codigo, situ_descricao) (SELECT distinct [Coluna 20], [Coluna 21] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO sexo (sexo_codigo, sexo_descricao) (SELECT distinct [Coluna 24], [Coluna 25] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO ano (ano_codigo, ano_data) (SELECT distinct [Coluna 5], [Coluna 4] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO municipio (mun_codigo, uf_sigla, mun_descricao) (SELECT distinct [Coluna 8], [Coluna 7], [Coluna 9] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO coligacao (colig_codigo, uf_sigla, colig_descricao) (SELECT distinct [Coluna 28], [Coluna 7], [Coluna 29] FROM vmz_candidato  WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO partido (part_codigo, colig_codigo, uf_sigla, part_sigla) (SELECT distinct [Coluna 26], [Coluna 28], [Coluna 7], [Coluna 27] FROM vmz_candidato  WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO candidato (cand_nome_urna, cand_numero, sexo_codigo, situ_codigo, part_codigo, cargo_codigo, cand_nome, uf_sigla, colig_codigo) (SELECT distinct [Coluna 14], [Coluna 13], [Coluna 24], [Coluna 20], [Coluna 26], [Coluna 11], [Coluna 15], [Coluna 7], [Coluna 28] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO
INSERT INTO votos (mun_codigo, cand_nome_urna, cand_numero, uf2_sigla, zona_numero, ano_codigo, votos) (SELECT distinct [Coluna 8], [Coluna 14], [Coluna 13], [Coluna 7], [Coluna 10], [Coluna 5], [Coluna 34] FROM vmz_candidato WHERE [Coluna 11] BETWEEN 6 AND 7)
GO

INSERT INTO cargo VALUES 
	(10, 'Votos Brancos'), 
	(11, 'Votos Nulos'), 
	(12, 'Votos de Legenda'), 
	(13, 'Votos Anulados')
	GO
INSERT INTO situacao VALUES 
	(10, 'NAO DEVE SER ANALISADA')
GO
INSERT INTO sexo VALUES 
	(20, 'NAO DEVE SER ANALISADA')
GO
INSERT INTO uf VALUES 
	('XX')
GO
INSERT INTO coligacao VALUES 
	('NAO DEVE SER ANALISADA', 'XX', 'NAO DEVE SER ANALISADA')
GO
INSERT INTO partido VALUES 
	(171, 'NAO DEVE SER ANALISADA', 'XX', 'XX')
GO
INSERT INTO candidato VALUES
	('Votos Brancos', 000, 171, 20, 10, 10, 'NAO DEVE SER ANALISADA', 'XX', 'Votos Brancos'),
	('Votos Nulos', 001, 171, 20, 10, 11, 'NAO DEVE SER ANALISADA', 'XX', 'Votos Nulos'),
	('Votos de Legenda', 002, 171, 20, 10, 12, 'NAO DEVE SER ANALISADA', 'XX', 'Votos de Legenda'),
	('Votos Anulados', 003, 171, 20, 10, 13, 'NAO DEVE SER ANALISADA', 'XX', 'Votos Anulados')
GO
/*
TRUNCATE TABLE [vmz_candidato]
GO
TRUNCATE TABLE [votos] 
GO
TRUNCATE TABLE [ano] s
GO
TRUNCATE TABLE [municipio] 
GO
TRUNCATE TABLE [candidato] 
GO
TRUNCATE TABLE [situacao] 
GO
TRUNCATE TABLE [sexo] 
GO
TRUNCATE TABLE [partido] 
GO
TRUNCATE TABLE [cargo] 
GO
TRUNCATE TABLE [coligacao] 
GO
TRUNCATE TABLE [uf] 
GO
TRUNCATE TABLE [zona] 
GO
*/