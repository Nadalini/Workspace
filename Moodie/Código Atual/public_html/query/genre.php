<?php
                    $maiorNumero = 7;
                    $segundoNumero = 6;
                    $terceiroNumero = 5;
                    $quartoNumero = 4;
                    $quintoNumero = 3;
                    $sextoNumero = 2;
                    $setimoNumero = 1;
                    $oitavoNumero = 0;


                    $genre = "SELECT COUNT(genreName) as genre FROM genre";
                    $genreStm = $db -> prepare($genre);
                    if ($genreStm -> execute()){
                        while ($row = $genreStm -> fetch()){
                            $genre = $row['genre'];
                        }
                    }  
                    for ($i = 1; $i <= $genre; $i++){
                        $genreName = 'SELECT * FROM genre WHERE genreId = ?';
                        $stm = $db -> prepare($genreName);
                        $stm->bindParam(1,$i);
                        if ($stm -> execute()) {
                            if ($row = $stm -> fetch()) {
                                $genreName = $row['genreName'];
                                $array_genre_name[$i] = array($genreName);
                            }
                        }
                        $query_number = 'SELECT COUNT(movieId) as genreNumber FROM movie WHERE movieGenre = ?';
                        $stm_number = $db -> prepare($query_number);
                        $stm_number->bindParam(1,$genreName);
                        if ($stm_number -> execute()) {
                            if ($row = $stm_number -> fetch()) {
                                $genreNumber = $row['genreNumber'];
                                $array_genre_number[$i] = array($genreNumber);
                            }
                        }
          
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
                    ?>