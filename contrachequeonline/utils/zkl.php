<?php
	/**
	 * Cifra/decifra strings utilizando o algoritmo de fluxo RC4.
	 *
	 * @param string $key Chave
	 * @param string $data Dados puros/cifrados
	 * @see   http://pt.wikipedia.org/wiki/RC4
	 * @author Rafael M. Salvioni
	 * @return string
	 */
		 
	ini_set('memory_limit','32M');
	
	function zkl($key, $data){
		// Armazena os vetores "S" jс calculados
		static $SC;
		// Funчуo de troca dos valores do Vetor "S"
		$swap = create_function('&$v1, &$v2', '
			$v1 = $v1 ^ $v2;
			$v2 = $v1 ^ $v2;
			$v1 = $v1 ^ $v2;
		');
		$ikey = crc32($key);
		if (!isset($SC[$ikey])) {
			// Cria o vetor de permutaчуo "S", baseado na chave
			$S    = range(0, 255);
			$j    = 0;
			$n    = strlen($key);
			for ($i = 0; $i < 255; $i++) {
				$char  = ord($key{$i % $n});
				$j     = ($j + $S[$i] + $char) % 256;
				$swap($S[$i], $S[$j]);
			}
			$SC[$ikey] = $S;
		} else {
			$S = $SC[$ikey];
		}
		// Cifra/decifra os dados baseando-se no vetor de permutaчуo
		$n    = strlen($data);
		$data = str_split($data, 1);
		$i    = $j = 0;
		for ($m = 0; $m < $n; $m++) {
			$i        = ($i + 1) % 256;
			$j        = ($j + $S[$i]) % 256;
			$swap($S[$i], $S[$j]);
			$char     = ord($data[$m]);
			$char     = $S[($S[$i] + $S[$j]) % 256] ^ $char;
			$data[$m] = chr($char);
		}
		return implode('', $data);
	}
?>