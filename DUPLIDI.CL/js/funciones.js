$(document).ready(function(){
    validaLogin();
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
});

function validaLogin(){
    $.post(
            base_url+"Controlador/validaLogin",{},
            function(pagina, datos){
                $("#content").html(pagina,datos);
                Cliente(); 
                
                $("#loginBoton").button(
                        
                        
                        ).click(function(){
                            loginBoton();
                            
                        });
                        
                 
                 $("#btnCerrar").button().click(
                   function(){
                       salir();
                 
                   });
                   $("#Asociar_disco").button().click(
                       function(){
                        Asociar_disco_modal();   
                           
                       });
                   $("#verDisco").button().click(
                   function(){
                            
                            actualizaTabla();
                            cerrarTabla2();
                           cerrarTabla3();
                 
                   });
                   $("#verAsociado").button().click(
                       function(){
                           mostrarAsociado();
                           cerrarTabla();
                           cerrarTabla3();
                       }
                       
                   );
                   $("#verCliente").button().click(
                       function(){
                           
                             verClientes();
                            cerrarTabla();
                            cerrarTabla2();
                       
                          
                       }
           
                        );
                 
                   $("#addCliente").button({
                       icons:{secondary:"ui-icon-plus"},
                       text:true    
                   }).tooltip({
                       position:{
                           my:"left top",
                           at:"right+5 top-5" }
                   });
                   
                   
                 $("#addDisco").button({
                       icons:{secondary:"ui-icon-plus"},
                       text:true       
                   }).tooltip({
                       position:{
                           my:"left top",
                           at:"right+5 top-5"           
                       }

                   });
                    
                   
                   $("#addDiscoModal").dialog({
                       modal:true, autoOpen:false, width:400,
                       buttons:{
                           "Guardar":function(){
                               $(this).dialog("close");
                               if(parseInt($("#addValor").val())<=0 ){
                                    mensajes("Complete Campo Valor","error");

                               }else{
                                   addDisco();
                                   
                                   location.reload();
                                   //actualizaTabla();
                               }
                           }

                       }


                   });
                    $("#editarModal").dialog({
                           modal:true, autoOpen:false, width:400, 
                            buttons:{
                           "Guardar":function(){
                               $(this).dialog("close");
                               if(parseInt($("#addValor").val())<=0 ){
                                    mensajes("Complete Campo Valor","error");

                               }else{
                                   addDisco();
                                   //location.reload();
                               }
                           }

                       } 
                    });
                    $("#editarClienteModal").dialog({
                           modal:true, autoOpen:false, width:500, 
                            buttons:{
                           "Guardar":function(){
                               $(this).dialog("close");
                               if(parseInt($("#addTelefonoCliente").val())<=0 ){
                                    mensajes("Complete Campo Telefono","error");
                                    
                               }else{
                                   addClienteEdit();
                                   //location.reload();
                               }
                           }

                       } 
                    });
                    $("#addAsociacionModal").dialog({
                           modal:true, autoOpen:false, width:650, 
                            buttons:{
                           "GuardarCombobox":function(){
                               $(this).dialog("close");
                               if(parseInt($("#SeleccionClienteCombobox").val())<=0 || parseInt($("#SeleccionDiscoCombox").val())<=0 ){
                                    mensajes("Complete Seleccion","error");

                               }else{
                                  AsociarDisco();
                                   //location.reload();
                               }
                           }

                       } 
                    }); 
                     $("#addClienteModal").dialog({
                           modal:true, autoOpen:false, width:400, 
                            buttons:{
                           "GuardarCliente":function(){
                               $(this).dialog("close");
                               if(parseInt($("#addNombreCliente").val())<=""){
                                    mensajes("Complete Campos de Cliente","error");

                               }else{
                                   addCliente();
                                  //AsociarDisco();
                                   //location.reload();
                               }
                           }

                       } 
                    }); 
                        diseno2();
                        
//                   actualizaTabla();
                     });


                                        }
function AsociarDisco(){
    //var iid= $("SeleccionDiscoCombox").val;
    //alert(iid);
    $.post(
           base_url+"Controlador/addAsociarDisco",
            {
             id_disco:$("#SeleccionDiscoCombox").val(),
             rut:$("#SeleccionClienteCombobox").val()

           },function(datos){
               
             
            $("#msjAsociar").html("<h2 id='msjAsociar2'>"+datos.mensaje+"</h2>");
            $("#msjAsociar").fadeIn(100).delay(600).fadeOut(1000);
        },'json'

                    


            );


}
function salir(){
    $.post(base_url+"Controlador/salir",{},
    function(){
                validaLogin();
    });
    
}

