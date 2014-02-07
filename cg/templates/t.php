[#prefixtable]
Y
[#tablenp]
**!
<parameter>
	<vartype>
	DEF
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='text' id='[#field]' name='[#field]' value='' [#req] size='[#size]' maxlength='[#size]'></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='text' id='[#field]' name='[#field]' value='<?php echo $obj[#tablenp]->[#field] ?>' [#req] size='[#size]' maxlength='[#size]'></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$obj[#tablenp]->filtros[[#ct++]]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$obj[#tablenp]->filtros[[#ct++]]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$obj[#tablenp]->filtros[[#ct++]]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	MUL
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('[#fkclass]','[#fkpk]','[#fkprimercampo]','','[#field]',''); ?></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><?php echo HacerCombo('[#fkclass]','[#fkpk]','[#fkprimercampo]',$obj[#tablenp]->[#field],'[#field]',''); ?></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    </select>
            	</td>
            	<td> <?php echo HacerCombo('[#fkclass]','[#fkpk]','[#fkprimercampo]',$obj[#tablenp]->filtros[[#ct++]]["Valor"],'[#field]_valor',''); ?></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php if(array_key_exists($userRow["[#field]"],$vfk[#fkclass])) { echo $vfk[#fkclass][$userRow["[#field]"]]; } else { echo  $userRow["[#field]"];} ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	varchar(1)
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input id="[#field]" name="[#field]" type="checkbox" value="S" /></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input name="[#field]" type="checkbox" id="[#field]" value="S" <?php if($obj[#tablenp]->[#field] == "S") {echo 'checked="checked"';}  ?> /></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    </select>
            	</td>
            	<td>
                <select name="[#field]_valor" id="[#field]_valor" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="S" <?php ObtenerSeleccionFiltro("S",$obj[#tablenp]->filtros[[#ct++]]); ?>>S&iacute;</option>
                    <option value="N" <?php ObtenerSeleccionFiltro("N",$obj[#tablenp]->filtros[[#ct++]]); ?>>No</option>
                </select></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php if($userRow["[#field]"] == 'S') { echo "<input name='x' type='checkbox' disabled value='x' checked />"; } else { echo "<input name='x' type='checkbox' disabled value='x' />"; } ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : 'N';
    </code>
</parameter>
<parameter>
	<vartype>
	text
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><textarea name="[#field]" cols="50" rows="10" id="[#field]" [#req]></textarea></td>
      </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><textarea name="[#field]" cols="50" rows="10" id="[#field]" [#req]><?php echo $obj[#tablenp]->[#field] ?></textarea></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$obj[#tablenp]->filtros[[#ct++]]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$obj[#tablenp]->filtros[[#ct++]]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$obj[#tablenp]->filtros[[#ct++]]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	date
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#[#field]" ).datepicker({
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='[#field]' name='[#field]' value='' [#req] size='20' ></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#[#field]" ).datepicker({
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='[#field]' name='[#field]' value='<?php echo $obj[#tablenp]->[#field] ?>' [#req] size='20' ></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$obj[#tablenp]->filtros[[#ct++]]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$obj[#tablenp]->filtros[[#ct++]]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	time
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#[#field]" ).timepicker({
        button: '.timepicker_button_trigger_[#field]'
});

	});
	</script><input type='text' id='[#field]' name='[#field]' value='' [#req] size='20' ><div class="timepicker_button_trigger_[#field]" style="width: 16px; height:16px; background: url(../css/redmond/images/ui-icons_2e83ff_256x240.png) -80px, -96px;
                    display: inline-block; border-radius: 2px; border: 1px solid #222222; margin-top: 3px; cursor:pointer"></div></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#[#field]" ).timepicker({});

	});
	</script><input type='text' id='[#field]' name='[#field]' value='<?php echo $obj[#tablenp]->[#field] ?>' [#req] size='20' ></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$obj[#tablenp]->filtros[[#ct++]]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$obj[#tablenp]->filtros[[#ct++]]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	datetime
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
		$( "#[#field]" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
		
	});
	</script><input type='text' id='[#field]' name='[#field]' value='' [#req] size='20' ></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><script>
	$(function() {
			$( "#[#field]" ).datetimepicker({
			addSliderAccess: true,
			sliderAccessArgs: { touchonly: false },
			showOn: "button",
			buttonImage: "../img/calendar.gif",
			buttonImageOnly: true
		});
	});
	</script><input type='text' id='[#field]' name='[#field]' value='<?php echo $obj[#tablenp]->[#field] ?>' [#req] size='20' ></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >hoy</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto de hoy</option>
                    <option value="<" <?php ObtenerSeleccionFiltro("<",$obj[#tablenp]->filtros[[#ct++]]); ?>>antes de</option>
                    <option value=">" <?php ObtenerSeleccionFiltro(">",$obj[#tablenp]->filtros[[#ct++]]); ?>>despues de</option>                                        
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	longtext
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><textarea name="[#field]" cols="50" rows="10" id="[#field]" class="wysiwyggen"></textarea> <?php include("../_UTL/wysiwyg.php"); ?>
        
		<script type="text/javascript">
		$(function(){
			
			$('#[#field]').elrte(opts);

                            });
                            </script></td>
           
      </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><textarea name="[#field]" cols="50" rows="10" id="[#field]" class="wysiwyggen"><?php echo $obj[#tablenp]->[#field] ?></textarea> <?php include("../_UTL/wysiwyg.php"); ?>
        
		<script type="text/javascript">
		$(function(){
			
			$('#[#field]').elrte(opts);

                            });
                            </script></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$obj[#tablenp]->filtros[[#ct++]]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$obj[#tablenp]->filtros[[#ct++]]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$obj[#tablenp]->filtros[[#ct++]]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    </precode>
    <code>
	    $obj[#tablenp]->[#field]  = (isset($_POST['[#field]'])) ? $_POST['[#field]'] : '';
    </code>
</parameter>
<parameter>
	<vartype>
	varchar(135)
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='file' id='[#field]' name='[#field]'></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='file' id='[#field]' name='[#field]'></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$obj[#tablenp]->filtros[[#ct++]]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$obj[#tablenp]->filtros[[#ct++]]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$obj[#tablenp]->filtros[[#ct++]]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    // inicio image upload	
				
                @mkdir("../imagenes_[#field]");
                
                if($_FILES['[#field]']['name'] !="")
				{
					SubirImagen($_FILES['[#field]'],"../imagenes_[#field]","1000",1000,1000,true,240,240);
				}
								
				if($id > 0)
				{
					$obj[#tablenp]->[#pk] = $id;
					$obj[#tablenp]->ObtenerUnRegistro();
					if($_FILES['[#field]']['name'] !="")
					{ 
					  $obj[#tablenp]->[#field] =  date('Ymd'). '-' . limpiarNombreArchivo($_FILES['[#field]']['name']);
					}
				}
				else
				{
					$obj[#tablenp]->[#field] =  date('Ymd'). '-'.limpiarNombreArchivo($_FILES['[#field]']['name']);	
				}
	// fin image upload
    </precode>
    <code>
    </code>
</parameter>
<parameter>
	<vartype>
	varchar(136)
	</vartype>
	<formfieldi>
       <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='file' id='[#field]' name='[#field]'></td>
        </tr> 
	</formfieldi>
	<formfieldu>
	    <tr> 
            <td class='rs_fila_nombrecolumna_form'>[#label]</td> 
            <td class='rs_filas_campo_form'><input type='file' id='[#field]' name='[#field]'></td>
        </tr> 
	</formfieldu>
	<filterfield>
		 	<tr>
            	<td>[#label]</td>
            	<td><select name="[#field]_relacion" onChange="VaciarValor(this.form, '[#field]_relacion' ,'[#field]_valor')">
                	<option value=""></option>
                    <option value="=" <?php ObtenerSeleccionFiltro("=",$obj[#tablenp]->filtros[[#ct++]]); ?> >igual</option>
                    <option value="!=" <?php ObtenerSeleccionFiltro("!=",$obj[#tablenp]->filtros[[#ct++]]); ?>>distinto</option>
                    <option value="like" <?php ObtenerSeleccionFiltro("like",$obj[#tablenp]->filtros[[#ct++]]); ?>>contiene</option>
                    <option value="like_ini" <?php ObtenerSeleccionFiltro("like_ini",$obj[#tablenp]->filtros[[#ct++]]); ?>>comienza con</option>
                    <option value="like_fin" <?php ObtenerSeleccionFiltro("like_fin",$obj[#tablenp]->filtros[[#ct++]]); ?>>termina con</option>
                </select>
            	</td>
            	<td><input name="[#field]_valor" value="<?php echo $obj[#tablenp]->filtros[[#ct++]]["Valor"]; ?>" /></td>
            </tr>
	</filterfield>
    <formfieldsh>
	    <td class='rs_filas'><?php echo $userRow["[#field]"]; ?></td>
    </formfieldsh>
    <precode>
    // inicio file upload	
				
                @mkdir("../archivos_[#field]");
                
                if($_FILES['[#field]']['name'] !="")
				{
					SubirArchivo($_FILES['[#field]'],"../archivos_[#field]","8184");
				}

				if($id > 0)
				{
					$obj[#tablenp]->[#pk] = $id;
					$obj[#tablenp]->ObtenerUnRegistro();
					if($_FILES['[#field]']['name'] !="")
					{ 
					  $obj[#tablenp]->[#field] =  date('Ymd'). '-' . limpiarNombreArchivo($_FILES['[#field]']['name']);
					}
				}
				else
				{
					$obj[#tablenp]->[#field] =  date('Ymd'). '-'.limpiarNombreArchivo($_FILES['[#field]']['name']);	
				}
	// fin file upload
    </precode>
    <code>
    </code>
</parameter>
!**
<?php
[#mainlabel]

@session_start(); 

include_once("../_BRL/[#tablenp].ext.php");
include_once("../_UTL/funcionesUI.php");
include_once("../_UTL/inc_seguridad.php");
include_once("../_UTL/funcionesARCHIVOS.php");

//Isntancia del Objeto
$obj[#tablenp]=new c[#tablenp]_ext;

//Los filtros que se apliquen a la seleccion se guardan en la sesi&oacute;n
if (isset($_SESSION['[#tablenp]_filtro']))
{
	$obj[#tablenp]->filtros = $_SESSION['[#tablenp]_filtro'];
}
//Las acciones pueden ser: editar, nuevo, filtrar, guardar o borrar. Seg&uacute;n el valor se mostrar&uacute;n los formularios correspondientes  
$accion = '';
if (isset($_GET['accion'])) 
{  
	$accion = $_GET['accion']; 
}

[#mostrarvalordefk]

//Id es el arhivo que se edita
$id = '';
if (isset($_GET['id'])) 
{  
	$id = $_GET['id']; 
}

//pag es la p&aacute;gina actual que se est&aacute; visualizando. Inicia en 0
$pag = 0;
if (isset($_GET['pag'])) 
{  
	$pag = $_GET['pag']; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>[#tablenp]</title>
        <link type="text/css" href="../css/redmond/jquery-ui-1.8.14.custom.css" rel="stylesheet" />	
		<script type="text/javascript" >
        txtval = new String(top.location);
		
		if(txtval.search('frameset.php') < 0)
		{
			window.open('../frameset.php?u='+top.location,'_top');
		}
     
        </script>
        <script type="text/javascript" src="../js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.14.custom.min.js"></script>
        <link rel="stylesheet" href="../css/mgEstiloAdmin.css" type="text/css">
        <script src="../js/jquery.paginate.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.metadata.js"></script>
        <script language="JavaScript" src="../js/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/paginacion.css" media="screen"/>
	
		<!--TIMEPICKER-->
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-timepicker.css" media="screen"/>
        <script language="JavaScript" src="../js/jquery.ui.timepicker.js"></script>
        
        <script type="text/javascript">
		$(function(){
			$('ul#icons li, #boton_editar, #boton_borrar').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
			);
			
			// Dialog			
			$('#sector_filtros').dialog({
			autoOpen: false,
			width: 400,
			buttons: {
			"Ok": function() { 
			document.getElementById('form_filtrar').submit();
			$(this).dialog("close"); 
			}, 
			"Cancel": function() { 
			$(this).dialog("close"); 
			} 
			}
			});
			
			// Dialog Link
			$('#boton_filtro').click(function(){
			$('#sector_filtros').dialog('open');
			return false;
			});
			
			// Tabs
			$('#tabs').tabs();
	
		});
		
		
		function VaciarValor(form, campo1, campo2)
		{
			if (form.elements[campo1].value == "")
			{	
			form.elements[campo2].value = "";
			}
		}
		
		
		$(document).ready(function(){

		$('#boton_guardar_validar').click(function() {

		 $('#form_editar_[#tablenp]').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_editar_[#tablenp]').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
	

		$('#boton_insertar_validar').click(function() {
		 $('#form_insertar_[#tablenp]').submit();
		 // $('.wysiwyggen').elrte('updateSource');
		 // Uncomment in case of WYSIWYG
		}); 
		
		$('#form_insertar_[#tablenp]').validate({
			 submitHandler: function(form) {
				 form.submit();
			 }
		});
		
		});
		
		</script>
        <script language="JavaScript" src="../js/datetimepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/datetimepicker.css"/>
        
    </head>
    <body>
    <div id="titulo_pagina">Gesti&oacute;n de [#tablenp]</div>
   	<?php 
	switch ($accion) 
	{
		case "editar":
		{
			//Muestra el formulario para editar un registro espec&iacute;fico, el de la variable $id
			$obj[#tablenp]->[#pk] = $id;
			$obj[#tablenp]->ObtenerUnRegistro();
	?>
    <!-- Formulario Actualizaci&oacute;n de Registros -->
    <form method='post' name="form_editar_[#tablenp]" id="form_editar_[#tablenp]" action='?accion=guardar&id=<?php echo $id ?>&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = '[#tablenp].php?pag=<?php echo $pag ?>'" href="#">
                    <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Cancelar
                </a>
            </li>
             <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" id="boton_guardar_validar" href="#">
                    <span class="ui-icon ui-icon-disk"></span>Aceptar
                </a>
            </li>
        </ul>
    </div>
    <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Editar</a></li>
    </ul>
    <div id="tabs-1">
        <table  cellpadding="0" cellspacing="1" class="table_editar" > 
            
            <tr> 
                <td class='rs_fila_nombrecolumna_form'>Id</td> 
                <td class='rs_filas_campo_form'><?php echo $obj[#tablenp]->[#pk] ?></td>
            </tr> 
            [!
    [#formfieldu]
            !]
            <tr> 
                <td class='rs_fila_nombrecolumna_form'>&Uacute;ltima Modificaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosModificacionRegistro($obj[#tablenp]->fechahora_mod, $obj[#tablenp]->usuario_mod); ?></td>
            </tr> 
             <tr> 
                <td class='rs_fila_nombrecolumna_form'>Creaci&oacute;n</td> 
                <td class='rs_filas_campo_form'><?php echo ObtenerDatosCreacionRegistro($obj[#tablenp]->fechahora_ins, $obj[#tablenp]->usuario_ins); ?></td>
            </tr> 
            
        </table>
    	</div>
      </div>
    </form>
    <script type="text/javascript" > document.getElementById("[#1stfield]").focus(); </script>
    <!-- Fin Formulario Actualizaci&oacute;n de Registros -->
      </body>
</html>
	<?php
			exit;
		}
		case "nuevo":
		{
			//Abre le formulario para insertar un nuevo regsitro
		?>
        
    <!-- Formulario Inserci&oacute;n Registros -->
    <form method='post' name="form_insertar_[#tablenp]" id="form_insertar_[#tablenp]" action='?accion=guardar&pag=<?php echo $pag ?>' enctype='multipart/form-data'>
    <div id="opcionesmenu_registros">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
            <li class="ui-state-default ui-corner-all">
                <a class="dialog_link" onClick="window.location = '[#tablenp].php?pag=<?php echo $pag ?>'" href="#">
                    <span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Cancelar
                </a>
            </li>
             <li class="ui-state-default ui-corner-all">
                <a class="dialog_link"  id="boton_insertar_validar" href="#">
                    <span class="ui-icon ui-icon-disk"></span>Aceptar
                </a>
            </li>
        </ul>
    </div>
     <div id="tabs">
    <ul>
        <li><a href="#tabs-1">Nuevo</a></li>
    </ul>
    <div id="tabs-1">
    
        <table  cellpadding="0" cellspacing="0" class="table_agregar" > 
         
    [!
    [#formfieldi]
    !]
          
        </table>
    </div>
    
    </div>
    </form>
    <script type="text/javascript" > document.getElementById("[#1stfield]").focus(); </script>
    <!-- Fin Formulario Inserci&oacute;n Registros -->
      </body>
</html>
	<?php
			exit;
		}
		case "filtrar":
		{
			//Crea un array con los valores de los filtros, lo pasa a la clase y lo almacena en la sesi&oacute;n.
			try
			{
				$filtro =  array( 
					[!
					array("Campo" => "[#field]", "Relacion" => $_POST['[#field]_relacion'], "Valor" => $_POST['[#field]_valor']),
					!]
					""
					); 
				$obj[#tablenp]->filtros = $filtro;
				$_SESSION['[#tablenp]_filtro'] = $filtro;
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			break;
		}
		case "guardar":
		{
			//Inserta o Actualiza un registro en la base de Datos. Dependiendo si la variable $id es mayor a 0 hace una actualizaci&oacute;n, caso contrario una inserci&oacute;n
			try
			{
				[!
				[#precode]
				!]
				
				[!
				[#code]
				!]				

				$obj[#tablenp]->usuario_mod = $seguridad->personaid;

				if ($id > 0)
				{
					//Esto es una actualizaci&oacute;n de datos
					$obj[#tablenp]->[#pk] = $id;
					$obj[#tablenp]->actualizar();	
				}
				else
				{
					//Esto es una inserci&oacute;n de datos
					$obj[#tablenp]->usuario_ins = $seguridad->personaid;
					$obj[#tablenp]->insertar();
				}
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}
			$obj[#tablenp]->VaciarVariables();
			break;
		}
		case "borrar":
		{
		   //Borra un regsitro por su llave primaria, el almacenado en la variable $id.
			try
			{
				$obj[#tablenp]->[#pk] =  $id;	
				$obj[#tablenp]->borrar();
			}
			catch(Exception $e)
			{
				echo ImprimirError($e);
				exit;
			}	
			$obj[#tablenp]->VaciarVariables();
			break;	
		}
	}
	//Buscar aplica el filtro que se haya podido establecer en la sesi&oacute;n.
	
        $rs = $obj[#tablenp]->buscararr($pag); 
	
	?>
        <!-- Botonera Listados de Regsitros -->
         <div id="opcionesmenu_registros">
         	<ul id="icons" style="float:right" class="ui-widget ui-helper-clearfix">
            	<li class="ui-state-default ui-corner-all">
                    <a class="dialog_link" id="boton_filtro"  href="#">
                        <span class="ui-icon ui-icon-wrench"></span>Filtros 
                    </a>
                </li>
               
                <li class="ui-state-default ui-corner-all">
                    <a class="dialog_link" href="?accion=nuevo&pag=<?php echo $pag ?>">
                        <span class="ui-icon ui-icon-document"></span>Nuevo Registro
                    </a>
                </li>
            </ul>
        	<div id="sector_totalregistros">
         	 <?php  ?>
            	
            Registros: <?php echo $obj[#tablenp]->totalfilas; 
			if ($obj[#tablenp]->totalfilas != $obj[#tablenp]->totalfilasfiltradas)
			echo " / Filtrados: ". $obj[#tablenp]->totalfilasfiltradas;
			?> 
         	</div>
        </div>
        <!-- Fin Botonera Listados de Regsitros -->
        
        <!-- Listado de Registros -->
        <div>
       
        </div>
        <?php  
        
        if ( $obj[#tablenp]->totalfilasfiltradas > 0)
			{ ?>
            <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all" >
			
           <table cellpadding="0" cellspacing="1" class="table_lista">
            <tr class="ui-tabs-nav ui-helper-reset  ui-widget-header ui-corner-all">
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'></th>
              <th class='rs_fila_nombrecolumna'>Id</th>
              [!
              <th class='rs_fila_nombrecolumna'>[#label]</th>
              !]
            </tr>
            <?php 
            
          
				foreach($rs as $userRow) 
				{  ?>
				<tr>
				  <td class='rs_fila_editar' width="1%">
				   <a id="boton_editar" class="ui-state-default ui-corner-all" href="?accion=editar&id=<?php echo $userRow["[#pk]"]; ?>&pag=<?php echo $pag ?>">
				   <span class="ui-icon ui-icon-pencil"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas_eliminar' width="1%">
				  <a id="boton_borrar" class="ui-state-default ui-corner-all" href="?accion=borrar&id=<?php echo $userRow["[#pk]"]; ?>&pag=<?php echo $pag ?>" onClick="return confirm('&iquest;Est&aacute; seguro que desea eliminar el registro con Id: <?php echo $userRow["[#pk]"]; ?>?')">
				  <span class="ui-icon ui-icon-trash"></span>&nbsp;</a>
				  </td>
				  <td class='rs_filas' width="1%"><?php echo $userRow["[#pk]"]; ?></td>
				  [!
                  [#formfieldsh]
				  !]
                </tr>
            <?php } ?>
			
			
          </table>    
            <br/> 
             <!-- Paginaci&oacute;n -->
        <div id="paginacion"></div>
        <!-- Fin Paginaci&oacute;n -->    
       
			</div>
          
              
          <?php 
          }
		?>
        <!-- Fin Listado de Registros -->
        
       
		<!-- Dialogo Filtro -->
		<div id="sector_filtros" title="Filtro">
			<form  method='post' id="form_filtrar"  name="form_filtrar"  action='?accion=filtrar' enctype='multipart/form-data'>
            <table cellpadding="0" cellspacing="1" class="table_filtro">
        [!
[#formfieldf]
		!]
            </table>
        </form>
		</div>
		<!-- Fin Dialogo Filtro -->
         <?php if ($obj[#tablenp]->totalfilas > 20 )  
		{ ?>


         <script type="text/javascript">
		$(function(){
		
			$("#paginacion").paginate({
			count 		: <?php echo ceil (($obj[#tablenp]->totalfilasfiltradas / 20)) ; ?>,
			start 		: <?php if ($pag==0) { echo '1';} else {echo $pag;} ?>,
			display     : 10,
			border					: true,
			border_color			: '#fff',
			text_color  			: '#fff',
			background_color    	: '#666666',	
			border_hover_color		: '#ccc',
			text_hover_color  		: '#000',
			background_hover_color	: '#fff', 
			images					: false,
			mouse					: 'press',
			onChange     			: function(page){ window.location = "?pag=" + page; }
			});
		});
				
			
		</script> <?php } ?>
        
  </body>
</html>