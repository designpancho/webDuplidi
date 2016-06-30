<div id="cliPrin"><h3 id="nombreUsuario">hola cliente <?php echo $nombre?></h3>
    <h3 id="nombreUsuario">Reproducciones <?php echo $cantidadReproducciones?></h3>
            <button id="addPedido" onclick="agregarPedido()">REALIZAR PEDIDO</button>
            <button id="cambioClave" onclick="cambioClave()">CAMBIAR CLAVE</button>
            <button id="btnCerrar">Cerrar Session</button>
            <div id="addPedidoModal" ></div>
             <div id="cambioClaveModal"></div>
             <div id="mensajesA"></div>
</div>
<div id="divComprasRealizadas">
<?php if($cantidad==0):?>
        <p>No Hay Compras Realizadas</p>
<?php else:?>
        <table id="tabla">
            <caption>COMPRAS REALIZADAS</caption>
            
            <th>NOMBRE DISCO</th>
            <th>CANTIDAD</th>
            <th>FECHA ENTREGA</th>
            <th>VALOR TOTAL</th>
            
            
            <?php $i=0; foreach ($Compras as $fila):?>
            <tr>
                
                <td><?php echo $fila->nombre_disco?></td>
                <td><?php echo $fila->cantidad?></td>
                <td><?php echo $fila->fecha_entrega?></td>
                <td><?php echo $fila->valor_total?></td>
                
                
            </tr>
            <?php $i++; endforeach;?>
        </table>       
        
<?php endif;?>

        <input type="hidden" id='oculto' value='<?php echo $i?>'/> 
</div>