function Asociar_disco_modal(){
    $.post(
            base_url+"Controlador/Asociar",{},
            function(pagina,datos){
                $("#addAsociacionModal").html(pagina,datos);                
               $("#addAsociacionModal").dialog({title:"Asociar Disco"});
               $("#addAsociacionModal").dialog("open");
            }    
            );
    
    
    
}

function loginBoton(){
    $.post(
            base_url+"Controlador/login",
    {usuario:$("#loginUsuario").val(),
    clave:$("#loginClave").val()},
    function(datos){
        if(datos.mensaje!=""){
            
            $("#msjLogin").html("<h5 id='menLog'>"+datos.mensaje+"</h5>");
            $("#msjLogin").fadeIn(100).delay(600).fadeOut(1000);
        }else{
            validaLogin();
           
            
        }
        
    },'json'
            
            
            
            );
    
    
}
function actualizaTabla(){
                        $.post(
                                base_url+"Controlador/actualizaTabla",{},
                        function(pagina,datos){
                         $("#divCRUD").html(pagina,datos);  
                          disenoBotones();
                          
                          
                          mensajes("Datos Actualizados Discos","Ok");
                          
                        });


                    }
function mostrarAsociado(){
    $.post(
            base_url+"Controlador/mostrarTabla",{},
            function(pagina,datos){
                $("#divMostrarAsociado").html(pagina,datos);
                 mensajes("Datos Actualizados Asociados","Ok");
            });
    
    
}
function verClientes(){
    $.post(
            base_url+"Controlador/mostrarClientes",{},
            function(pagina,datos){
                $("#divMostrarCliente").html(pagina,datos);
                diseno3();
                 mensajes("Datos Actualizados Clientes","Ok");
            });
    
    
}
function disenoBotones(){
    for(i=0; i<parseInt($("#oculto").val());i++){
        $("#editar"+i).button({
           icons:{secondary:"ui-icon-pencil"},
           text:false
        }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
      });
      
      $("#eliminar2"+i).button({
           icons:{secondary:"ui-icon-trash"},
           text:false
        }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
      });
      

    }  
    
}
function diseno2(){
   for(i=0; i<parseInt($("#oculto2").val());i++){
        $("#cancelarPedido"+i).button({
           icons:{secondary:"ui-icon-cancel"},
           text:false
        }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
      });
        
    } 
    
    
}
function diseno3(){
    for(i=0; i<parseInt($("#oculto3").val());i++){
       $("#editarCliente"+i).button({
           icons:{secondary:"ui-icon-pencil"},
           text:false
        }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
      });
      
      $("#eliminarCliente"+i).button({
           icons:{secondary:"ui-icon-trash"},
           text:false
        }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
      });
      
        
    } 
    
    
}
function eliminar2(id_disco2){
    $.post(
            base_url+"Controlador/eliminarDisco",
            {id_disco:id_disco2},
            function(){
                actualizaTabla();
 
           } );
}
function eliminarCliente(rut){
    $.post(
            base_url+"Controlador/eliminarCliente",
            {rut:rut},
            function(){
                location.reload();
            }
            );
}
function cancelarPedido(id_duplicaciones){
     $.post(
            base_url+"Controlador/cancelarPedido",
            {id_duplicaciones:id_duplicaciones},
            function(){
                location.reload();
                
           });
}           
function editar(id_disco){
    
   $.post(

            base_url+"Controlador/editarDisco",{},
            function(pagina,datos){
                $("#editarModal").html(pagina,datos);
                validaDiscoID(id_disco);
               $("#editarModal").dialog({title:"EDITAR DISCO"});
               $("#editarModal").dialog("open");
            }    

    );




}
function editarCliente(rut){
    
   $.post(

            base_url+"Controlador/editarCliente",{},
            function(pagina,datos){
               $("#editarClienteModal").html(pagina,datos); 
                validaRutClienteEdit(rut);
               $("#editarClienteModal").dialog({title:"EDITAR CLIENTE"});
               $("#editarClienteModal").dialog("open");
            }    

    );




}
function mensajes(msj,tipo){
    $("#mensajes").hide();
    $("#mensajes").html("<h3 id='actulizado' class='msj"+tipo+"'>"+msj+"</h3>");
    $("#mensajes").fadeIn(100).delay(600).fadeOut(1000);

}
function agregarCliente(){
    $.post(
            base_url+"Controlador/agregarCliente",{},
            function(pagina,datos){
               $("#addClienteModal").html(pagina,datos);
               $("#addClienteModal").dialog({title:"Agregar Nuevo Cliente"});
               $("#addClienteModal").dialog("open");
                
            });
    
}
function agregarDisco(){
    $.post(

            base_url+"Controlador/agregarDisco",
            {},
            function(pagina,datos){
               $("#addDiscoModal").html(pagina,datos);
               $("#addDiscoModal").dialog({title:"Agregar Nuevo Disco"});
               $("#addDiscoModal").dialog("open");
            }    

    );


}
function verDisco2(){
   
   actualizaTabla();
            
    
}

