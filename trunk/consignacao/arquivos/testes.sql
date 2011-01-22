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

SELECT pes.pes_nome, pes.pes_cpf, ser.ser_matricula, emp.emp_descricao, ave.ave_numero_externo, ave.ave_data_criacao, ave.ave_numero_parcelas, ave.ave_montante, ave.ave_taxa_juros, par.par_numero_parcela, par.par_periodo_parcela, par.par_valor, sta.sta_descricao FROM averbacoes ave
		INNER JOIN servidores ser
			ON ave.pes_codigo=ser.pes_codigo
		INNER JOIN pessoas pes
			ON ave.pes_codigo=pes.pes_codigo
		INNER JOIN empresas emp
			ON ave.emp_codigo=emp.emp_codigo
		INNER JOIN parcelas par
			ON ave.ave_numero_externo=par.ave_numero_externo
		INNER JOIN status sta
			ON par.sta_codigo=sta.sta_codigo
	WHERE ave.ban_codigo="003"
	ORDER BY pes.pes_nome, par.par_numero_parcela