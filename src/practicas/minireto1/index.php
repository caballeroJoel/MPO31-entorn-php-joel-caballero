<?php

    $game1 = ["10/05/2026","21:00","fcbarcelona","Barcelona","rmadrid","Real Madrid", 2, 0];
    $game2 = ["11/01/2026","21:00","fcbarcelona","Barcelona","rmadrid","Real Madrid", 3, 2];
    $game3 = ["26/10/2025","21:00","rmadrid","Real Madrid","fcbarcelona","Barcelona", 2, 1];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <title>Document</title>
    </head>
    <body>
        <main>
            <table border="1px solid black">
                <tr>
                    <th colspan="2"><p>Barcelona vs Real Madrid</p></th>
                </tr>
                <tr>
                    <td>
                        <div class="container">
                            <div class="teams">
                                <img src="./img/<?=$game1[2]?>.png" alt="">
                                <span><?=$game1[3]?></span>
                                <span><?=$game1[6]?></span>
                                
                                <img src="./img/<?=$game1[4]?>.png" alt="">
                                <span><?=$game1[5]?></span>
                                <span><?=$game1[7]?></span>
                            </div>
                            <div class="time">
                                <span><?=$game1[0]?></span>
                                <span><?=$game1[1]?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="container">
                            <div class="teams">
                                <img src="./img/<?=$game2[2]?>.png" alt="">
                                <span><?=$game2[3]?></span>
                                <span><?=$game2[6]?></span>
                                
                                <img src="./img/<?=$game2[4]?>.png" alt="">
                                <span><?=$game2[5]?></span>
                                <span><?=$game2[7]?></span>
                            </div>
                            <div class="time">
                                <span><?=$game2[0]?></span>
                                <span><?=$game2[1]?></span>
                            </div>
                        </div>
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <div class="container">
                            <div class="teams">
                                <img src="./img/<?=$game3[2]?>.png" alt="">
                                <span><?=$game3[3]?></span>
                                <span><?=$game3[6]?></span>
                                
                                <img src="./img/<?=$game3[4]?>.png" alt="">
                                <span><?=$game3[5]?></span>
                                <span><?=$game3[7]?></span>
                            </div>
                            <div class="time">
                                <span><?=$game3[0]?></span>
                                <span><?=$game3[1]?></span>
                            </div>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </table>
        </main>
    </body>
</html>