function addCliente(){
    $.post(
            base_url+"Controlador/addCliente",{
             rut:$("#addrutCliente").val(),   
             nombre:$("#addNombreCliente").val(),
             apellido:$("#addApellidoCliente").val(),
             direccion:$("#addDireccionCliente").val(),
             password:$("#addPasswordCliente").val(),
             telefono:$("#addTelefonoCliente").val(),
             correo:$("#addCorreoCliente").val()   
            },function(){}
            );
    
    
    
}
function addDisco(){
    $.post(
           base_url+"Controlador/addDisco",
            {
             id_disco:$("#addid_Disco").val(),
             nombre:$("#addnombre").val(),
             descripcion:$("#addDescripcion").val(),
             interprete:$("#addIntegrante").val(),
             fecha:$("#addFecha").val(),
             valor:$("#addValor").val() 

           },function(){
               actualizaTabla();
           }         


            );


}
function validaRutClienteEdit(rut){
    $.post(
            base_url+"Controlador/validaRutClienteEdit",
            {rut:rut},
            function(datos){
             $("#addrutClienteEdit").val(rut);     
             $("#addNombreClienteEdit").val(datos.nombre);     
             $("#addApellidoClienteEdit").val(datos.apellido);     
             $("#addDireccionClienteEdit").val(datos.direccion);     
             $("#addPasswordClienteEdit").val(datos.password); 
             $("#addcantidadReproduccionesEdit").val(datos.cantidadReproducciones);  
             $("#addTelefonoClienteEdit").val(datos.telefono);     
             $("#addCorreoClienteEdit").val(datos.correo);    
                            },'json');
    
}
function validaRutCliente(rut){
    $.post(
            base_url+"Controlador/validaRutCliente",
            {rut:rut},
            function(datos){
             $("#addrutCliente").val(rut);     
             $("#addNombreCliente").val(datos.nombre);     
             $("#addApellidoCliente").val(datos.apellido);     
             $("#addDireccionCliente").val(datos.direccion);     
             $("#addPasswordCliente").val(datos.password);     
             $("#addTelefonoCliente").val(datos.telefono);     
             $("#addCorreoCliente").val(datos.correo);    
                            },'json');
    
}
function validaDiscoID(id_disco2){
    $.post(
           base_url+"Controlador/validaIdDisco",
           {id_disco:id_disco2},
           function(datos){
             $("#addid_Disco").val(datos.id_disco);     
             $("#addnombre").val(datos.nombre_disco);
             $("#addDescripcion").val(datos.descripcion_disco);
             $("#addIntegrante").val(datos.interprete_disco);
             $("#addFecha").val(datos.fecha_disco);
             $("#addValor").val(datos.valor_disco);
           },'json'


            );


}
function cerrarTabla(){
  
document.getElementById('CrudDisco').style.display = 'none';
    
}
function cerrarTabla2(){
  
document.getElementById('Asocia').style.display = 'none';
    
}
function cerrarTabla3(){
document.getElementById('divMostraClientes').style.display = 'none';
    
}

//CLIENTE

