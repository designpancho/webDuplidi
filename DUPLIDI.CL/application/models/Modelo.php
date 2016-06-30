<?php

class Modelo extends CI_Model{
    
    function login($usuario, $clave){
        $this->db->select("*");
        $this->db->where("rut",$usuario);
        $this->db->where("password",$clave);
        $datos=$this->db->get("cliente");
        
        $this->db->select("*");
        $this->db->where("rut_adm",$usuario);
        $this->db->where("password_adm",$clave);
        $datos2=$this->db->get("administrador");
        
        $data['usuario']="";
        $data['perfil']="";
        $data['nombre']="";
        $data['password']="";
        
        
        foreach ($datos->result() as $fila){
            
        $data['usuario']=$fila->rut;
        $data['perfil']=$fila->perfil_cliente;
        $data['nombre']=$fila->nombre;
        $data['password']=$fila->password;
        $data['cantidadReproducciones']=$fila->cantidadReproducciones;
            
        }
        foreach ($datos2->result() as $fila){
            
        $data['usuario']=$fila->rut_adm;
        $data['perfil']=$fila->perfil_adm;
        $data['nombre']=$fila->nombre_adm;
        $data['password']=$fila->password_adm;
            
        }
        
        
        
        
        
        return $data;
        
    }
    function cantR($usuario){
          $this->db->select("cantidadReproducciones");
        $this->db->where("rut",$usuario);       
        return $datos4=$this->db->get("cliente");
        
    }
    
    function cargaDisco(){
        $this->db->select("*");
        return $this->db->get("disco");
        
    }
    
