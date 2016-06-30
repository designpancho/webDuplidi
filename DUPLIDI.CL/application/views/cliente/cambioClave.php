<div id="cambioCla">
    <table>
        <tr>
            <td>Clave Actual</td>
            <td>: <input type="password" id="claveActual" onblur="verificaClave(this.value)" placeholder="clave actual..."></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="addmensajeClave"></div></td>
        </tr>
        <tr>
            <td>Clave Nueva</td>
            <td>: <input type="text" id="addclaveNueva" onblur="verificaClaveNueva(this.value)" placeholder="clave nueva..."></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="addmensajeNuevaClave"></div></td>
        </tr>
        <tr>
            <td>Confirme Clave</td>
            <td>: <input type="text" id="addclaveConfirmar"  onblur="verificaConfimaClave(this.value)" placeholder="confirmar clave..."></td>
        </tr>
        <tr>
            <td></td>
            <td><div id="addmensajeConClave"></div></td>
        </tr>
        <tr>
            <td colspan="2"><input type="checkbox" id="checkCambio"  value="Acepta">Acepta Cambio</td>
            
        </tr>
    </table>
    
</div>