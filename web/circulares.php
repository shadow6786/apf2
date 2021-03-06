<?php 
@session_start();
include_once('../_UTL/seguridad.php');
include_once("../_BRL/tipocirculares.ext.php");
include_once("../_BRL/circulares.ext.php");
include_once("../_BRL/gestiones.ext.php");

$objtipocirculares = new ctipocirculares_ext;
$objcirculares = new ccirculares_ext;
$objgestiones = new cgestiones_ext;

$circulares = array();
$gestiones = $objgestiones->get_gestiones_activas();

$err = "";
$id = 0;

if(isset($_GET["tipo"]) && (int)$_GET["tipo"] > 0){
    $id = $_GET["tipo"];
    $tipocirculares = $objtipocirculares->get_tipo_circular($id);
    if(count($tipocirculares)> 0){
        if($tipocirculares[0]["requiere_login"] == 0)
        {
            $circulares = $objcirculares->get_circulares_tipo($id);
            if(count($circulares) == 0){
                $err = "No se encuentran Items.";
            }
        }
        else{
            if(isset($_SESSION['usrlogin']))
            {
                $seguridad = unserialize($_SESSION['usrlogin']);
                if($tipocirculares[0]["rol_tcc"] == $seguridad->rol || $seguridad->rol == 1){

                }
                else{
                    $err = "Tus permisos no son suficientes para ver los items<br>contactate con un administrador.";
                }
            }
            else{
                header("LOCATION: login.php");
            }
        }
    }
    else{
        $err = "No se encuentran Items.";
    }
}
else
{
    $err = "Selecione una opci&oacute;n valida.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Asociacion Padres de Familia Colegio Aleman S.C.</title>
<?php include_once("../web/_includes/archivos.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
</head>
<body>
<div id="page">
    <div class="container">
        <?php include_once("../web/_includes/banner.php");?>
        <?php include_once("../web/_includes/menu.php");?>
        <?php include_once("../web/_includes/barras_laterales.php");?>
        <div class="maincontent">            
            <div class="content">
            	<h3 class="no-space">CIRCULARES</h3>
                <?php 
                    if(strlen($err) > 0){ ?>
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="icon-exclamation-sign"></i></strong> <?php echo $err; ?>
                        </div>
                    <?php }
                    else{ ?>
                        <br>
                        <input type="hidden" id="tipo" value="<?php echo $id; ?>" />
                        <div class="margin-bottom-20">
                            <div class="control-group">
                                <label class="control-label" for="gestion">Gesti&oacute;n<span class="required">*</span></label>
                                <div class="controls">
                                    <select id="gestion" type="text" name="gestion" class="span2">
                                        <?php if(!is_null($gestiones)){
                                            foreach ($gestiones as $key => $value) {
                                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="circulares_lista"></div>
                    <?php }
                ?>
 			</div>
            <div class="clear"></div>
        </div>
    </div>
    <?php include_once("../web/_includes/footer.php");?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var gest = $("#gestion").val();
        var tip = $("#tipo").val();
        if(parseInt(gest) > 0 && parseInt(tip) > 0)
        {
            get_circulares(gest,tip);
        }
        $("#gestion").change(function(event){
            event.preventDefault();
            var gestion = $("#gestion").val();
            var tipo = $("#tipo").val();
            get_circulares(gestion,tipo);
        });
    });
</script>
</body>
</html>