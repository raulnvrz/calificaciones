<?php

class Calificaciones {

    private $xlsx;

    function __construct( $xlsx ) {
		$this->xlsx = $xlsx;
    }
    
    public function data()
    {
        $i=0;
        $array = array();
        foreach( $this->xlsx->rows() as $fields ) {//Itero la hoja de calculo
            if($i>0){ // Omitimos el header

                array_push($array, $fields);
            }
            $i++;
           }

           return $array;
    }

    public function remove_dot($val){

        if($val==10){
            $val = 100;
        }

        if(!$this->is_decimal($val) && $val<100){
            $val = $val.'0';
        }else{
            $val = str_replace(".", "", $val);
        }

        return $val;
    }

    public function is_decimal( $val )
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }

    public function get_grades(){
        $grades = array();
        
        foreach( $this->data() as $fields ) {//Iteramos los datos 
            
                array_push($grades, $fields[3]);

           }

           $grades = array_unique($grades);

           return $grades;
    }

    public function get_grades_average(){
        $grades_average = array();

        foreach($this->get_grades() as $val){
            $p=0; // Promedios sumados
            $i=0; // Numero de promedios por grado
            $grade = array();
        
            foreach($this->data() as $key){
                if($val == $key[3]){
                    $p = $p + $key[5];
                    $i = $i + 1;
                }
            }

                $average = $p / $i;

                $grade = array("grade"=>$val,"average"=>$average);

                array_push($grades_average, $grade);
        }


        return $grades_average;
    }

    public function get_general_average(){

    }

}

?>