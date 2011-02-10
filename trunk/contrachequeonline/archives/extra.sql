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

ALTER TABLE br_estado_ac CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ac CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ac CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ac CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ac CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_al CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_al CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_al CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_al CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_al CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_am CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_am CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_am CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_am CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_am CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ap CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ap CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ap CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ap CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ap CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ba CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ba CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ba CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ba CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ba CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ce CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ce CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ce CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ce CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ce CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_df CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_df CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_df CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_df CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_df CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_es CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_es CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_es CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_es CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_es CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_go CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_go CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_go CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_go CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_go CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ma CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ma CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ma CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ma CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ma CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_mg CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mg CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mg CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mg CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_mg CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ms CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ms CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ms CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ms CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ms CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_mt CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mt CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mt CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_mt CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_mt CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_pa CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pa CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pa CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pa CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_pa CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_pb CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pb CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pb CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pb CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_pb CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_pe CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pe CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pe CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pe CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_pe CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_pi CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pi CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pi CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pi CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_pi CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_pr CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pr CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pr CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_pr CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_pr CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_rj CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rj CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rj CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rj CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_rj CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_rn CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rn CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rn CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rn CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_rn CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_ro CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ro CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ro CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_ro CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_ro CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_rr CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rr CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rr CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rr CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_rr CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_rs CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rs CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rs CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_rs CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_rs CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_sc CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sc CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sc CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sc CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_sc CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_se CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_se CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_se CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_se CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_se CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_sp CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sp CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sp CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_sp CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_sp CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

ALTER TABLE br_estado_to CHANGE cidade cidade VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_to CHANGE logradouro logradouro VARCHAR( 70 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_to CHANGE bairro bairro VARCHAR( 72 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;
ALTER TABLE br_estado_to CHANGE cep cep VARCHAR( 9 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL;
ALTER TABLE br_estado_to CHANGE tp_logradouro tp_logradouro VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL;

/* SELECT count(tip_descricao),  count(distinct tip_descricao)FROM tipo_logradouro; */

Create table cep (
	cep_codigo Serial NOT NULL AUTO_INCREMENT,
	est_codigo Bigint UNSIGNED NOT NULL,
	cid_codigo Bigint UNSIGNED NOT NULL,
	bai_codigo Bigint UNSIGNED NOT NULL,
	tip_codigo Bigint UNSIGNED NOT NULL,
	log_codigo Bigint UNSIGNED NOT NULL,
	cep_cep Varchar(9) NOT NULL) ENGINE = InnoDB;

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ac br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_al br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_am br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ap br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ba br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ce br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_df br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_es br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_go br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ma br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_mg br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_ms br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_mt br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_pa br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_pb br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);

INSERT INTO cep (est_codigo, cid_codigo, bai_codigo, tip_codigo, log_codigo, cep_cep)
		(SELECT cid.est_codigo, cid.cid_codigo, bai.bai_codigo, tip.tip_codigo, logr.log_codigo, br.cep FROM br_estado_pi br 
			INNER JOIN cidades cid
				ON br.cidade = cid.cid_nome
			INNER JOIN bairros bai
				ON br.bairro = bai.bai_nome
			INNER JOIN tipo_logradouro tip
				ON br.tp_logradouro = tip.tip_descricao
			INNER JOIN logradouros logr
				ON br.logradouro = logr.log_descricao);