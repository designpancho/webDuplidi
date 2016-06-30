
<div id="AdmPrin">
    <h3 id="nombreUsuario">hola adm <?php echo $nombre?></h3>
        <div id="menuAdm">
            <button id="verDisco" >Ver Disco</button>
            <button id="verCliente" >Ver Clientes</button> 
            <button id="verAsociado" >Ver Asociados</button>
            <button id="cambioClave" onclick="cambioClave()" >cambiar Clave</button> </br>
            <button id="addDisco" onclick="agregarDisco()">Agregar Disco</button>            
            <button id="addCliente" onclick="agregarCliente()">Agregar Cli.</button>
            <button id="Asociar_disco" >Asociar Disco</button>
            <button id="btnCerrar">Cerrar Session</button>
        </div>     
            
            <div id="addDiscoModal" ></div>            
            <div id="cambioClaveModal" ></div>
            <div id="addClienteModal" ></div>
            <div id="addAsociacionModal" ></div>
            <div id="divCRUD"></div>
            <div id="divMostrarAsociado"></div>
            <div id="divMostrarCliente"></div>
            <div id="mensajes"></div>
            <div id="msjAsociar"></div>
            <div id="editarModal"></div>
            <div id="editarClienteModal"></div>
            <div id="mensajesA"></div>
</div>
<div id="divComprasRealizadas">
<?php if($cantidad==0):?>
        <p>No Hay Compras Realizadas</p>
<?php else:?>
        <table id="tabla">
            <caption>PEDIDOS</caption>
            <th>ID DISCO</th>
            <th>NOMBRE DISCO</th>
            <th>NOMBRE CLIENTE</th>
            <th>CANTIDAD</th>
            <th>FECHA PEDIDO</th>
            <th>FECHA ENTREGA</th>
            <th>VALOR TOTAL</th>
            <th>CANCELAR</th>
            
            
            <?php $i=0; foreach ($pedidos as $fila):?>
            <tr>
                <td><?php echo $fila->id_duplicaciones?></td>
                <td><?php echo $fila->nombre_disco?></td>
                <td><?php echo $fila->nombre?></td>
                <td><?php echo $fila->cantidad?></td>
                <td><?php echo $fila->fecha_pedido?></td>
                <td><?php echo $fila->fecha_entrega?></td>
                <td><?php echo $fila->valor_total?></td>
                <td>
                    <button id="cancelarPedido<?php echo $i?>" onclick="cancelarPedido(<?php echo $fila->id_duplicaciones?>);">CANCELAR</button>
                </td>
                
            </tr>
            <?php $i++; endforeach;?>
        </table>       
        
<?php endif;?>

        <input type="hidden" id='oculto2' value='<?php echo $i?>'/> 
</div>
