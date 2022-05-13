<?php  
	session_start();
?>
<?php
#$command = escapeshellcmd('pysoapp.py');
#$output = shell_exec($command);
#$outp = json_encode($output);
#$json_string = json_encode($output, JSON_PRETTY_PRINT);
#echo "<pre>"; print_r($output[3]); echo "</pre>";
#var_dump(json_decode($json_string));
#var_dump(json_decode($json_string, true));
$stringv = file_get_contents("locationdata.json");

    if ($stringv === false) {
      echo "No content<br>";
    }

$output = json_decode($stringv, true);
    if ($output === null) {
        // deal with error...
      echo "Parse error<br>";
    }
  
$cont=0;
$a=0;
$b=0;
$myArray[$a] = $output;
$myArrayb[$b] = $output;
#echo "<pre>"; print_r($myArray); echo "</pre>";
$limit = count($myArray[0]);
#echo "<br>";
#echo "Total: ".$lim."<br>";
$arrayn=array();
$arrayd=array();
for ($i=0; $i < $limit; $i++) { 
	#echo $myArray[0][$i]." - ";
	if ($cont==0) {
		$arrayn[$a][] = $myArray[0][$i];
		$cont=$cont+1;
		
	}else{
		$cont = 0;
		$a=$a+1;
		$i=$i+8;
	}

}
$cont=0;
for ($j=1; $j < $limit; $j++) { 
	#echo $myArray[0][$i]." - ";
	if ($cont<9) {
		$arrayd[$b][] = $myArrayb[0][$j];
		#echo $myArrayb[0][$j].' | '.$j.'<br>';
		$cont=$cont+1;
	}else{
		$cont = 0;
		$b=$b+1;
		#$j=$j+1;
	}

}


$fp = fopen('resultslocation.json', 'w');
fwrite($fp, json_encode($arrayn));
fclose($fp);

$dt = fopen('resultslocationdata.json', 'w');
fwrite($dt, json_encode($arrayd));
fclose($dt);
#$limit = count($arrayn);
#echo "Limit: ".$limit;

#$myArray['a'] = explode(',', $json_string);
#echo "<pre>"; print_r($arrayn[3][0]); echo "</pre>";
#echo "<pre>"; print_r($arrayn); echo "</pre>";
header('Location: ../../../maps/pdmaps.php');
?>
<script>
if(document.getElementById('ftnt_topbar_script')) {
    document.getElementById('ftnt_topbar_script').remove()
} else {
   var pluginHolder = document.createElement('div');
   document.body.appendChild(pluginHolder);
}