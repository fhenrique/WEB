<?php
   /*$a = array("a","b","c","d");
   $a[]="e";
   print_r($a);
   */

   $num=1000;

   function escopo(){
    $num=0;
    $num += 5;
    echo "Variável dentro da função:".$num. "<br>";
    }
    
    echo "Variável fora da função:".$num. "<br>";

    escopo();
   
?>