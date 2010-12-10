CREATE TABLE municipio (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table ano
-- -----------------------------------------------------
CREATE  TABLE ano (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table turno
-- -----------------------------------------------------
CREATE  TABLE turno (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table sexo
-- -----------------------------------------------------
CREATE  TABLE sexo (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table uf
-- -----------------------------------------------------
CREATE  TABLE uf (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table legenda
-- -----------------------------------------------------
CREATE  TABLE legenda (
  codigo VARCHAR(100) NOT NULL ,
  nome VARCHAR(100) NOT NULL ,
  composicao VARCHAR(200) NOT NULL ,
  uf_codigo VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) ,  
  CONSTRAINT fk_legenda_uf1
    FOREIGN KEY (uf_codigo )
    REFERENCES uf (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
GO

-- -----------------------------------------------------
-- Table partido
-- -----------------------------------------------------
CREATE  TABLE partido (
  codigo VARCHAR(100) NOT NULL ,
  sigla VARCHAR(100) NOT NULL ,  
  PRIMARY KEY (codigo),
)
GO

CREATE  TABLE partido_legenda (
  partido_codigo VARCHAR(100) NOT NULL ,
  legenda_codigo VARCHAR(100) NOT NULL ,
  PRIMARY KEY (partido_codigo, legenda_codigo) ,  
  CONSTRAINT fk_partido_partido_legenda
    FOREIGN KEY (partido_codigo )
    REFERENCES partido (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_legenda_partido_legenda
    FOREIGN KEY (legenda_codigo )
    REFERENCES legenda (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    )

-- -----------------------------------------------------
-- Table situacao
-- -----------------------------------------------------
CREATE  TABLE situacao (
  codigo VARCHAR(100) NOT NULL ,
  descricao VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) )
GO


-- -----------------------------------------------------
-- Table candidato
-- -----------------------------------------------------
CREATE  TABLE candidato (
  codigo VARCHAR(100) NOT NULL ,
  nome VARCHAR(200) NOT NULL ,
  nome_urna VARCHAR(50) NOT NULL ,
  sexo_codigo VARCHAR(100) NOT NULL ,
  partido_codigo VARCHAR(100) NOT NULL ,  
  situacao_codigo VARCHAR(100) NOT NULL ,
  PRIMARY KEY (codigo) ,  
  CONSTRAINT fk_candidato_sexo1
    FOREIGN KEY (sexo_codigo )
    REFERENCES sexo (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_candidato_partido1
    FOREIGN KEY (partido_codigo )
    REFERENCES partido (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_candidato_situacao1
    FOREIGN KEY (situacao_codigo )
    REFERENCES situacao (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
GO


-- -----------------------------------------------------
-- Table governador
-- -----------------------------------------------------
CREATE  TABLE governador (
  candidato_codigo VARCHAR(100) NOT NULL ,
  municipio_codigo VARCHAR(100) NOT NULL ,
  ano_codigo VARCHAR(100) NOT NULL ,
  turno_codigo VARCHAR(100) NOT NULL ,
  voto INT NOT NULL ,
  PRIMARY KEY (municipio_codigo, ano_codigo, turno_codigo, candidato_codigo) ,
  CONSTRAINT fk_governador_municipio1
    FOREIGN KEY (municipio_codigo )
    REFERENCES municipio (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_governador_ano1
    FOREIGN KEY (ano_codigo )
    REFERENCES ano (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_governador_turno1
    FOREIGN KEY (turno_codigo )
    REFERENCES turno (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_governador_candidato1
    FOREIGN KEY (candidato_codigo )
    REFERENCES candidato (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
GO


-- -----------------------------------------------------
-- Table zona
-- -----------------------------------------------------
CREATE  TABLE zona (
  numero VARCHAR(100) NOT NULL ,
  uf_codigo VARCHAR(100) NOT NULL ,
  PRIMARY KEY (numero) ,  
  CONSTRAINT fk_zona_uf
    FOREIGN KEY (uf_codigo )
    REFERENCES uf (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
GO


-- -----------------------------------------------------
-- Table zona_municipio
-- -----------------------------------------------------
CREATE  TABLE zona_municipio (
  zona_numero VARCHAR(100) NOT NULL ,
  municipio_codigo VARCHAR(100) NOT NULL ,
  PRIMARY KEY (zona_numero, municipio_codigo) ,  
  CONSTRAINT fk_zona_municipio_zona1
    FOREIGN KEY (zona_numero )
    REFERENCES zona (numero )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_zona_municipio_municipio1
    FOREIGN KEY (municipio_codigo )
    REFERENCES municipio (codigo )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    )