    function eliminarDisco3($id_disco2){
      //  $this->db->query("delete from disco where id_disco=id_disco2");    
        
        $this->db->where("id_disco",$id_disco2);
        $this->db->delete("disco");
        
    }
    function eliminarCliente($rut){
        $this->db->where("rut",$rut);
        $this->db->delete("cliente");
        
        
    }
     function  cancelarPedido($id_duplicaciones){
         $this->db->where("id_duplicaciones",$id_duplicaciones);
         $this->db->delete("duplicaciones");
        
    }
    
    
    function datosDupli($id_duplicaciones){
        
        return $query=$this->db->query("select c.rut, c.cantidadReproducciones, d.cantidad from
                                    cliente c join duplicaciones d 
                                    on c.rut=d.rut
                                    where d.id_duplicaciones='$id_duplicaciones'");
        
        
       
           
           
//       $this->db->query("UPDATE cliente SET  cantidadReproducciones = '$final' WHERE  rut ='$rut'");
          
    }
    function descontar($rut,$final){
         $this->db->query("UPDATE cliente SET  cantidadReproducciones = '$final' WHERE  rut ='$rut'");
        
    }
    
    function cargaClienteRut($rut){
         $this->db->select("*");
        $this->db->where("rut",$rut);
         return $this->db->get("cliente");  
        
    }
    function cargaClienteRutEdit($rut){
        $this->db->select("*");
        $this->db->where("rut",$rut);
        return $this->db->get("cliente");  
        
    }
    
    function cargaDiscoID($id_disco2){
        $this->db->select("*");
        $this->db->where("id_disco",$id_disco2);
         return $this->db->get("disco");        
    }
    
    
    function insertarAsociacionDisco($id_disco,$rut){
        
        $res="";
        
        $query = $this->db->query("SELECT * FROM `disco_cliente` WHERE rut='$rut' and id_disco='$id_disco'");
        if ($query->num_rows() ==0) {
            $datos2=array(
                
                "rut"=>$rut,
                "id_disco"=>$id_disco,
               
            );
            $this->db->insert("disco_cliente",$datos2);
            $res="Asignado Correctamente";
        }else{
            
            $res="ERROR!!! La Asignacion Ya Esta Realizada";
        }
        return $res;
    }
    
    function insertarCliente($rut,$nombre,$apellido,$direccion,$password,$cantidadReproducciones,$telefono,$correo,$perfil_cliente){
        $this->db->select("rut");
        $this->db->where("rut",$rut);
        $cant=$this->db->get("cliente")->num_rows();
        if($cant==0){
            
            $datos=array(
                "rut"=>$rut,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "direccion"=>$direccion,
                "password"=>$password,
                "cantidadReproducciones"=>$cantidadReproducciones, 
                "telefono"=>$telefono,
                "correo"=>$correo,
                "perfil_cliente"=>$perfil_cliente
            );
            $this->db->insert("cliente",$datos);
            
            
        }else{
             $datos2=array(
                "rut"=>$rut,
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "direccion"=>$direccion,
                "password"=>$password,
                "cantidadReproducciones"=>$cantidadReproducciones, 
                "telefono"=>$telefono,
                "correo"=>$correo,
                "perfil_cliente"=>$perfil_cliente
            );
             $this->db->where("rut",$rut);
             $this->db->update("cliente",$datos2);
            
        }
        
        
    }
    
    function insertarPedido($id_disco,$rut,$cantidad,$fecha_pedido,$fecha_entrega,$valorTotal){
            $datos=array(
            "id_disco"=>$id_disco,
            "rut"=>$rut,
            "cantidad"=>$cantidad,
            "fecha_pedido"=>$fecha_pedido,
            "fecha_entrega"=>$fecha_entrega,
            "valor_total"=>$valorTotal,
            );
          $this->db->insert("duplicaciones",$datos);
          
          
          $this->db->select("cantidadReproducciones");
        $this->db->where("rut",$rut);
        $cant=$this->db->get("cliente")->result();
        $cantidad1=0;
            foreach ($cant as $valor) {
                $cantidad1= $valor->cantidadReproducciones;
            }
            $datos2=array(               
               
                "cantidadReproducciones"=>$cantidad+$cantidad1,
                
            );
             $this->db->where("rut",$rut);
             $this->db->update("cliente",$datos2);
            
            
    }
    
    
    function insertarDisco($id_disco,$nombre_disco,$descripcion_disco,$interprete_disco,$fecha_disco,$valor_disco){
         $this->db->select("id_disco");
        $this->db->where("id_disco",$id_disco);
        $cant=$this->db->get("disco")->num_rows();
        
        if($cant==0){
            
            $datos=array(
                "id_disco"=>$id_disco,
                "nombre_disco"=>$nombre_disco,
                "descripcion_disco"=>$descripcion_disco,
                "interprete_disco"=>$interprete_disco,
                "fecha_disco"=>$fecha_disco,
                "valor_disco"=>$valor_disco 
            );
            $this->db->insert("disco",$datos);
            
            
        }else{
             $datos=array(               
                "nombre_disco"=>$nombre_disco,
                "descripcion_disco"=>$descripcion_disco,
                "interprete_disco"=>$interprete_disco,
                "fecha_disco"=>$fecha_disco,
                "valor_disco"=>$valor_disco 
            );
             $this->db->where("id_disco",$id_disco);
             $this->db->update("disco",$datos);
            
        }
        
        
    }
    
    
    function cargaCombo($data){
        // armamos la consulta
    $query = $this->db->query("SELECT id_disco, nombre_disco FROM disco where id_disco in (select id_disco from disco_cliente where rut='$data')");
  
    // si hay resultados
//    if ($query->num_rows() > 0) {
//        // almacenamos en una matriz bidimensional
//        foreach($query->result() as $row) 
//           $arrDisco2[htmlspecialchars($row->id_disco, ENT_QUOTES)] = 
//            htmlspecialchars($row->nombre_disco, ENT_QUOTES);
//
//        $query->free_result();
//        
//        
//        
//        
//        return $arrDisco2;
//     }
        return $query->result();
        
    }
    
    function buscaValor($id_disco,$cantidad){
        $this->db->select("valor_disco");
        $this->db->where("id_disco",$id_disco);
       return $query=$this->db->get("disco");

        
        
//        $query = $this->db->query("SELECT valor_disco FROM disco where id_disco =$id_disco");
//        
//        
//        
//     // $s=100;
//     // $arr[htmlspecialchars($row->valor_disco, ENT_QUOTES)] ;
//           //   $s=cast($query);
//         if ($query > 0) {
//        // almacenamos en una matriz bidimensional
//         $valorDisco=$query*$cantidad;
//        return query;
     }
        
    
    
    function AsignacionDisco(){
        $this->db->select("id_disco, nombre_disco");
        return $this->db->get("disco");
       
         
    }
    
    
    
    function AsignacionCliente(){
        $this->db->select("rut , nombre");
        return $this->db->get("cliente");
    }
    
    function updateClaveUsuario($claveNueva,$data,$perfil){
        if ($perfil!=1) {
            $datos=array(               
               
                "password"=>$claveNueva,
                
            );
             $this->db->where("rut",$data);
             $this->db->update("cliente",$datos);
    }else{
        $datos=array(               
               
                "password_adm"=>$claveNueva,
                
            );
             $this->db->where("rut_adm",$data);
             $this->db->update("administrador",$datos);
        
        
    }
       //return $query="Update cliente Set password='$claveNueva' Where rut='$data'";
         
        
    }
    function comprasCli($usuario){
        
                 $query=$this->db->query("select d.nombre_disco,i.cantidad, i.fecha_entrega, i.valor_total  
                        from duplicaciones i join disco d
                        on d.id_disco=i.id_disco
                        where i.rut='$usuario'");
                        
                        return $query;
        
        
    }
    function pedidos(){
        $query=$this->db->query("select i.id_duplicaciones, d.nombre_disco,c.nombre, i.cantidad,i.fecha_pedido, i.fecha_entrega, i.valor_total  
                                    from duplicaciones i join disco d
                                    on d.id_disco=i.id_disco
                                    join cliente c
                                    on c.rut=i.rut");
                        
                        return $query;
        
    }
    function mostrarAsocia(){
        $query=$this->db->query("select i.id_disco_cliente, c.nombre, d.nombre_disco 
                                from cliente c join disco_cliente i
                                on c.rut=i.rut
                                join disco d 
                                on i.id_disco=d.id_disco");
        return $query;
    }
    
    function mostrarclientes(){
        $query=$this->db->query("select * from cliente");
        return $query;
        
    }
    
    
    
    
}






?>