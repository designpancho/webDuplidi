<div id="Asocia">
<?php if($cantidad==0):?>
        <p>NO HAY DISCO ALMACENADO</p>
<?php else:?>
        <table id="tabla">
            <caption>Asociaciones</caption>
            <th>Codigo</th>
            <th>Nombre Cliente</th>
            <th>Nombre Disco</th>
           
            <?php $i=0; foreach ($Asociado as $fila):?>
            <tr>
                <td><?php echo $fila->id_disco_cliente?></td>
                <td><?php echo $fila->nombre?></td>
                <td><?php echo $fila->nombre_disco?></td>
               
            </tr>
            <?php $i++; endforeach;?>
            <th colspan="8" align="center"><a onclick="cerrarTabla2()">CERRAR TABLA</a></th>
        </table>       
        
<?php endif;?>

        <input type="hidden" id='oculto' value='<?php echo $i?>'/>        
</div>