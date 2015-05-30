<?php

function prime($n) {
	$time_start = microtime(true);

    $count = 0;
    for ($x = 2; $count < $n; $x++) {
        $i = 2;
        $prime = true;
        $sqrt = sqrt($x);
        if ($x > 2) 
            while ($i <= $sqrt) 
                if ($x%$i++ == 0) {
                    $prime = false; 
                    break;
                } 
        
        if ($prime) echo ++$count." ".$x.PHP_EOL;
    }
	echo (microtime(true) - $time_start)." seconds.".PHP_EOL;
}

set_time_limit(0);
prime(1000000);
