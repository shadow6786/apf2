<!-- elRTE -->
<script src="../js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
<!-- elFinder -->
<link rel="stylesheet" href="../css/elfinder.css" type="text/css" media="screen" charset="utf-8" /> 
<script src="../js/elfinder.full.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/i18n/elrte.es.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/i18n/elfinder.es.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

var opts = {
			cssClass : 'el-rte',
			lang     : 'es',
			allowSource : 1,  // allow user to view source
			height   : 450,   // height of text area
			width   : 850,
			toolbar  : 'normal',   // Your options here are 'tiny', 'compact', 'normal', 'complete', 'maxi', or 'custom'
			cssfiles : ['../css/elrte-inner.css'],
			// elFinder
			fmAllow  : 1,
			fmOpen : function(callback) 
			{
				$('<div id="myelfinder" />').elfinder({
					url : '../connectors/php/connector.php', // elFinder configuration file.
					lang : 'es',
					dialog : { width : 800, modal : true, title : 'Files' }, // Open in dialog window
					closeOnEditorCallback : true, // Close after file select
					editorCallback : callback     // Pass callback to file manager
				})
			}
			//end of elFinder
			}

</script>
				 
<?php 

// Line that youy have to use on the page remember to replace the ID for the proper one, you can use it as many times as needed.
// id of textarea you want rich edit on
// Copy the php	tag but Uncomment the code


/* 

include("../_UTL/wysiwyg.php"); 
echo "<script> $(document).ready(function(){ $('#HERETHEID').elrte(opts); }); </script>";

*/
?>