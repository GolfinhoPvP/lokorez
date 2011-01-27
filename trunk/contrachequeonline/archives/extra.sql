Create table estados (
	est_codigo Serial NOT NULL AUTO_INCREMENT,
	est_sigla Char(2) NOT NULL,
	est_nome Varchar(30) NOT NULL) ENGINE = InnoDB;

INSERT INTO estados (est_sigla, est_nome) (SELECT distinct uf, nome FROM tb_estados ORDER BY uf);

/* SELECT count(cid_nome),  count(distinct cid_nome)FROM cidades; */

Create table cidades (
	cid_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	cid_nome Varchar(150) NOT NULL) ENGINE = InnoDB;

Create table cidades2 (
	cid_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	cid_nome Varchar(150) NOT NULL) ENGINE = InnoDB;

INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ac LEFT JOIN estados ON est_codigo = 1);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_al LEFT JOIN estados ON est_codigo = 2);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_am LEFT JOIN estados ON est_codigo = 3);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ap LEFT JOIN estados ON est_codigo = 4);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ba LEFT JOIN estados ON est_codigo = 5);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ce LEFT JOIN estados ON est_codigo = 6);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_df LEFT JOIN estados ON est_codigo = 7);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_es LEFT JOIN estados ON est_codigo = 8);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_go LEFT JOIN estados ON est_codigo = 9);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ma LEFT JOIN estados ON est_codigo = 10);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_mg LEFT JOIN estados ON est_codigo = 11);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ms LEFT JOIN estados ON est_codigo = 12);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_mt LEFT JOIN estados ON est_codigo = 13);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_pa LEFT JOIN estados ON est_codigo = 14);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_pb LEFT JOIN estados ON est_codigo = 15);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_pe LEFT JOIN estados ON est_codigo = 16);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_pi LEFT JOIN estados ON est_codigo = 17);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_pr LEFT JOIN estados ON est_codigo = 18);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_rj LEFT JOIN estados ON est_codigo = 19);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_rn LEFT JOIN estados ON est_codigo = 20);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_ro LEFT JOIN estados ON est_codigo = 21);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_rr LEFT JOIN estados ON est_codigo = 22);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_rs LEFT JOIN estados ON est_codigo = 23);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_sc LEFT JOIN estados ON est_codigo = 24);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_se LEFT JOIN estados ON est_codigo = 25);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_sp LEFT JOIN estados ON est_codigo = 26);
INSERT INTO cidades2 (est_codigo, cid_nome) (SELECT distinct est_codigo, cidade FROM br_estado_to LEFT JOIN estados ON est_codigo = 27);

/* SELECT count(cid_nome),  count(distinct cid_nome)FROM cidades2; */
INSERT INTO cidades (est_codigo, cid_nome) (SELECT distinct est_codigo, cid_nome FROM cidades2);
DROP TABLE cidades2;
/* SELECT count(cid_nome),  count(distinct cid_nome)FROM cidades; */

Create table logradouros (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	log_descricao Varchar(100) NOT NULL ) ENGINE = InnoDB;
br_estado_rr
Create table logradouros2 (
	log_codigo Serial NOT NULL AUTO_INCREMENT,
	log_descricao Varchar(100) NOT NULL ) ENGINE = InnoDB;

INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ac);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_al);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_am);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ap);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ba);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ce);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_df);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_es);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_go);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ma);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_mg);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ms);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_mt);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_pa);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_pb);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_pe);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_pi);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_pr);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_rj);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_rn);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_ro);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_rr);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_rs);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_sc);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_se);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_sp);
INSERT INTO logradouros2 (log_descricao) (SELECT distinct logradouro FROM br_estado_to);

/* SELECT count(log_descricao),  count(distinct log_descricao)FROM logradouros2; */
INSERT INTO logradouros (log_descricao) (SELECT distinct log_descricao FROM logradouros2);
DROP TABLE logradouros2;
/* SELECT count(log_descricao),  count(distinct log_descricao)FROM logradouros; */

Create table bairros (
	bai_codigo Serial NOT NULL AUTO_INCREMENT,
	bai_nome Varchar(100) NOT NULL) ENGINE = InnoDB;

Create table bairros2 (
	bai_codigo Serial NOT NULL AUTO_INCREMENT,
	bai_nome Varchar(100) NOT NULL) ENGINE = InnoDB;

INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ac);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_al);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_am);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ap);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ba);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ce);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_df);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_es);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_go);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ma);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_mg);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ms);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_mt);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_pa);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_pb);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_pe);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_pi);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_pr);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_rj);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_rn);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_ro);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_rr);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_rs);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_sc);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_se);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_sp);
INSERT INTO bairros2 (bai_nome) (SELECT distinct bairro FROM br_estado_to);

/* SELECT count(bai_nome),  count(distinct bai_nome)FROM bairros2; */
INSERT INTO bairros (bai_nome) (SELECT distinct bai_nome FROM bairros2);
DROP TABLE bairros2;
/* SELECT count(bai_nome),  count(distinct bai_nome)FROM bairros; */

Create table tipo_logradouro (
	tip_codigo Serial NOT NULL AUTO_INCREMENT,
	tip_descricao Varbinary(100) NOT NULL) ENGINE = InnoDB;

Create table tipo_logradouro2 (
	tip_codigo Serial NOT NULL AUTO_INCREMENT,
	tip_descricao Varbinary(100) NOT NULL) ENGINE = InnoDB;

INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ac);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_al);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_am);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ap);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ba);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ce);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_df);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_es);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_go);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ma);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_mg);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ms);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_mt);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_pa);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_pb);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_pe);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_pi);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_pr);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_rj);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_rn);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_ro);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_rr);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_rs);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_sc);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_se);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_sp);
INSERT INTO tipo_logradouro2 (tip_descricao) (SELECT distinct tp_logradouro FROM br_estado_to);

/* SELECT count(tip_descricao),  count(distinct tip_descricao)FROM tipo_logradouro2; */
INSERT INTO tipo_logradouro (tip_descricao) (SELECT distinct tip_descricao FROM tipo_logradouro2);
DROP TABLE tipo_logradouro2;
/* SELECT count(tip_descricao),  count(distinct tip_descricao)FROM tipo_logradouro; */