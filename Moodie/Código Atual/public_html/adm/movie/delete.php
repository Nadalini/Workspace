<?php
    $movieId = $_GET['movieId'];

    include_once "../../bd.php";

    $query_movie = "SELECT * FROM movie WHERE movieId = ?";
    $stm_movie = $db -> prepare($query_movie);
    $stm_movie->bindParam(1,$movieId);
    if ($stm_movie -> execute()) {
        if ($row_movie = $stm_movie -> fetch()) {
            $moviePoster = $row_movie['moviePoster'];
		}
    }

    $query = "DELETE FROM movie WHERE movieId = ?";
    $stm = $db->prepare($query);
    $stm->bindParam(1, $movieId);
    
    if($stm->execute()) {
        unlink("/adm/movie/img/$moviePoster");
        header("location:");
    }
?>