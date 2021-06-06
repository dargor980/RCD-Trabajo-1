<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class GlobalController extends Controller
{
    public function rut(Request $request){
        try {
            Log::info("Inicia Funcion Rut");
            $gets = $request->json()->all();
            $rut = $gets["rut"];
            $rut = str_replace(".","",$rut);
            if(strlen($rut) < 7 ){
                Log::error("Rut inválido");
                return 9999;
            }else{
                $arr=strrev($rut);
                $arr= str_split($arr);
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
                    Log::info("Retorna K");
                    return 10;
                }
                else{
                    if($suma == 11){
                        Log::info("Retorna 0");
                        return 11;
                    }
                    else{
                        if($suma<10){
                            return $suma;
                        }
                        else{
                            Log::error("Rut inválido");
                            return 9999;
                        }
                    }
                }
            }
        } catch (\Exception $exc) {
            Log::error($exc->getMessage());    
        }        
    }
    public function nombre(Request $request){
        try {
            Log::info("Inicia funcion nombre");
            $gets = $request->json()->all();
            $nombre = $gets["fullName"];
            $nombre_explode = explode(" ", $nombre);
            $count_nombres = count($nombre_explode);
            if($count_nombres <= 2){
                return 9999;
            }else{

                $apellidos = array();
                array_push($apellidos,$nombre_explode[$count_nombres-2]);
                array_push($apellidos,$nombre_explode[$count_nombres-1]);
                for ($i=0; $i < count($apellidos); $i++) { 
                    $apellidos[$i] = ucfirst(strtolower($apellidos[$i]));
                }
                $nombres = array();
                for ($i=0; $i < $count_nombres-2 ; $i++) { 
                    array_push($nombres,$nombre_explode[$i]);
                }
                for ($j=0; $j < count($nombres); $j++) { 
                    $nombres[$j] = ucfirst(strtolower($nombres[$j]));
                }
                $final = array();
                array_push($final,$nombres);
                array_push($final,$apellidos);
                Log::info("Finaliza funcion nombre");
                return $final;
            }
        } catch (\Exception $exc) {
            Log::error($exc->getMessage());
            return "Error";   
        }        
    }
}
