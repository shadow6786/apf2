<?php

include_once("../_DAL/conexion.php");
include_once("../_UTL/funcionesBRL.php");
$con = new DBManager;

$sql = "SELECT  `Denom. Cuenta`, c.Tarjeta,`e-Mail`, tot
FROM (SELECT * FROM atc_cuentas WHERE `e-Mail` <>  'a@a.a'
AND  `e-Mail` <>  ''
AND NOT ISNULL(  `e-Mail` ) ) c
LEFT JOIN (SELECT Tarjeta, COUNT( * ) AS tot FROM `atc_movimientos` WHERE (`date` >= '2012-06-01') GROUP BY Tarjeta) m ON m.Tarjeta = c.Tarjeta
";

$fechaconcurso = "1 hasta el 30 de Junio"; // {fechaconcurso}
$fechapuntos = "16 de Junio"; // {fechapuntos}

$puntos = ""; //{puntos}
$tarjeta = ""; //{tarjeta}
$trans = 0; // {trans}
$transflatantes = 0; // {transflatantes}
$redimidos = 0; //{redimidos}
$trastotal = 0; //{trastotal}
$promociones = '
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;" ><font face="Arial, Helvetica, sans-serif" ><font><font color="#000000" ><font size="3"  color="#235240" ><strong>

Cosmo Piel 

</strong><font>

en todas sus sucursales<span>te</span>brinda: un 30% de descuento en tratamientos para el acné, 50% de descuento en laser y 2x1 en corporal

</font></font></font></font></font></p>

'; //{promociones}

require_once '../_UTL/BaseElasticEmail.php';
$ee = new BaseElasticEmail();

$csv  = '"ToMail","Title","FirstName","LastName","campo3","campo"'."\n";
$csv .= '"hanssvane@gmail.com","Mr","Hans","Svane","ValorCamp3","ValdeCampoNormal"'."\n";
$csv .= '"zalles@gmail.com","Miss","Nicolas","Zalles","ZZValorCamp3","ValdeCampoNormalZZ"'."\n";

$text = '<div>

<img src="https://elasticemail.com/_library/2012/6/1.png"  />

<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" ><font color="#000000" ><br />Estimado {FirstName},</font></p>

<font color="#000000" >
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" ><font color="#000000" >Nuevo mes, más puntos por acumular y más posibilidades de ganar!!!</font></p>


<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" ><font color="#000000" >Tu Club de compradores inteligentes te da la oportunidad de <strong><font color="#235240" >ganar 3,000 puntos</font></strong> en el mes de Abril.  Para participar en esta promoción sólo debes recordar, cada que haces una compra, de presentar tu tarjeta Cash Club y acumular tus puntos.  Si realizas 5 transacciones desde el {fechaconcurso}, puedes participar en la promoción.  Las 5 transacciones son tu ingreso al sorteo y cada transacción adicional te brinda más posibilidades de ganar.</font></p>


<blockquote style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" >
<p><font color="#000000" >Desde el 1 hasta el {fechapuntos} tienes con tu tarjeta Nro. {tarjeta}:  {trans} transacciones</font></p>
<p><strong><font size="3"  color="#235240" >Te faltan {transflatantes} transacciones para el sorteo de los 3,000 puntos. No pierdas la oportunidad de ganar</font></strong></p>
<p><font color="#000000" >Al {fechareporte}: {puntos} puntos acumulados para redimir en cualquier comercio afiliado a Cash Club</font></p>
<p><font color="#000000" >Hasta el {fechapuntos} tenemos registrado {redimidos} puntos redimidos en un total de {transtotal} transacción(es)</font></p></blockquote>
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" ><em><font color="#000000" >Si crees que la información es incorrecta contáctanos a nuestro Centro de Llamadas al 354-5555, nuestros operadores estarán prestos para ayudarte.</font></em></p>





<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); margin-right: 0px; word-spacing: 0px;"  dir="ltr" ><font size="4" ><font color="#000000" ><strong><font color="#235240" >Novedades y promociones que puedes aprovechar!!!</font> </strong><em>(No olvides que estas promociones no acumulan puntos)</em></font></font></p>


