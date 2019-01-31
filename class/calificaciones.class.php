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

    public function get_average($type="grades"){

        if($type=="grades"){
            $total_average = array();

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
    
                    array_push($total_average, $grade);
            }
        }elseif($type=="total"){
            $total_average = 0;

            $p=0; // Promedios sumados
            $i=0; // Numero de promedios por grado
        
            foreach($this->data() as $key){
                    $p = $p + $key[5];
                    $i = $i + 1;
            }

              $total_average = $average = $p / $i;

        }

        return $total_average;
    }

    public function get_general_average(){

    }

    public function get_max_min($type="max"){
        $data = $this->data();
        $ratings = array();

        if($type == "max"){
    
            $max = 0;
            foreach( $data as $k => $v )
            { 
                $max = max( array( $max, $v[5] ) );
                if($v[5] == $max){
                    $better = array("rating"=>$max, "student"=>$v[0].' '.$v[1].' '.$v[2]);
                    array_push($ratings, $better);
                }
            }
        }elseif($type == "min"){
            $lowestKey = 10;

            foreach($data as $item)
            {
                if($item[5] < $lowestKey)
                {
                    $lowestKey = $item[5];
                    unset($ratings);
                    $ratings = array();
                    $worst = array("rating"=>$lowestKey, "student"=>$item[0].' '.$item[1].' '.$item[2]);
                    array_push($ratings, $worst);
                }elseif($item[5] == $lowestKey){
                    
                    $worst = array("rating"=>$lowestKey, "student"=>$item[0].' '.$item[1].' '.$item[2]);
                    array_push($ratings, $worst);
                }
            
            }
        }

        return $ratings;
    }

}

?>