<?php
	$result = $connect->execute("SELECT * FROM estados");
	while($row = mysql_fetch_assoc($result)) {
		echo("<option value=".$row["est_codigo"].">".$row["est_sigla"]."</option>");
	}
?>