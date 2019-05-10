<?php 

        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
                    shuffle($seed);
                    $rand = '';
                    foreach (array_rand($seed, 4) as $k) $rand .= $seed[$k];
echo $rand;

?>