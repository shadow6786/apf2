// JavaScript Document

function FechaDif(dia1,mes1,anio1,dia2,mes2,anio2)
		{
		 	/* Meses con 31:
		*	*	Enero(1) Marzo(3) Mayo(5) Julio(7) Agosto(8) Octubre(10) Diciembre(12)
		*	*	
		*	*	Meses con 30:
		*	*	Abril(4) Junio(6) Setiembre(9) Noviembre(11)
		*	*	
		*	*	Meses con 28:
		*	*	Febrero(2)
		*	*/
		 	var dias1,dias2,dif;
		 	//convertir a numeros
			dia1 = parseInt(dia1,10);
			mes1 = parseInt(mes1,10);
			anio1 = parseInt(anio1,10);
			dia2 = parseInt(dia2,10);
			mes2 = parseInt(mes2,10);
			anio2 = parseInt(anio2,10);
			
		 	//Chequear valores.
		 	if((mes1>12)||(mes2>12)){ return -1;}
		 	
		 	if((mes1==1)||(mes1==3)||(mes1==5)||(mes1==7)||(mes1==8)||(mes1==10)||(mes1==12)){
				if(dia1>31){
					return -1;}
			}
		 	if((mes2==1)||(mes2==3)||(mes2==5)||(mes2==7)||(mes2==8)||(mes2==10)||(mes2==12)){
				if(dia2>31){
					return -1;}
			}
		 	if((mes1==4)||(mes1==6)||(mes1==9)||(mes1==11)){
				if(dia1>30){
					return -1;}
			}
		 	if((mes2==4)||(mes2==6)||(mes2==9)||(mes2==11)){
				if(dia2>30){
				 	return -1;}
			}
		 	if(mes1==2 && dia1>29){
				 	return -1;}
		 	if(mes2==2 && dia2>29){
					return -1;}
		 	
		 	dias1 = FechaADias(dia1,mes1,anio1);
		 	dias2 = FechaADias(dia2,mes2,anio2);
		 	//devolver la diferencia positiva
		 	dif = dias2 - dias1;
		 	if(dif<0){
				return ((-1*dif));}
		 	return dif;
		}

function FechaADias(dia, mes, anno){
		 /*Devuelve la cantidad de días desde el 1/01/1904
		*	No verifica datos. Llamada desde FechaDif()
		*	intervalo permitido: 1904-2099
		*	**/
		 	
			dia = parseInt(dia,10);
			mes = parseInt(mes,10);
			anno = parseInt(anno,10);
		 	var cant_bic,cant_annos,cant_dias, no_es_bic;
		 
		 	
		 	//verificar la cantidad de biciestos en el periodo (div entera)
		 	//+1 p/contar 1904
		 	cant_bic = parseInt((anno-1904)/4 + 1);
		 	no_es_bic = parseInt((anno % 4));
		 	//calcular dias transcurridos hasta el 31 de dic del año anterior
		 	cant_annos = parseInt(anno-1904);
		 	cant_dias = parseInt(cant_annos*365 + cant_bic);
		 	
		 	//calcular dias transcurridoes desde el 31 de dic del año anterior
		 	//hasta el mes anterior al ingresado
		 	var i;
		 	for(i=1;i<=mes;i++){
				if((i==1)||(i==3)||(i==5)||(i==7)||(i==8)||(i==10)||(i==12)){
				 	cant_dias+=31;}
				if((i==4)||(i==6)||(i==9)||(i==11)){
				 	cant_dias+=30;}
				if(i==2)
				 	{
				 	if(no_es_bic){
						cant_dias+=28;}
				   	else{
						cant_dias+=29;}
				}
		 	}	
		 	//sumarle los dias transcurridos en el mes
		 	cant_dias+=dia;
		 	return cant_dias;
		}