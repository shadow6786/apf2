<?php 
include_once("../_BRL/tipocirculares.ext.php");
$objtipocirculares = new ctipocirculares_ext;

$tipocirculares = $objtipocirculares->get_tipo_circulares();
?>
<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="login.php">APF</a>
		<ul class="nav">
			<li id="m_quienessomos"><a href="index.php">Quienes Somos</a></li>
			<li id="m_directorio"><a href="directorio.php">Directorio</a></li>
			<li id="m_estatutos"><a href="estatutos.php">Estatutos y Reglamentos</a></li>
			<li class="dropdown" id="m_circulares">
				<a id="circulares" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Circulares</a>
				
				<ul class="dropdown-menu" role="menu" aria-labelledby="circulares">
					<?php if(count($tipocirculares) > 0){
						foreach ($tipocirculares as $circulares) { ?>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="circulares.php?tipo=<?php echo $circulares["id_tcc"]; ?>"><?php echo $circulares["nombre_tcc"]; ?></a></li>
						<?php }
					} ?>
				</ul>
			</li>
			<li id="m_actividades"><a href="actividades.php">Actividades</a></li>
			<li id="m_accionsocial"><a href="accionsocial.php">Acción Social</a></li>
			<li id="m_poleras"><a href="poleras.php">Poleras</a></li>
		</ul>
	</div>
</div>