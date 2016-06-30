<h4>Asociar Disco-Cliente</h4>
<table>
    <tr>
        <td>Cliente</td>
        <td>:
             <select id="SeleccionClienteCombobox">	
                 <option selected value="0">Seleccione Cliente</option>
                     <?php foreach($cliente2 as $valor2):?>
                    <option value="<?php echo $valor2->rut;?>"><?php echo $valor2->nombre?></option>

                    <?php endforeach?>
             </select>
        </td>
        
         <td>Disco</td>

        <td>: 
            <select id="SeleccionDiscoCombox">	
            <option selected value="0">Seleccione Disco</option>
             
                     <?php foreach($resultado2 as $valor):?>
                    <option value="<?php echo $valor->id_disco;?>"><?php echo $valor->nombre_disco?></option>

                    <?php endforeach?>
                     
         
            </select> 
        </td>
    </tr>
   
</table>
<div id="msjAsociar"></div>