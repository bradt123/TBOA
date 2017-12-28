<?php
/**
*@package pXP
*@file gen-ACTTipoParentesco.php
*@author  (admin)
*@date 27-12-2017 14:12:38
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

class ACTTipoParentesco extends ACTbase{    
			
	function listarTipoParentesco(){
		$this->objParam->defecto('ordenacion','id_tipo_parentesco');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODTipoParentesco','listarTipoParentesco');
		} else{
			$this->objFunc=$this->create('MODTipoParentesco');
			
			$this->res=$this->objFunc->listarTipoParentesco($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarTipoParentesco(){
		$this->objFunc=$this->create('MODTipoParentesco');	
		if($this->objParam->insertar('id_tipo_parentesco')){
			$this->res=$this->objFunc->insertarTipoParentesco($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarTipoParentesco($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarTipoParentesco(){
			$this->objFunc=$this->create('MODTipoParentesco');	
		$this->res=$this->objFunc->eliminarTipoParentesco($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>