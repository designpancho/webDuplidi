<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador extends CI_Controller {
        
       
       
        
	public function __construct() {
        parent::__construct();
        $this->load->model("modelo");
        
        }
    
	public function index()
	{
            
		$this->load->view('header');
	}
        function validaLogin(){
            $data['perfil']=0;    
            
            if($this->session->userdata("login")){
                $data['perfil']=$this->session->userdata("perfil");
                //$session_id = $this->session->userdata($data);
                if($this->session->userdata("perfil")==1){
                    $dato2=$this->modelo->pedidos();
                    $data['cantidad']=$dato2->num_rows();
                    $data['pedidos']=$dato2->result();
                    $data['nombre']=$this->session->userdata("nombre");
                    $this->load->view("administrador/AdmPrincipal",$data);
                }else{
                    $usuario=$this->session->userdata("usuario");
                    $dato1=$this->modelo->comprasCli($usuario);
                    $data['nombre']=$this->session->userdata("nombre"); 
                    $datos4=$this->modelo->cantR($usuario)->result();
                    $can=0;
                    
                    foreach ($datos4 as $fila){
                        
                       $can=$fila->cantidadReproducciones;
                    }
                    $data['cantidadReproducciones']=$can;
                    $data['cantidad']=$dato1->num_rows();
                    $data['Compras']=$dato1->result();
                    
                    
                     $this->load->view("cliente/CliPrincipal",$data);
                    
                }
                
            }else{
                 $this->load->view("login",$data);                
            }
            
            
        }
        
        function salir(){
            $this->session->sess_destroy();            
        }
        
        function login(){
            
            $usuario=$this->input->post("usuario");
            $clave=$this->input->post("clave");
            $data=$this->modelo->login($usuario,$clave);
            
            $cookie = array(
              
                "usuario"=>$data['usuario'],
                "perfil"=>$data['perfil'],
                "nombre"=>$data['nombre'],
                "password"=>$data['password'],
                
                
                
            );
            $msj="";
            if($data['perfil']!=""){
                $cookie['login']=true;
                $this->session->set_userdata($cookie);
                //$msj['ver']=$usuario;
                 
                
            }else{
                $msj="USUARIO NO REGISTRADO";
                
            }
            echo json_encode(array("mensaje"=>$msj));
            
        }
        
        function actualizaTabla(){
            $datos = $this->modelo->cargaDisco();
            $data['cantidad']=$datos->num_rows();
            $data['resultado']=$datos->result();
            $this->load->view("administrador/simpleCRUD",$data);
            
        }
        function mostrarTabla(){
            $datos=$this->modelo->mostrarAsocia();
            $data['cantidad']=$datos->num_rows();
            $data['Asociado']=$datos->result();
            $this->load->view("administrador/mostrarAsociados",$data);
        }
        function mostrarClientes(){
            $datos=$this->modelo->mostrarclientes();
            $data['cantidad']=$datos->num_rows();
            $data['Clientes']=$datos->result();
            $this->load->view("administrador/verClientes",$data);
        }
        
        function eliminarDisco(){
            $id_disco2 = $this->input->post("id_disco");
            $this->modelo->eliminarDisco3($id_disco2);            
        }
        function eliminarCliente(){
            $rut = $this->input->post("rut");
            $this->modelo->eliminarCliente($rut); 
        }
        function cancelarPedido(){
             $id_duplicaciones = $this->input->post("id_duplicaciones");
             $datos=$this->modelo->datosDupli($id_duplicaciones)->result();
             $rut=0;
             $cantR=0;
             $cant=0;
             
             foreach ($datos as $valor) {
                $rut=$valor->rut;
                $cantR=$valor->cantidadReproducciones;
                $cant=$valor->cantidad;
                
            }
            $final=$cantR-$cant;
             $this->modelo->descontar($rut,$final); 
             $this->modelo->cancelarPedido($id_duplicaciones);
        }
        
        function agregarDisco(){
         
            $this->load->view("administrador/agregarDisco");
                       
        }
        function agregarCliente(){
             $this->load->view("administrador/agregarCliente");
            
        }
        function editarDisco(){
            $this->load->view("administrador/editarDisco");
                       
        }
        function editarCliente(){
            $this->load->view("administrador/editarCliente");            
        }
        
        function addCliente(){
            $rut=$this->input->post("rut");
            $nombre=$this->input->post("nombre");
            $apellido=$this->input->post("apellido");
            $direccion=$this->input->post("direccion");
            $password=$this->input->post("password");
            $telefono=$this->input->post("telefono");
            $correo=$this->input->post("correo");
            $cantidadReproducciones="0";
            $perfil_cliente="3";
            
            $this->modelo->insertarCliente($rut,$nombre,$apellido,$direccion,$password,$cantidadReproducciones,$telefono,$correo,$perfil_cliente);
            
            
        }
        
        function addPedido(){
            
            $fechaHoy= date("Y-m-d");
            
            
            $id_disco=$this->input->post("id_disco");
            $rut=$this->session->userdata("usuario");
            $cantidad=$this->input->post("cantidad");
            $fecha_pedido=$fechaHoy;
            $fecha_entrega=$this->input->post("fechaEntrega");
            $valorTotal=$this->input->post("valorTotal");
            
            $this->modelo->insertarPedido($id_disco,$rut,$cantidad,$fecha_pedido,$fecha_entrega,$valorTotal);
        }
        
        
        function addDisco(){
            
            
             $id_disco=$this->input->post("id_disco");
             $nombre_disco=$this->input->post("nombre");
             $descripcion_disco=$this->input->post("descripcion");
             $interprete_disco=$this->input->post("interprete");
             $fecha_disco=$this->input->post("fecha");
             $valor_disco=$this->input->post("valor");
             
             $this->modelo->insertarDisco($id_disco,$nombre_disco,$descripcion_disco,$interprete_disco,$fecha_disco,$valor_disco);
             
             
            
            
        }
        function addAsociarDisco(){            
            $id_disco=$this->input->post("id_disco");
            $rut=$this->input->post("rut");
            
            $res=$this->modelo->insertarAsociacionDisco($id_disco,$rut);
             echo json_encode(array("mensaje"=>$res));
            
        }
        function validaRutClienteEdit(){
            $rut=$this->input->post("rut");
            $respuesta=$this->modelo->cargaClienteRutEdit($rut)->result();
            $nombre="";
            $apellido="";
            $direccion="";
            $password="";
            $cantidadReproducciones="";
            $telefono="";
            $correo="";
             foreach ($respuesta as $fila):
                $nombre=$fila->nombre;
                $apellido=$fila->apellido;
                $direccion=$fila->direccion;
                $password=$fila->password;
                $cantidadReproducciones=$fila->cantidadReproducciones;
                $telefono=$fila->telefono;
                $correo=$fila->correo;
                
                
            endforeach;
            
            echo json_encode(array(
               "nombre"=>$nombre,
                "apellido"=>$apellido,
                "direccion"=>$direccion,
                "password"=>$password,
                "cantidadReproducciones"=>$cantidadReproducciones,
                "telefono"=>$telefono,
                "correo"=>$correo
             ));
            
            
            
        }
        function validaRutCliente(){
            $rut=$this->input->post("rut");
            $respuesta=$this->modelo->cargaClienteRut($rut)->result();
            $nombre="";
            $apellido="";
            $direccion="";
            $password="";
            $telefono="";
            $correo="";
             foreach ($respuesta as $fila):
                $nombre=$fila->nombre;
                $apellido=$fila->apellido;
                $direccion=$fila->direccion;
                $password=$fila->password;
                $telefono=$fila->telefono;
                $correo=$fila->correo;
                
                
            endforeach;
            
            echo json_encode(array(
               "nombre"=>$nombre,
                "apellido"=>$apellido,
                "direccion"=>$direccion,
                "password"=>$password,
                "telefono"=>$telefono,
                "correo"=>$correo
             ));
            
            
            
        }
        function validaIdDisco(){
            $id_disco=$this->input->post("id_disco");
            $respuesta=$this->modelo->cargaDiscoID($id_disco)->result();
            $nombre="";
            $descripcion="";
            $interprete="";
            $fecha="";
            $valor="";
            foreach ($respuesta as $fila):
                $nombre=$fila->nombre_disco;
                $descripcion=$fila->descripcion_disco;
                $interprete=$fila->interprete_disco;
                $fecha=$fila->fecha_disco;
                $valor=$fila->valor_disco;
                
            endforeach;
            
            echo json_encode(array(
               "id_disco"=>$id_disco,
                "nombre_disco"=>$nombre,
                "descripcion_disco"=>$descripcion,
                "interprete_disco"=>$interprete,
                "fecha_disco"=>$fecha,
                "valor_disco"=>$valor,
             ));
            
            
            
            
        }
        function cambioClave(){
            
            $this->load->view("cliente/cambioClave");
            
        }
        
        function verificaClave(){
            $clave=$this->input->post("clave");
            $data=$this->session->userdata("password");
            $respuesta2="";
                    
            if ($clave!=$data) {
                $respuesta2="Clave NO Correcta";
            }else{
                $respuesta2="Clave Correcta";
            }
            echo json_encode(array(
               "respuesta2"=>$respuesta2
             ));
        }
        function verificaConClave(){
            $clave1=$this->input->post("claveNueva");
            $clave2=$this->input->post("claveCon");
            $respuesta2="";
                    
            if ($clave1!=$clave2) {
                $respuesta2="Clave No son Iguales";
            }else{
                $respuesta2="Clave Correcta";
            }
            echo json_encode(array(
               "respuesta2"=>$respuesta2
             ));
            
            
            
        }
        
        function addUpdateClave(){
            $claveNueva=$this->input->post("claveNueva");
            $check=$this->input->post("check");
            $data=$this->session->userdata("usuario");
            $perfil=$this->session->userdata("perfil");
            $respuesta2="";
            if ($check=="true") {
                $this->modelo->updateClaveUsuario($claveNueva,$data,$perfil);
                
                 $this->session->sess_destroy(); 
                  $respuesta2="Clave Se Cambio Correctamente";
                 
            }else{
                 $respuesta2="Debe Seleccionar Checkbox";
            }
             echo json_encode(array(
               "respuesta2"=>$respuesta2
             ));
            
            
        }
        
        
        
         function agregarPedido(){
           
             //$this->session->userdata("login");
            // $data['rut']=$this->session->userdata("usuario");
//             $id_disco=$this->input->post("id_disco");

		$data=$this->session->userdata("usuario");
           // $data=$this->session->userdata("usuario");
            date_default_timezone_set("America/Santiago");
            $datos['fecha']=date("Y-m-d");
            $datos['arrDisco2']=$this->modelo->cargaCombo($data);            
//              $data['resul']=$respuesta2->result();
            $this->load->view("cliente/agregarPedido",$datos);
        }
//        function buscaValor(){
//            $id_disco=$this->input->post("id_disco");
//            $datos=$this->modelo->buscaValor($id_disco);
//            echo json_encode(array(
//               "valor"=>$datos
//             ));
//        }
        
        
        function calculoValor2(){
             $id_disco=$this->input->post("id_disco2"); 
             $cantidad2=$this->input->post("cantidad2");
            $valorDisco=$this->modelo->buscaValor($id_disco,$cantidad2)->result();
            $precio=0;
            foreach ($valorDisco as $valor) {
                $precio= $valor->valor_disco;
            }
            
            
            
            $respuesta=($cantidad2*$precio);
             echo json_encode(array(
               "respuesta"=>$respuesta
             ));
        }
        
        function Asociar(){
            //$datos['cliente'] = $this->modelo->AsignacionCliente();
            $datos2=$this->modelo->AsignacionCliente();
             $datos=$this->modelo->AsignacionDisco();
             $data['resultado2']=$datos->result();
            $data['cliente2']=$datos2->result();
            $this->load->view("administrador/AsociarDisco",$data);
            
        }
        
        
        
        
        
}
