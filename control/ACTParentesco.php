<?php
/**
*@package pXP
*@file gen-ACTParentesco.php
*@author  (admin)
*@date 27-12-2017 14:15:25
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTParentesco extends ACTbase{    
			
	function listarParentesco(){
		$this->objParam->defecto('ordenacion','id_parentesco');

		$this->objParam->defecto('dir_ordenacion','asc');
		/*aumentado*/
		if($this->objParam->getParametro('id_funcionario')!= ''){
		$this->objParam->addFiltro("par.id_funcionario = ".$this->objParam->getParametro('id_funcionario'));
		}
		/**/
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODParentesco','listarParentesco');
		} else{
			$this->objFunc=$this->create('MODParentesco');
			
			$this->res=$this->objFunc->listarParentesco($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarParentesco(){
		$this->objFunc=$this->create('MODParentesco');	
		if($this->objParam->insertar('id_parentesco')){
			$this->res=$this->objFunc->insertarParentesco($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarParentesco($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarParentesco(){
			$this->objFunc=$this->create('MODParentesco');	
		$this->res=$this->objFunc->eliminarParentesco($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>