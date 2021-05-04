/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package funciones;

import javax.jws.WebParam;

/**
 *
 * @author manu_
 */
public class Rut {
    String rut;
    
    public Rut(String rut) {
        this.rut = rut;
    }

    public String getRut() {
        return rut;
    }

    public void setRut(String rut) {
        this.rut = rut;
    }
    
    public boolean verificar_rut(@WebParam(name = "rut") String rut) {
        for(int i=0;i<=rut.length();i++){
            try{
                Integer.parseInt(rut);
                
            }catch( NumberFormatException nfe){
                System.out.println("rut invalido, reintente");
                return false;
            }
        }
        System.out.println("rut valido");
        return true;
    }
    
    
}
