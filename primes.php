<?php

function prime0($n) {
	// Lets time ourself.
	$time_start = microtime(true);

	echo "
	<table class='primes'>
        <tr><th colspan='2'>Dan V0</th></tr>
        <tr><th>#</th><th>Prime</th></tr>";
    
    $count = 0;
    for ($x = 2; $count < $n; $x++) {
        $i = 2;
        $prime = 1;
        $sqrt = sqrt($x);
        if ($x > 2) 
            while ($i <= $sqrt) 
                if ($x%$i++ == 0) {
                    $prime = 0; 
                    break;
                } 
        
        if ($prime) echo "
        <tr><td>".(++$count)."</td><td>$x</td></tr>";	
    }
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

function prime1($n) {
	$time_start = microtime(true);

	echo " 	
	<table class='primes'>
	<tr><th colspan='2'>Dan V1</th></tr>
	<tr><th>#</th><th>Prime</th></tr>";
    
    $count = 0;
    $primes = array();
    
    for ($x = 2; $count < $n; $x++) {
        $prime = 1;
        if ($x > 2)
            foreach ($primes as $num)
                if ($x%$num == 0) {
                    $prime = 0; 
                    break;
                } 
        
        if ($prime) echo "<tr><td>".(++$count)."</td><td>".($primes[] = $x)."</td></tr>";
    }
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

function prime2($n) {
	// $n equals the number of prime numbers to proccess.
	
	// Lets time ourself.
	$time_start = microtime(true);
	
	// Display output in a table and include some styling.
	echo " 	
	<table class='primes'>
        <tr><th colspan='2'>Dan V2</th></tr>
        <tr><th>#</th><th>Prime</th></tr>";
	
	$count=0; // Prime numbers processed, or index counter.
	
	// We will continue to loop while our current,
	// $count (processed prime numbers) < $n (number of prime numbers to proccess) .
	// $i holds the current number being tested. 
	// We are starting at 2, which will be our first prime number and continue to we find $n prime numbers.
	for ($i=2; $count < $n ; $i++) {
		// Set the result to true and change it to false if the current number ($i) is not a prime number. 
		$result = TRUE; 
		
		// Loop through all numbers from 2 to ($i/2 + 1) or (half of $i + 1).
		// If $i is not a prime number the loop is termanated by breaking out of the loop.
		$x = $i/2+1; 
		for ($j=2; $j<$x; $j++) {
			if (!($i%$j)) { // If we have no remainder the number is not a prime number. 
				$result=FALSE; // Set result to false not a prime number.
				break; // Save some CPU cycles, no need to continue looping if number is not prime a number.
			}
		}		
		if ($result) // If $result is true ($i) is a prime number, update count and display results.
			echo "<tr><td>".(++$count)."</td><td>$i</td></tr>";	
	}

	// All done, Calculate and display total runtime. 
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

function prime3($n) {
	// $n equals the number of prime numbers to proccess.
	
	// Lets time ourself.
	$time_start = microtime(true);
	
	echo " 	
	
	<table class='primes'>
        <tr><th colspan='2'>Dan V3</th></tr>
        <tr><th>#</th><th>Prime</th></tr>";
	
	$count=0; 
	for ($i=2; $count < $n; $i++) {
        if (!gmp_intval(gmp_mod(gmp_add(gmp_fact(($i-1)),1),$i))) 
            echo "<tr><td>".(++$count)."</td><td>$i</td></tr>";	
	}
    
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}
   
function prime4($n) {
	$time_start = microtime(true);
	
	$total = 0;
	echo " 	
	<table class='primes'>
        <tr><th colspan='2'>Geoff V0</th></tr>
        <tr><th>#</th><th>Prime</th></tr>";
	
	for ($x = 1; $total < $n; $x++) {
		$count = 2;
		for ($y=1; $y <= $x; $y++) {
			if (!($x % $y) && !($count--)) break;
		}
		if(!$count) {
    		echo "<tr><td>".(++$total)."</td><td>$x</td></tr>";	
		}
	}
    
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

$max = 1000;
set_time_limit(0);
echo '
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Pioneer Primes</title>
        <style>
            h1 {text-align: center;}
            .primes {float:left; border-collapse: collapse; } 
            .primes ~ .primes {margin-left:10px; }
            .primes th { border:solid 1px #000;border-top:solid 1px #aaa;color: #fff;  text-align: center; background: #000;}
            .primes td { border:solid 1px #000; padding: 2px; text-align: right; }

            .results { float:left; margin-left: 10px; border-collapse: collapse;}
            .results th { border:solid 1px #000;border-top:solid 1px #aaa;color: #fff;  text-align: center; background: #000; }
            .results td { border:solid 1px #000; padding: 2px; }


        </style> 
	</head>
	<body>
    <h1>Pioneer Primes</h1>';
        
		$functions = array(
            array('Dan Huckson V0' => prime0($max)), 
            array('Dan Huckson V1' => prime1($max)),
            array('Dan Huckson V2' => prime2($max)),
            array('Dan Huckson V3' => prime3($max)),
            array('Geoff V0' => prime4($max))
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

