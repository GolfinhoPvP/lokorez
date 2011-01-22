SELECT FORMAT(sum(par.par_valor),2)  FROM averbacoes ave 
		INNER JOIN parcelas par 
			ON ave.ave_numero_externo = par.ave_numero_externo
	WHERE ave.ban_codigo = "002" AND par.sta_codigo = 1

SELECT distinct par.ave_numero_externo, sum(par.par_valor) FROM averbacoes ave 
		INNER JOIN parcelas par 
			ON ave.ave_numero_externo = par.ave_numero_externo
	WHERE ave.ban_codigo = "002" AND par.sta_codigo = 2
	GROUP BY par.ave_numero_externo

SELECT count(distinct ave_numero_externo ) FROM averbacoes WHERE ban_codigo = "002" AND sta_codigo = 3

SELECT pes.pes_nome, pes.pes_cpf, emp.emp_descricao, ave.ave_numero_externo FROM averbacoes ave
		INNER JOIN pessoas pes
			ON ave.pes_codigo = pes.pes_codigo
		INNER JOIN empresas emp
			ON ave.emp_codigo = emp.emp_codigo
	WHERE ave.ban_codigo = "002"SELECT pes.pes_nome, pes.pes_cpf, emp.emp_descricao, ave.ave_numero_externo FROM averbacoes ave
		INNER JOIN pessoas pes
			ON ave.pes_codigo = pes.pes_codigo
		INNER JOIN empresas emp
			ON ave.emp_codigo = emp.emp_codigo
	WHERE ave.ban_codigo = "002"

SELECT count(*) FROM parcelas par WHERE par.ave_numero_externo="aaaaaaaaaaa" AND par.sta_codigo=4

SELECT FORMAT(sum(par.par_valor),2) FROM parcelas par WHERE par.ave_numero_externo="aaaaaaaaaaa"  AND par.sta_codigo=4

SELECT pes.pes_nome, pes.pes_cpf, emp.emp_descricao, ave.ave_numero_externo  FROM averbacoes ave 
		INNER JOIN pessoas pes 
			ON ave.pes_codigo = pes.pes_codigo 
		INNER JOIN empresas emp 
			ON ave.emp_codigo = emp.emp_codigo 
	WHERE ave.ban_codigo = '002'