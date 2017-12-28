<?php
/**
*@package pXP
*@file gen-Parentesco.php
*@author  (admin)
*@date 27-12-2017 14:15:25
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Parentesco=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Parentesco.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_parentesco'
			},
			type:'Field',
			form:true 
		},
		
		{
	   			config:{
	       		    name:'id_persona',
	   				origen:'PERSONA',
	   				tinit:true,
	   				fieldLabel:'Persona',
	   				gdisplayField:'desc_person',//mapea al store del grid
	   				anchor: '100%',
	   			    gwidth:200,
		   			 renderer:function (value, p, record){return String.format('{0}', record.data['desc_person']);}
	       	     },
	   			type:'ComboRec',
	   			id_grupo:0,
	   			bottom_filter : true,
	   			filters:{	
			        pfiltro:'PERSON.nombre_completo2',
					type:'string'
				},
	   		   
	   			grid:true,
	   			form:true
		},
		{
			config: {
				name: 'id_tipo_parentesco',
				fieldLabel: 'TipoParentesco',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_organigrama/control/TipoParentesco/listarTipoParentesco',
					id: 'id_tipo_parentesco',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_tipo_parentesco', 'nombre'],
					remoteSort: true,
					baseParams: {par_filtro: 'cat.nombre'}
				}),
				valueField: 'id_tipo_parentesco',
				displayField: 'nombre',
				gdisplayField: 'desc_tipo_parentesco',
				hiddenName: 'id_tipo_parentesco',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['desc_tipo_parentesco']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'cat.nombre',type: 'string'},
			grid: true,
			form: true
		},
		{
			config: {
				inputType:'hidden',
				name: 'id_funcionario',
				fieldLabel: 'id_funcionario',
				
			
			},
			type: 'TextField',
			id_grupo: 0,
			//filters: {pfiltro: 'movtip.nombre',type: 'string'},
			//grid: true,
			form: true
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'par.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'beneficiario',
				fieldLabel: 'beneficiario',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100
			},
				type:'Checkbox',
				filters:{pfiltro:'par.beneficiario',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'heredero',
				fieldLabel: 'heredero',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100
			},
				type:'Checkbox',
				filters:{pfiltro:'par.heredero',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'par.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'par.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'par.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'par.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Parentesco',
	ActSave:'../../sis_organigrama/control/Parentesco/insertarParentesco',
	ActDel:'../../sis_organigrama/control/Parentesco/eliminarParentesco',
	ActList:'../../sis_organigrama/control/Parentesco/listarParentesco',
	id_store:'id_parentesco',
	fields: [
		{name:'id_parentesco', type: 'numeric'},
		{name:'id_persona', type: 'numeric'},
		{name:'id_tipo_parentesco', type: 'numeric'},
		{name:'id_funcionario', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'beneficiario', type: 'boolean'},
		{name:'heredero', type: 'boolean'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'desc_tipo_parentesco', type: 'string'},
		{name:'desc_person',type:'string'}
		
	],
	sortInfo:{
		field: 'id_parentesco',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true,
	
	onReloadPage:function(m){
		this.maestro=m,
		this.store.baseParams={id_funcionario:this.maestro.id_funcionario};
		this.getComponente('id_funcionario').setValue(this.maestro.id_funcionario);
		this.load({params:{start:0,limit:50}});
		
		
	},
	loadValoresIniciales:function()
	{
		Phx.vista.Parentesco.superclass.loadValoresIniciales.call(this);
		this.getComponente('id_funcionario').setValue(this.maestro.id_funcionario);
	}
}
)
</script>
		
		