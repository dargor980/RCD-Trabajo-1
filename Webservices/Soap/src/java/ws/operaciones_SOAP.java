package ws;

import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;

/**
 * @author manu_
 */
@WebService(serviceName = "operaciones_SOAP")
public class operaciones_SOAP {

    @WebMethod(operationName = "login")
    public boolean login(@WebParam(name = "usuario") String usuario, @WebParam(name = "contrasena") String contrasena) {
       if(usuario.equals("Manu") && contrasena.equals("manu")){
           return true;
       } else {
           return false;
       }
    }

    
    @WebMethod(operationName = "ProcesarPago")
    public int ProcesarPago(@WebParam(name = "total") int total, @WebParam(name = "pago") int pago) {
       if(pago>=total){
           return pago-total;
       } else {
           return -1;
       }
    }

    /**
     * Web service operation
     * @param rut
     * @return 
     */
    @WebMethod(operationName = "verificar_rut")
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

    /**
     * Web service operation
     * @param rut
     * @return 
     */
    @WebMethod(operationName = "calculo_dv")
    public String calculo_dv(@WebParam(name = "rut") String rut) {
        
        String dv = null;

        if (verificar_rut(rut) == true){
            int digito = 2;
            int suma = 0;
            int digito_v;
            
            //invertir rut
            String rut_inv = "";
            
            for(int i = rut.length()-1;i>=0;i--){
                rut_inv += rut.charAt(i);
            }
            
            //convertir rut en arreglo de enteros
            char[] rut_char = rut_inv.toCharArray();
            int[] rut_num = new int[rut_char.length];
            
            for(int i=0; i<=rut.length()-1;i++){
                rut_num[i]= Character.getNumericValue(rut_char[i]);
            }
            
            //multiplicar rut por factor de 2 al 7
            for(int i=0; i<=rut.length()-1; i++){
                if (digito == 8){
                    digito -= 6;
                    rut_num[i]*= digito;
                    digito++;
                }
                else{
                    rut_num[i]*= digito;
                    digito++;
                } 
            }
            //sumar todos los digitos
            for (int i=0;i<=rut_num.length-1; i++){
                suma += rut_num[i];
            }
            
            double div = suma/11;
            double pd = div%1;
            int pint = (int)(div - pd);
            
            int mult = pint*11;
            
            int valor = suma - mult;
            
            if(valor<0){
                 valor *= -1;
            }
            
            digito_v = 11 - valor;
            
            switch(digito_v){
            
                case 11: dv = "0";    
                break;
                
                case 10: dv = "k";
                break;
                
                default:  dv = String.valueOf(digito_v);
                break;
            }
        }   
        return dv;
    }

    /**
     * Web service operation
     * @param nombres
     * @return 
     */
    @WebMethod(operationName = "verificar_nombres")
    public boolean verificar_nombres(@WebParam(name = "nombres") String nombres) {
        for (int i=0;i<nombres.length();i++){
            char c = nombres.charAt(i);
            if(!((c >= 'a' && c <= 'z')||(c >= 'A' && c <= 'Z')|| c==' ')){
                return false;
            }
        }
        return true;
    }

    /**
     * Web service operation
     * @param apellido_p
     * @return 
     */
    @WebMethod(operationName = "verificar_paterno")
    public boolean verificar_paterno(@WebParam(name = "apellido_p") String apellido_p) {
        for (int i=0;i<apellido_p.length();i++){
            char c = apellido_p.charAt(i);
            if(!((c >= 'a' && c <= 'z')||(c >= 'A' && c <= 'Z')|| c==' ')){
                return false;
            }
        }
        return true;
    }

    /**
     * Web service operation
     * @param apellido_m
     * @return 
     */
    @WebMethod(operationName = "verificar_materno")
    public boolean verificar_materno(@WebParam(name = "apellido_m") String apellido_m) {
        for (int i=0;i<apellido_m.length();i++){
            char c = apellido_m.charAt(i);
            if(!((c >= 'a' && c <= 'z')||(c >= 'A' && c <= 'Z')|| c==' ')){
                return false;
            }
        }
        return true;
    }

    /**
     * Web service operation
     * @param nombres
     * @param apellido_p
     * @param apellido_m
     * @return 
     */
    @WebMethod(operationName = "arreglo_nombre_completo")
    public String arreglo_nombre_completo(@WebParam(name = "nombres") String nombres, @WebParam(name = "apellido_p") String apellido_p, @WebParam(name = "apellido_m") String apellido_m) {
        String nombre_completo = nombres + apellido_p + apellido_m;
        nombre_completo.toLowerCase();
        char[]nomb_caract = nombre_completo.toCharArray();
        nomb_caract [0] = Character.toUpperCase(nomb_caract[0]);
        
        for(int i=0; i<= nombre_completo.length();i++){
            if(nomb_caract[i] == ' '){
                nomb_caract[i+1] = Character.toUpperCase(nomb_caract[i+1]);
            }
        }
        String nombre_ok = new String(nomb_caract);
        return nombre_ok;
    }
    

    
    

    
}