function Cliente(){

$("#addPedido").button({
       icons:{secondary:"ui-icon-plus"},
       text:true       
   }).tooltip({
       position:{
           my:"left top",
           at:"right+5 top-5"           
       }
       
   });
   $("#cambioClave").button();
   $("#addPedidoModal").dialog({
       modal:true, autoOpen:false, width:500,
       buttons:{
           "Guardar Pedido":function(){
               $(this).dialog("close");
                addPedido();
                location.reload();
           }
           
       }
       
       
   });
   $("#cambioClaveModal").dialog({
           modal:true, autoOpen:false, width:440, 
            buttons:{
           "Guardar Clave Nueva":function(){
               $(this).dialog("close");  
                addUpdateClave();
           }
           
       } 
    }); 
     $("#addCambiarClaveModal").dialog({
           modal:true, autoOpen:false, width:440, 
            buttons:{
           "Guardar Clave Nueva":function(){
               $(this).dialog("close");  
                addUpdateClave();
           }
           
       } 
    }); 
  
   
}
function agregarPedido(){
    $.post(base_url+"Controlador/agregarPedido",{},
    function(pagina, datos){
          $("#addPedidoModal").html(pagina,datos);              
          $("#addPedidoModal").dialog({title:"AGREGAR PEDIDO NUEVO"});
          $("#addPedidoModal").dialog("open");
        
        
    }   
    );
    
    
}



function addPedido(){
     var can=document.getElementById("addCantidad").value;
     $.post(
            base_url+"Controlador/addPedido",{
             id_disco:$("#Seleccio").val(),   
             cantidad:can,
             fechaEntrega:$("#addFecha").val(),
             valorTotal:$("#addValor").val()             
            },function(){}
            );
}

function calculoValor(){
    var id =document.getElementById("Seleccio").value;
    var can=document.getElementById("addCantidad").value;
    $.post(base_url+"Controlador/calculoValor2",{
        id_disco2:id,
        cantidad2:can
    },
            function(datos){
              $("#addValor").val(datos.respuesta);   
                
            },'json'
    );
    
}

function cambioClave(){
    $.post(base_url+"Controlador/cambioClave",{},function(pagina){
        $("#cambioClaveModal").html(pagina);
        $("#cambioClaveModal").dialog({title:"CAMBIO CLAVE"});
        $("#cambioClaveModal").dialog("open");
    });
    
    
}


function verificaClave(){
    var clave=document.getElementById("claveActual").value;
    $.post(base_url+"Controlador/verificaClave",{
        clave:clave
    },
    function(datos){
        
        if (datos.respuesta2!="Clave Correcta") {
            $("#claveActual").val("");
            $("#addmensajeClave").html("<h6>"+datos.respuesta2+"</h6>");
            $("#addmensajeClave").fadeIn(100).delay(600).fadeOut(800);
            $("#claveActual").focus();
            //alert(datos.respuesta2);
        }
        
        
    },'json'
            );
}

function verificaClaveNueva(){
    var clave=document.getElementById("claveActual").value;
    var claveNueva=document.getElementById("addclaveNueva").value; 
    men="Clave Igual A La Actual";
    if (clave==claveNueva) {
        $("#addmensajeNuevaClave").html("<h6>"+men+"</h6>");
        $("#addmensajeNuevaClave").fadeIn(100).delay(600).fadeOut(800);
        $("#addclaveNueva").val("");
        $("#addclaveNueva").focus();
    }
    
    
}
function verificaConfimaClave(){
    var claveNueva=document.getElementById("addclaveNueva").value;
    var claveCon=document.getElementById("addclaveConfirmar").value;
    $.post(base_url+"Controlador/verificaConClave",{
        claveNueva:claveNueva,
        claveCon:claveCon
    },
    function(datos){
        
        if (datos.respuesta2!="Clave Correcta") {
            $("#addclaveNueva").val("");
            $("#addclaveConfirmar").val("");
            $("#addmensajeConClave").html("<h6>"+datos.respuesta2+"</h6>");
            $("#addmensajeConClave").fadeIn(100).delay(600).fadeOut(800);
            $("#addclaveNueva").focus();
            $("#checkCambio").prop('checked', false);
            //alert(datos.respuesta2);
        }
        
        
            },'json'
            );
    
}

function addUpdateClave(){
     var claveNueva=document.getElementById("addclaveNueva").value;    
     var check=document.getElementById("checkCambio").checked;
     alert(check);
     $.post(
            base_url+"Controlador/addUpdateClave",{             
             claveNueva:claveNueva,
             check:check             
            },function(datos){
                $("#mensajesA").html("<h2>"+datos.respuesta2+"</h6>");
                $("#mensajesA").fadeIn(100).delay(600).fadeOut(800);
                location.reload();
            },'json'
            );
}