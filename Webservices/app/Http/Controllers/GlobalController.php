<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function rut($rut){
        $rut = str_replace(".","",$rut);
        $arr=strrev($rut);
        $arr= str_split($arr);
        $digits= count($arr);
        $serie=2;
        $suma=0;
        $c=0;
        while($c<8){
            if($serie<=7){
                $suma+=$arr[$c]*$serie;
                $serie++;
            }
            else{
                $serie=2;
                $suma+=$arr[$c]*$serie;
                $serie++;
            }
            $c++;
        }
        $suma %=11;
        $suma=11- $suma;
        if($suma==10){
            echo "K";
        }
        else{
            if($suma == 11){
                echo "0";
            }
            else{
                if($suma<10){
                    echo $suma;
                }
                else{
                    echo "rut inválido";
                }
            }
        }
    }
     public function nombre($nombres,$apellidos){
        //
    }
}
