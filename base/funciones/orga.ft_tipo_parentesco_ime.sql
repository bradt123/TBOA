CREATE OR REPLACE FUNCTION "orga"."ft_tipo_parentesco_ime" (	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:		Organigrama
 FUNCION: 		orga.ft_tipo_parentesco_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'orga.ttipo_parentesco'
 AUTOR: 		 (admin)
 FECHA:	        27-12-2017 14:12:38
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				27-12-2017 14:12:38								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'orga.ttipo_parentesco'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_tipo_parentesco	integer;
			    
BEGIN

    v_nombre_funcion = 'orga.ft_tipo_parentesco_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'OR_PAR_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		27-12-2017 14:12:38
	***********************************/

	if(p_transaccion='OR_PAR_INS')then
					
        begin
        	--Sentencia de la insercion
        	insert into orga.ttipo_parentesco(
			nombre,
			estado_reg,
			id_usuario_reg,
			fecha_reg,
			usuario_ai,
			id_usuario_ai,
			fecha_mod,
			id_usuario_mod
          	) values(
			v_parametros.nombre,
			'activo',
			p_id_usuario,
			now(),
			v_parametros._nombre_usuario_ai,
			v_parametros._id_usuario_ai,
			null,
			null
							
			
			
			)RETURNING id_tipo_parentesco into v_id_tipo_parentesco;
			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Parentesco almacenado(a) con exito (id_tipo_parentesco'||v_id_tipo_parentesco||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_parentesco',v_id_tipo_parentesco::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'OR_PAR_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		27-12-2017 14:12:38
	***********************************/

	elsif(p_transaccion='OR_PAR_MOD')then

		begin
			--Sentencia de la modificacion
			update orga.ttipo_parentesco set
			nombre = v_parametros.nombre,
			fecha_mod = now(),
			id_usuario_mod = p_id_usuario,
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_tipo_parentesco=v_parametros.id_tipo_parentesco;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Parentesco modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_parentesco',v_parametros.id_tipo_parentesco::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'OR_PAR_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		27-12-2017 14:12:38
	***********************************/

	elsif(p_transaccion='OR_PAR_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from orga.ttipo_parentesco
            where id_tipo_parentesco=v_parametros.id_tipo_parentesco;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Parentesco eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_tipo_parentesco',v_parametros.id_tipo_parentesco::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "orga"."ft_tipo_parentesco_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
