<?php
$query_test = 'SELECT classificacao FROM statusmovie WHERE movieId = ? AND classificacao IS NOT NULL';
$stm_test = $db -> prepare($query_test);
$stm_test -> bindParam(1,$movieId);

if ($stm_test -> execute()) {
	if ($row = $stm_test -> fetch()) {
		$movie_avg = "SELECT AVG(statusmovie.classificacao) AS media FROM movie INNER JOIN statusmovie ON (movie.movieId = ?) AND (movie.movieId = statusmovie.movieId) GROUP BY movie.movieName";
		$stm_avg = $db -> prepare($movie_avg);
		$stm_avg -> bindParam(1,$movieId);
		if ($stm_avg -> execute()) {
			if ($row = $stm_avg -> fetch()) {
				$media = number_format($row['media'], 1, '.', '');
				echo "<div style='width:500;'>$media and $movieId</div>";
			}
		}
	} else{
		$media = 0;
		echo "<div style='width:500;'>$media and $movieId</div>";
	}
}
?>