<blockquote style="margin-right: 0px; text-indent: 0px; letter-spacing: normal; font: medium '."'Times New Roman'".'; text-transform: none; white-space: normal; word-spacing: 0px;"  dir="ltr" >

{promociones}

</blockquote>

<font face="Arial, Helvetica, sans-serif" >
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" ><font color="#000000" >No olvides que tus transacciones la puedes hacer en los comercios que se encuentran en nuestro sitio web:</font><a style="color: rgb(17, 85, 204);"  href="http://api.elasticemail.com/tracking/click?msgid=lgc02u-8wwlfx34&target=http%3a%2f%2fapi.elasticemail.com%2ftracking%2fclick%3fmsgid%3dlgc02u-8j9glu0z%26target%3dhttp%3a%2f%2fwww.cashclub.com.bo"  target="_blank" ><font color="#000000" >http://www.<span class="il" >cashclub</span>.com.bo</font></a></p>


<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" ><font color="#000000" ><strong><font color="#235240" >Importante</font>: </strong>Recuerda siempre las reglas de participación del programa Cash Club, te detallamos algunas de las importantes a continuación:</font></p>


<ol style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" >
<li style="margin-left: 15px;" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" ><font face="Arial, Helvetica, sans-serif"  color="#000000" >Obtendrás los puntos que te otorgue el consumo de bienes y servicios de las empresas afiliadas a la red, según los beneficios que cada empresa de la red otorgue, siempre teniendo en cuenta que el uso de la tarjeta de Cash Club no es combinable con otras ofertas.</font></span></li>


<li style="margin-left: 15px;" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" ><font face="Arial"  color="#000000" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" >El puntaje acumulado se intercambia por otros productos o servicios de empresas que están dentro de la red y que no se encuentren en oferta o promoción.Cuando   utilizas tus puntos para la compra de un producto o utilización de un servicio, no obtienes el beneficio de acumulación de puntos.</span></font></span></li>


<li style="margin-left: 15px;" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" ><font face="Arial"  color="#000000" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" ><span lang="ES-BO"  style="line-height: 17px; font-family: Calibri,sans-serif; font-size: 11pt;" >Solamente podrán acumular puntos para el titular de una tarjeta y personas que tengan relación con el mismo hasta el segundo grado de consanguinidad o afinidad.</span></span></font></span></li>

</ol></font>
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" ><font color="#000000" ><span class="il" >CashClub</span> te regala dinero!!!</font></p>
<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" >T.<a style="color: rgb(17, 85, 204);"  href="http://api.elasticemail.com/tracking/click?msgid=lgc02u-8wwlfx34&target=tel%3a%2b591+%283%29+354-5555"  value="+59133545555"  target="_blank" >+591 (3) 354-5555</a></p>


<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" >E.<a style="color: rgb(17, 85, 204);"  href="mailto:info@cashclub.com.bo"  target="_blank" >info@<span class="il" >cashclub</span>.com.bo</a></p>





<p style="text-transform: none; text-indent: 0px; letter-spacing: normal; font: 13px arial,sans-serif; white-space: normal; color: rgb(80, 0, 80); word-spacing: 0px;" ><a style="color: rgb(17, 85, 204);"  href="http://api.elasticemail.com/tracking/click?msgid=lgc02u-8wwlfx34&target=http%3a%2f%2fwww.cashclub.com.bo"  target="_blank" >http://www.<span class="il" >cashclub</span>.com.bo</a><br /><br /></p>

<img width="25"  height="25"  src="https://elasticemail.com/_library/2012/6/2.png"  /></font></div>';



$res = $ee->mailMerge($csv, "teregala3000puntos@cashclub.com.bo", "Cashclub", "CASHCLUB Te regala 3000 puntos.", $text);
echo "<pre>";
var_dump($res);
echo "</pre>";

$list = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
);

$fp = fopen('mail3000puntos'.date("mdYHis").'.csv', 'w');

foreach ($list as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

?>