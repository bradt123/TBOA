/**************************************************************************
 SISTEMA:		Organigrama
 FUNCION: 		orga.ft_parentesco_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'orga.tparentesco'
 AUTOR: 		 (admin)
 FECHA:	        27-12-2017 14:15:25
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				27-12-2017 14:15:25								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'orga.tparentesco'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'orga.ft_parentesco_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'OR_PAR_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		admin	
 	#FECHA:		27-12-2017 14:15:25
	***********************************/

	if(p_transaccion='OR_PAR_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						par.id_parentesco,
						par.id_persona,
						par.id_tipo_parentesco,
						par.id_funcionario,
						par.estado_reg,
						par.beneficiario,
						par.heredero,
						par.fecha_reg,
						par.usuario_ai,
						par.id_usuario_reg,
						par.id_usuario_ai,
						par.fecha_mod,
						par.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
                        cat.nombre as desc_tipo_parentesco,
						PERSON.nombre_completo2 AS desc_person 	
						from orga.tparentesco par
                        INNER JOIN SEGU.vpersona PERSON ON PERSON.id_persona= par.id_persona
						inner join segu.tusuario usu1 on usu1.id_usuario = par.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = par.id_usuario_mod
                        left join orga.ttipo_parentesco cat on cat.id_tipo_parentesco = par.id_tipo_parentesco
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'OR_PAR_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		admin	
 	#FECHA:		27-12-2017 14:15:25
	***********************************/

	elsif(p_transaccion='OR_PAR_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_parentesco)
					    from orga.tparentesco par
                        INNER JOIN SEGU.vpersona PERSON ON PERSON.id_persona= par.id_persona
					    inner join segu.tusuario usu1 on usu1.id_usuario = par.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = par.id_usuario_mod
                        left join orga.ttipo_parentesco cat on cat.id_tipo_parentesco = par.id_tipo_parentesco
					    where ';
			
			--Definicion de la respuesta		    
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;
					
	else
					     
		raise exception 'Transaccion inexistente';
					         
	end if;
					
EXCEPTION
					
	WHEN OTHERS THEN
			v_resp='';
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
			v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
			v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
			raise exception '%',v_resp;
END;