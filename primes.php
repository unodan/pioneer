<?php
 

function prime0($n) {
	// Lets time ourself.
	$time_start = microtime(true);

	echo " 	
	<style>.test-table {float:left;} .test-table td {border:solid 1px #000;}</style> 
	<div>Prime Numbers = $n<br><br></div>
	<table class='test-table'>
	<tr><td colspan='2'>Dan Huckson prime0</td></tr>
	<tr><td>Count</td><td>Prime Number</td></tr>";
    
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
        
        if ($prime) echo "<tr><td>".(++$count)."</td><td>".($x)."</td></tr>";	
    }
    
    $runtime = microtime(true) - $time_start;
    
	echo "
	</table>";
    
    return $runtime;
}

function prime1($n) {
	$time_start = microtime(true);

	echo " 	
	<style>.test-table {float:left;} .test-table td {border:solid 1px #000;}</style> 
	<table class='test-table'>
	<tr><td colspan='2'>Dan Huckson prime1</td></tr>
	<tr><td>Count</td><td>Prime Number</td></tr>";
    
    $count = 0;
    $primes = array();
    
    for ($x = 2; $count < $n; $x++) {
        $prime = true;
        
        if ($x > 2) {
            foreach ($primes as $num) {
                if ($x%$num == 0) {
                    $prime = false; 
                    break;
                } 
            }
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
	<style>.test-table {float:left;} .test-table td {border:solid 1px #000;}</style> 
	<table class='test-table'>
	<tr><td colspan='2'>Dan Huckson prime2</td></tr>
	<tr><td>Count</td><td>Prime Number</td></tr>";
	
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
	<style>.test-table {float:left;} .test-table td {border:solid 1px #000;}</style> 
	
	<table class='test-table'>
	<tr><td colspan='2'>Dan Huckson prime3</td></tr>
	<tr><td>Count</td><td>Prime Number</td></tr>";
	
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
	<style>.test-table {float:left;} .test-table td {border:solid 1px #000;}</style> 
	<table class='test-table'>
	<tr><td colspan='2'>Geoff prime4</td></tr>
	<tr><td>Count</td><td>Prime Number</td></tr>";
	
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
		<title></title>
	</head>
	<body>';
		$times = array(
            prime0($max), 
            prime1($max),
            prime2($max),
            prime3($max),
            prime4($max)
        );
        foreach ($times as $i => $time) {
           echo "<div>prime$i = $time</div>"; 
        }
	echo '
	</body>
</html>';

