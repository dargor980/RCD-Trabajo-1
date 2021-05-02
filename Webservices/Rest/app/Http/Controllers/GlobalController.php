<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function rut(Request $request){
        $gets = $request->json()->all();
        $rut = $gets["rut"];
        $rut = str_replace(".","",$rut);
        if(strlen($rut) < 7 ){
            return 9999;
        }else{
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
                $k = 10;
                return $k;
            }
            else{
                if($suma == 11){
                    // 0
                    return 11;
                }
                else{
                    if($suma<10){
                        return $suma;
                    }
                    else{
                        return 9999;
                    }
                }
            }
        }
    }
    public function nombre(Request $request){
        $gets = $request->json()->all();
        $nombre = $gets["fullName"];
        $nombre_explode = explode(" ", $nombre);
        $count_nombres = count($nombre_explode);
        $apellidos = array();
        array_push($apellidos,$nombre_explode[$count_nombres-2]);
        array_push($apellidos,$nombre_explode[$count_nombres-1]);
        $nombres = array();
        for ($i=0; $i < $count_nombres-2 ; $i++) { 
            array_push($nombres,$nombre_explode[$i]);
        }
        $final = array();
        array_push($final,$nombres);
        array_push($final,$apellidos);
        return $final;
    }
}
