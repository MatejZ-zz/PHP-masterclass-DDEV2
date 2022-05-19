<?php

echo "Hello!<br><br>";

echo "<br>safadsf<br>";

$gege = ["ee", "ss" , "uu"];
$fruits = array("Apple", "Orange", "Lemon", "Banana", "Kiwi", "Avocado", "Elderberry");

$fruitsAssociativeArr = array("Apple"=>23, "Orange"=>52, "Lemon"=>4);

foreach ($fruits as $value) {
    echo "$value<br>";
}

foreach ($gege as $value) {
    echo "$value<br>";
}

echo "<br> A E I O U<br>";
for ($i=0; $i < count($fruits); $i++) {
    $fruit = $fruits[$i];
    $j = $i + 1;
    $fstchar = substr($fruit, 0, 1);
    if ($fstchar == "A" ||
        $fstchar == "E" ||
        $fstchar == "I" ||
        $fstchar == "O" ||
        $fstchar == "U" ||
        $fstchar == "a" ||
        $fstchar == "e" ||
        $fstchar == "i" ||
        $fstchar == "o" ||
        $fstchar == "u" ) {
        echo "Fruit nr. $j: $fruit<br>";
    }


}

echo "<br>";
sort($fruits);
for ($i=0; $i < count($fruits); $i++) {
    $fruit = $fruits[$i];
    $j = $i + 1;
    echo "Fruit nr. $j: $fruit<br>";
}

echo "<br> fruitsAssociativeArr: <br>";
$sadjaMax = 0;
$sadjeMaxKey = "";
foreach ($fruitsAssociativeArr as $key => $value) {
  echo "value: $value <br>";
  if ($value > $sadjaMax) {
    $sadjaMax = $value;
    $sadjeMaxKey = $key;
    echo "nastavim max key $key";
  }
    echo "$key : $value<br>";
}

echo "<br> sadjaMax: <br>"; 
echo "$sadjeMaxKey: $fruitsAssociativeArr[$sadjeMaxKey]<br>";
