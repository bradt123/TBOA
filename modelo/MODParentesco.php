<?php
/**
*@package pXP
*@file gen-MODParentesco.php
*@author  (admin)
*@date 27-12-2017 14:15:25
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/

class MODParentesco extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarParentesco(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='orga.ft_parentesco_sel';
		$this->transaccion='OR_PAR_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_parentesco','int4');
		$this->captura('id_persona','int4');
		$this->captura('id_tipo_parentesco','int4');
		$this->captura('id_funcionario','int4');
		$this->captura('estado_reg','varchar');
		$this->captura('beneficiario','varchar');
		$this->captura('heredero','bool');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('desc_tipo_parentesco','varchar');
		$this->captura('desc_person','text');
		
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarParentesco(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='orga.ft_parentesco_ime';
		$this->transaccion='OR_PAR_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_persona','id_persona','int4');
		$this->setParametro('id_tipo_parentesco','id_tipo_parentesco','int4');
		$this->setParametro('id_funcionario','id_funcionario','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('beneficiario','beneficiario','varchar');
		$this->setParametro('heredero','heredero','bool');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarParentesco(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='orga.ft_parentesco_ime';
		$this->transaccion='OR_PAR_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_parentesco','id_parentesco','int4');
		$this->setParametro('id_persona','id_persona','int4');
		$this->setParametro('id_tipo_parentesco','id_tipo_parentesco','int4');
		$this->setParametro('id_funcionario','id_funcionario','int4');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('beneficiario','beneficiario','bool');
		$this->setParametro('heredero','heredero','bool');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarParentesco(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='orga.ft_parentesco_ime';
		$this->transaccion='OR_PAR_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_parentesco','id_parentesco','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>