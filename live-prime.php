<?php

function prime($n) {
	$time_start = microtime(true);
    
	echo " 	
	<table class='primes'>
        <tr><th>#</th><th>Prime</th></tr>";

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
        
        if ($prime) 
            echo "<tr><td>".(++$count)."</td><td>$x</td></tr>";	
    }
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

$max = 1000000;
set_time_limit(0);
echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Live Pioneer Primes</title>
        <style>
            h1 { text-align: center; }
            .primes { float:left; border-collapse: collapse; } 
            .primes ~ .primes { margin-left:10px; }
            .primes th { border:solid 1px #000;border-top:solid 1px #aaa;color: #fff;  text-align: center; background: #000; }
            .primes td { border:solid 1px #000; padding: 2px; text-align: right; }

            .results { float:left; margin-left: 10px; border-collapse: collapse; }
            .results th { border:solid 1px #000;border-top:solid 1px #aaa;color: #fff;  text-align: center; background: #000; }
            .results td { border:solid 1px #000; padding: 2px; }
        </style> 
	</head>
	<body>
    <h1>Live Pioneer Primes</h1>';
        
		$functions = array(
            array('Dan Huckson V0' => prime($max))
        );
        
        echo " 
        <table class='results'>
            <tr><th colspan='3'>Runtime Results<br>First $max Prime Numbers</th></tr> ";
            foreach ($functions as $function) {
            echo "
            <tr>";
                foreach ($function as $key => $time) {
                echo "<td>$key</td><td>»</td><td>$time</td>"; 
            }
            echo " 
            </tr>";
        }
        echo "</table>";
	echo '
	</body>
</html>';
