<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function rut(Request $request){
        $gets = $request->json()->all();
        $rut = $gets["rut"];
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
            return "K";
        }
        else{
            if($suma == 11){
                return "0";
            }
            else{
                if($suma<10){
                    return $suma;
                }
                else{
                    return "rut inválido";
                }
            }
        }
    }
    public function nombre(Request $request){
        $gets = $request->json()->all();
        $nombres = $gets["nombres"];
        $apellidos = $gets["apellidos"];
        $nombre_explode = explode(" ", $nombres);
        $apellidos_explode = explode(" ", $apellidos);
        $count_nombres = count($nombre_explode);
        $count_apellidos = count($apellidos_explode);
        $response_final = array();
        $response_nombres = array();
        $response_apellidos = array();
        if($count_apellidos < 2){
            return "Cantidad de apellidos no valida";
        }else {
            for($aux=0;$aux < $count_nombres;$aux++){
                array_push($response_nombres,$nombre_explode[$aux]);
            }
            for($aux=0;$aux < $count_apellidos;$aux++){
                array_push($response_apellidos,$apellidos_explode[$aux]);
            }
            array_push($response_final,$response_nombres,$response_apellidos);
            return $response_final;
        }
    }
}
