<?php

class Izpis {
    public string $besedilo; //

    public function __construct( $besedilo ){
        $this->besedilo = $besedilo;
    }

    private function pripravi(){
        $this->besedilo = '<p>' . $this->besedilo . '</p>';
    }

    public function izpisi(){
        $this->pripravi();
        echo $this->besedilo;
    }

    public static function izpis2($besedilo){
        //echo $besedilo;
        return $besedilo;
    }



}

$izpis = new Izpis("Živjo!");
echo "<br>A<br>";
$izpis->izpisi();
echo "<br>A<br>";
var_dump($izpis);
echo "<br>A<br>";
$izpis::izpis2("ASDF");
echo "<br>A<br>";
$a = Izpis::izpis2("GEGE");
echo "<br>A<br>";
echo $a;
echo "<br>A<br>";

