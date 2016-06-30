<div id="divMostraClientes">
<?php if($cantidad==0):?>
        <p>No Hay Compras Realizadas</p>
<?php else:?>
        <table id="tabla">
            <caption>CLIENTE</caption>
            
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>DIRECCION</th>
            <th>PASSWORD</th>
            <th>CANT. REP.</th>
            <th>TELEFONO</th>
            <th>CORREO</th>
            <th>EDITAR</th>
            <th>ELIMINAR</th>
            
            
            <?php $i=0; foreach ($Clientes as $fila):?>
            <tr>
                
                <td><?php echo $fila->rut?></td>
                <td><?php echo $fila->nombre?></td>
                <td><?php echo $fila->apellido?></td>
                <td><?php echo $fila->direccion?></td>
                <td><?php echo $fila->password?></td>
                <td><?php echo $fila->cantidadReproducciones?></td>
                <td><?php echo $fila->telefono?></td>
                <td><?php echo $fila->correo?></td>
                <td>
                    <button id="editarCliente<?php echo $i?>" onclick="editarCliente(<?php echo $fila->rut?>);">EDITAR</button>
                </td>
                <td>
                    <button id="eliminarCliente<?php echo $i?>" onclick="eliminarCliente(<?php echo $fila->rut?>);">ELIMINAR</button>
                </td>
                
            </tr>
            <?php $i++; endforeach;?>
             <th colspan="10" align="center"><a onclick="cerrarTabla3()">CERRAR TABLA</a></th>
        </table>       
        
<?php endif;?>

        <input type="hidden" id='oculto3' value='<?php echo $i?>'/>
        
</div>