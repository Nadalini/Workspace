<?php
include_once "../bd.php";

$user_account = $_SESSION['user_account'];

$maiorNumero = 0.7;
$segundoNumero = 0.6;
$terceiroNumero = 0.5;
$quartoNumero = 0.4;
$quintoNumero = 0.3;
$sextoNumero = 0.2;
$setimoNumero = 0.1;
$oitavoNumero = 0;

$i = 1;

$genre = "SELECT COUNT(*) as num, movie.movieGenre FROM movie inner join statusmovie ON statusmovie.movieId = movie.movieId WHERE statusmovie.user_account = '$user_account' GROUP BY movie.movieGenre ORDER BY num DESC";
$genreStm = $db -> prepare($genre);
if ($genreStm -> execute()){
    while ($row = $genreStm -> fetch()){
        $genreNumber = $row['num'];
        $array_genre_number[$i] = array($genreNumber);
        $genreName = $row['movieGenre'];
        $array_genre_name[$i] = array($genreName);
        $i++;

        if ($genreNumber > $maiorNumero) {
        
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $quintoNumero;
            $sextoGenero = $quintoGenero;
            
            $quintoNumero = $quartoNumero;
            $quintoGenero = $quartoGenero;
            $quartoNumero = $terceiroNumero;
            $quartoGenero = $terceiroGenero;
            $terceiroNumero = $segundoNumero;
            $terceiroGenero = $segundoGenero;
            $segundoNumero = $maiorNumero;
            $segundoGenero = $maiorGenero;
            $maiorNumero = $genreNumber;
            $maiorGenero = $genreName;
        } else if ($genreNumber > $segundoNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $quintoNumero;
            $sextoGenero = $quintoGenero;
    
            $quintoNumero = $quartoNumero;
            $quintoGenero = $quartoGenero;
            $quartoNumero = $terceiroNumero;
            $quartoGenero = $terceiroGenero;
            $terceiroNumero = $segundoNumero;
            $terceiroGenero = $segundoGenero;
            $segundoNumero = $genreNumber;
            $segundoGenero = $genreName;
        } else if ($genreNumber > $terceiroNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $quintoNumero;
            $sextoGenero = $quintoGenero;
    
            $quintoNumero = $quartoNumero;
            $quintoGenero = $quartoGenero;
    
            $quartoNumero = $terceiroNumero;
            $quartoGenero = $terceiroGenero;
    
            $terceiroNumero = $genreNumber;
            $terceiroGenero = $genreName;
    
        } else if ($genreNumber > $quartoNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $quintoNumero;
            $sextoGenero = $quintoGenero;
    
            $quintoNumero = $quartoNumero;
            $quintoGenero = $quartoGenero;
    
            $quartoNumero = $genreNumber;
            $quartoGenero = $genreName;
    
        } else if ($genreNumber > $quintoNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $quintoNumero;
            $sextoGenero = $quintoGenero;
    
            $quintoNumero = $genreNumber;
            $quintoGenero = $genreName;
            
        } else if ($genreNumber > $sextoNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $sextoNumero;
            $setimoGenero = $sextoGenero;
            
            $sextoNumero = $genreNumber;
            $sextoGenero = $genreName;
    
        } else if ($genreNumber > $setimoNumero){
            
            $oitavoNumero = $setimoNumero;
            $oitavoGenero = $setimoGenero;
    
            $setimoNumero = $genreNumber;
            $setimoGenero = $genreName;
    
        } else if ($genreNumber > $oitavoNumero){
            
            $oitavoNumero = $genreNumber;
            $oitavoGenero = $genreName;
    
        } else if ($genreNumber < $quintoNumero){
            $numberResto = $numberResto + $genreNumber;
        }

    }
}

$time = "SELECT SUM(movie.movieDuration) as time_watched, statusmovie.user_account FROM movie INNER JOIN statusmovie ON statusmovie.movieId = movie.movieId WHERE statusmovie.statusMovie = '1' GROUP BY statusmovie.user_account ORDER BY time_watched ASC";
$time_stm = $db -> prepare($time);
if ($time_stm -> execute()){
    while ($row = $time_stm -> fetch()){
        $max_time_watched = $row['time_watched'];
        $max_user_account = $row['user_account'];
    }
}

$time = "SELECT SUM(movie.movieDuration) as time_watched, statusmovie.user_account FROM movie INNER JOIN statusmovie ON statusmovie.movieId = movie.movieId WHERE statusmovie.statusMovie = '1' AND statusmovie.user_account = '$user_account' GROUP BY statusmovie.user_account";
$time_stm = $db -> prepare($time);
if ($time_stm -> execute()){
    while ($row = $time_stm -> fetch()){
        $time_watched = $row['time_watched'];
    }
}