<?php
/* Gráfico ano dos filmes

$user_account = 'Nadalini';

$count = '1';

$year = "SELECT COUNT(movie.movieId) as filmes, movie.movieDate FROM movie INNER JOIN statusmovie ON movie.movieId = statusmovie.movieId WHERE statusmovie.user_account = 'Nadalini' GROUP BY movie.movieDate ORDER BY movie.movieDate ASC";
$stm = $db -> prepare($year);
if ($stm -> execute()){
    while ($row = $stm -> fetch()){
        $filmes = array($row['filmes']);
        $filmes[$count] = array($filmes);
        $movieDate = $row['movieDate'];
        $movieDate[$count] = array($movieDate);
        
    }
}

*/

include_once "../bd.php"

// Ranking por tempo assistido entre amigos
?>

<div class='row' style='margin-bottom:15px;'>
<div class='col-6'>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan='3'>Ranking de Tempo Assistido (entre amigos)</th>
        </tr>
        <tr>
            <th>Posição</th>
            <th>Amigo</th>
            <th>Tempo Assistido</th>
        </tr>
    </thead>
    <tbody>

<?php
$cont = 1;
$q_ranking = "SELECT SUM(movie.movieDuration) as time_watched, follow.following FROM movie INNER JOIN statusmovie ON statusmovie.movieId = movie.movieId INNER JOIN follow ON statusmovie.user_account = follow.following WHERE follow.user_account = '$user_account' GROUP BY statusmovie.user_account ORDER BY time_watched DESC";
$stm = $db -> prepare($q_ranking);
if ($stm -> execute()){
    while ($row = $stm -> fetch()){
        $time_watched = $row['time_watched'];
        $following = $row['following'];
        ?>
        <tr>
            <?php echo "<td>$cont</td>"; ?>
            <?php echo "<td>$following</td>"; ?>
            <?php echo "<td>$time_watched minutos</td>"; ?>
        <tr>
        <?php  
        $cont ++;  
    }
}
?>
    </tbody>
</table>
</div>
<div class='col-6'>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan='5'>Seu Tempo Assistido</th>
        </tr>
        <tr>
            <th colspan='2'>Nome</th>
            <th colspan='3'>Tempo Assistido</th>
        </tr>
    </thead>
    <tbody>
<?php
$q_watched = "SELECT SUM(movie.movieDuration) as time_watched FROM movie INNER JOIN statusmovie ON statusmovie.movieId = movie.movieId WHERE statusmovie.user_account = '$user_account';";
$stm = $db -> prepare($q_watched);
if ($stm -> execute()){
    while ($row = $stm -> fetch()){
        $time_watched = $row['time_watched'];
        ?>
        <tr>
            <?php echo "<td colspan='2'>$user_account</td>"; ?>
            <?php echo "<td colspan='3'>$time_watched minutos</td>"; ?>
        <tr>
        <?php
    }
}
?>
    </tbody>

<?php
    $minuto = 0;
    $hora = 0;
    $dia = 0;
    $mes = 0;
    $ano = 0;
            
    for ($i = 0; $i <= $time_watched; $i++){
        $minuto = $minuto + 1;
        if ($minuto == 60){
            $minuto = 0;
            $hora = $hora + 1;
            if ($hora == 24){
                $hora = 0;
                $dia = $dia + 1;
                if($dia == 30){
                    $dia = 0;
                    $mes = $mes + 1;
                    if($mes == 12){
                        $mes = 0;
                        $ano = $ano + 1;
                    }
                }
            }
        }
    }   
?>

    <thead>
        <tr>
            <th>Anos</th>
            <th>Meses</th>
            <th>Dias</th>
            <th>Horas</th>
            <th>Minutos</th>          
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php echo "<td>$ano</td>";?>
            <?php echo "<td>$mes</td>";?>
            <?php echo "<td>$dia</td>";?>
            <?php echo "<td>$hora</td>";?>
            <?php echo "<td>$minuto</td>";?>          
        <tr>
    </tbody>
</table>
</div>
</div>