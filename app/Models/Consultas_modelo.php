<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\Movimientos_estados_consultas;

class Consultas_modelo extends Model{
	
	protected $table = 'consultas';
	protected $primaryKey = 'IdConsulta';

	protected $returnType = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['IdTipoConsulta', 'IdConsultante', 'IdComisionMedica', 'IdAbogado', 'IdMatriculacion', 'IdEstadoConsulta', 'IdPartido', 'IdLocalidad', 'Descripcion', 'Pregunta', 'Respuesta', 'CodigoVerificacion', 'RazonSocialEmpleador', 'DomicilioLaboral', 'TelefonoEmpleador', 'FechaSorteo'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;	
	
	function devolver_causas_sin_cerrar($idmatricula){
		
		$sql = "select *
				from consultas as c
				join matriculaciones as m on c.IdMatriculacion = m.IdMatriculacion
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = c.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				where m.IdMatriculacion = ? and mec.IdEstado not in (1,2,3,8)";
				/*
				(1,2,3,8)EXCUSADA, RECUSADA POR EL CLIENTE, RECUSADA POR FALTA DEL ABOGADO O ELIMINADA 
				*/
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();						

	}	
	function devolver_sorteos_por_provincias(){
		
		$query = $this->query('SELECT count(c.IdConsulta) as cantidad_sorteos, p.NombreProvincia,p.IdProvincia
							   FROM consultas as c
							   join partidos as p on c.IdPartido = p.Id
							   where p.Id <> 1024
							   group by p.NombreProvincia,p.IdProvincia');
								
		return $query->getResultArray();
		
	}	
	function devolver_sorteos_por_comisiones_medicas(){
		
		$query = $this->query('SELECT tc.IdTipoConsulta,tc.NombreTipoConsulta,count(cta.IdTipoConsulta) as cantidad_por_consulta
				
								FROM consultas as cta        
								right join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
								group by tc.IdTipoConsulta');
								
		return $query->getResultArray();
		
	}	
	function devolver_causas_por_comisiones_medicas(){
		
		$query = $this->query('select cm.IdComisionMedica,cm.NombreComisionMedica,count(*) as total_comision 
														
							   from consultas as c
							   join comisiones_medicas as cm on cm.IdComisionMedica = c.IdComisionMedica
							   group by c.IdComisionMedica');
								
		return $query->getResultArray();
		
	}
	function devolver_abogados_sorteados_por_partido_movimiento_fechas($idprovincia,$idpartido,$desde,$hasta){
		
		$sql = "select a.Apellido,a.Nombre,m.Cuit,m.Tomo,m.Folio,
				count(CASE WHEN mec.IdEstado = 1 then 1 ELSE NULL END) as excusado,				
				count(CASE WHEN mec.IdEstado = 2 then 1 ELSE NULL END) as recusado_por_cliente,				
				count(CASE WHEN mec.IdEstado = 3 then 1 ELSE NULL END) as recusado_por_colegio,				
				count(CASE WHEN mec.IdEstado = 5 then 1 ELSE NULL END) as nosepresento,				
				count(CASE WHEN mec.IdEstado = 7 then 1 ELSE NULL END) as aceptada,				
				count(CASE WHEN mec.IdEstado = 8 then 1 ELSE NULL END) as cerrado,				
				count(c.IdConsulta) as totalsorteos

				 from consultas as c
				 join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				 as Tablaultimoestado on Tablaultimoestado.IdConsulta = c.IdConsulta 
				 join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				 left join matriculaciones as m on c.IdMatriculacion = m.IdMatriculacion
				 
				 left join abogados as a on a.IdAbogado = m.IdAbogado
				 where c.IdPartido = ? and FechaSorteo between ? and ?
				 group by m.IdMatriculacion";						
			
		$query = $this->db->query($sql, array($idpartido,$desde,$hasta));
		return $query->getResultArray();			
			
	}
	function devolver_sorteos_por_partidos_fechas($idprovincia,$desde,$hasta){
		
		$sql = "SELECT count(c.IdConsulta) as cantidad_por_partido, p.NombrePartido, prov.NombreProvincia
				FROM partidos as p
				join consultas as c on p.Id = c.IdPartido
				join provincias as prov on p.IdProvincia = prov.IdProvincia
				where p.IdProvincia = ? and c.FechaSorteo between ? and ?
				group by c.IdPartido";						
			
		$query = $this->db->query($sql, array($idprovincia,$desde,$hasta));
		return $query->getResultArray();			
			
	}
	function devolver_sorteos_por_partidos($idprovincia){
		
		$sql = "SELECT count(c.IdConsulta) as cantidad_por_partido, p.NombrePartido, prov.NombreProvincia
				FROM partidos as p
				join consultas as c on p.Id = c.IdPartido
				join provincias as prov on p.IdProvincia = prov.IdProvincia
				where p.IdProvincia = ?
				group by c.IdPartido";						
			
		$query = $this->db->query($sql, array($idprovincia));
		return $query->getResultArray();			
			
	}	
	function devolver_movimientos_causa($idconsulta){
		
		$sql = "SELECT mc.*,tmc.NombreTipoMovimiento
				from movimientos_consultas	as mc
				left join tipos_movimientos_causa as tmc on mc.IdTipoMovimiento = tmc.IdTipoMovimiento				
				where mc.IdConsulta = ? and mc.deleted_at is null
				order by mc.FechaMovimiento asc";						
			
		$query = $this->db->query($sql, array($idconsulta));
		return $query->getResultArray();			
			
	}
	function devolver_consulta_abogado($idconsulta){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta, ec.IdEstadoConsulta,
					   p.NombrePartido,
					   a.Apellido as apellido_abogado, a.Nombre as nombre_abogado,
					   m.Tomo, m.Folio, m.Matricula, 
					   dpto.Acronimo,dpto.NombreDepartamento as nombre_colegio,
					   d.Calle as calle_estudio, d.Numero as numero_estudio, d.Piso as piso_estudio, d.Oficina as oficina_estudio, d.Email as email_estudio, d.Telefono as telefono_estudio, d.HorariosAtencion,
					   cm.NombreComisionMedica
				FROM consultas as cta
				left join comisiones_medicas as cm on cm.IdComisionMedica = cta.IdComisionMedica
				left join abogados as a on a.IdAbogado = cta.IdAbogado
				left join matriculaciones as m on m.IdAbogado = a.IdAbogado				
				join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
				as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
				join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
                left join departamentos as dpto on dpto.IdDepartamento = a.IdColegio
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = cta.IdEstadoConsulta
				left join partidos as p on p.Id = cta.IdPartido
		
				where IdConsulta = ?";						
			
		$query = $this->db->query($sql, array($idconsulta));
		return $query->getResultArray();			
			
	}
	function devolver_consulta($idconsulta){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta, ec.IdEstadoConsulta,
					   p.NombrePartido,l.NombreLocalidad,
					   a.Apellido as apellido_abogado, a.Nombre as nombre_abogado,
					   m.Tomo, m.Folio, m.Matricula, 
					   mec.Motivo,
					   dpto.Acronimo,dpto.NombreDepartamento as nombre_colegio,
					   d.Calle as calle_estudio, d.Numero as numero_estudio, d.Piso as piso_estudio, d.Oficina as oficina_estudio, d.Email as email_estudio, d.Telefono as telefono_estudio, d.HorariosAtencion,
					   cm.NombreComisionMedica
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join comisiones_medicas as cm on cm.IdComisionMedica = cta.IdComisionMedica
				left join abogados as a on a.IdAbogado = cta.IdAbogado
				left join matriculaciones as m on m.IdAbogado = a.IdAbogado				
				join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
				as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
				join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
				left join localidades as l on l.IdLocalidad = d.IdLocalidad
                left join departamentos as dpto on dpto.IdDepartamento = a.IdColegio
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta			
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido		
				where cta.IdConsulta = ? and cta.IdPartido = d.IdPartido and d.Estado = 1";						
			
		$query = $this->db->query($sql, array($idconsulta));
		return $query->getResultArray();			
			
	}	
	function devolver_consultas_pendientes_por_mas_de_siete_dias(){
		
		$query = $this->query('SELECT cta.*, 
							   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
							   tc.NombreTipoConsulta,
							   ec.NombreEstadoConsulta, ec.IdEstadoConsulta,
							   p.NombrePartido,
							   a.Apellido as apellido_abogado, a.Nombre as nombre_abogado,
							   m.Tomo, m.Folio, m.Matricula, 
							   dpto.Acronimo,dpto.NombreDepartamento as nombre_colegio,
							   d.Calle as calle_estudio, d.Numero as numero_estudio, d.Piso as piso_estudio, d.Oficina as oficina_estudio, d.Email as email_estudio, d.Telefono as telefono_estudio, d.HorariosAtencion,
							   cm.NombreComisionMedica
						FROM consultas as cta
						join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
						as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
						join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
						left join comisiones_medicas as cm on cm.IdComisionMedica = cta.IdComisionMedica
						left join abogados as a on a.IdAbogado = cta.IdAbogado
						left join matriculaciones as m on m.IdAbogado = a.IdAbogado				
						join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
						as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
						join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
						left join departamentos as dpto on dpto.IdDepartamento = a.IdColegio
						left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
						left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta			
						left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
						left join partidos as p on p.Id = cta.IdPartido		
						where ec.IdEstadoConsulta = 4 and DATE_ADD(cta.FechaSorteo,INTERVAL 7 DAY) = NOW() and cta.deleted_at is null');
								
		return $query->getResultArray();
			
	}
	function devolver_consultas_pendientes_por_mas_de_quince_dias(){
		
		$query = $this->query('SELECT cta.*, 
							   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
							   tc.NombreTipoConsulta,
							   ec.NombreEstadoConsulta, ec.IdEstadoConsulta,
							   p.NombrePartido,
							   a.Apellido as apellido_abogado, a.Nombre as nombre_abogado,
							   m.Tomo, m.Folio, m.Matricula, 
							   dpto.Acronimo,dpto.NombreDepartamento as nombre_colegio,
							   d.Calle as calle_estudio, d.Numero as numero_estudio, d.Piso as piso_estudio, d.Oficina as oficina_estudio, d.Email as email_estudio, d.Telefono as telefono_estudio, d.HorariosAtencion,
							   cm.NombreComisionMedica
						FROM consultas as cta
						join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
						as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
						join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
						left join comisiones_medicas as cm on cm.IdComisionMedica = cta.IdComisionMedica
						left join abogados as a on a.IdAbogado = cta.IdAbogado
						left join matriculaciones as m on m.IdAbogado = a.IdAbogado				
						join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
						as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
						join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom
						left join departamentos as dpto on dpto.IdDepartamento = a.IdColegio
						left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
						left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta			
						left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
						left join partidos as p on p.Id = cta.IdPartido		
						where ec.IdEstadoConsulta = 4 and DATE_ADD(cta.FechaSorteo,INTERVAL 15 DAY) < NOW() and cta.deleted_at is null');// and cta.IdConsulta in (219,221)
								
		return $query->getResultArray();
			
	}
	function devolver_consultas_por_abogado($idabogado){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta,ec.IdEstadoConsulta,ec.Aplica,
					   mec.Motivo,
					   p.NombrePartido
				
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido
		
				where cta.IdAbogado = ? 
				order by FIELD(ec.IdEstadoConsulta,4,5,3,2,1)";						
			
		$query = $this->db->query($sql, array($idabogado));
		return $query->getResultArray();			
			
	}	
	function devolver_consultas_por_colegio($idcolegio,$desde,$hasta,$estado_sorteos){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta,ec.IdEstadoConsulta,ec.Aplica,
					   p.NombrePartido,
					   mec.Motivo,
					   m.IdColegio, a.Nombre as nombre_abogado, a.Apellido as apellido_abogado, m.Tomo as tomo_abogado, m.Folio as folio_abogado, m.Matricula as matricula_abogado,m.Cuit as cuit_abogado
				
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join matriculaciones as m on m.IdMatriculacion = cta.IdMatriculacion
				left join abogados as a on a.IdAbogado = cta.IdAbogado		
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido
		
				where  mec.IdEstado = ? and m.IdColegio = ? and FechaSorteo between ? and ?";						
			//order by FIELD(cta.IdEstadoConsulta,4,5,3,2,1)
		$query = $this->db->query($sql, array($estado_sorteos,$idcolegio,$desde,$hasta));
		return $query->getResultArray();			
			
	}
	function devolver_consultas_por_numero($idcolegio,$numerosorteo){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email, m.Tomo as tomo_abogado, m.Folio as folio_abogado, m.Matricula as matricula_abogado,m.Cuit as cuit_abogado,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta,ec.IdEstadoConsulta,ec.Aplica,
					   p.NombrePartido,
					   mec.Motivo,
					   a.IdColegio, a.Nombre as nombre_abogado, a.Apellido as apellido_abogado
				
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join matriculaciones as m on m.IdMatriculacion = cta.IdMatriculacion
				left join abogados as a on a.IdAbogado = cta.IdAbogado
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido
		
				where a.IdColegio = ? and cta.IdConsulta = ?";						
			
		$query = $this->db->query($sql, array($idcolegio,$numerosorteo));
		return $query->getResultArray();			
			
	}	
	function devolver_consultas_por_numero_administrador($numerosorteo){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta,ec.IdEstadoConsulta,ec.Aplica,
					   p.NombrePartido,
					   mec.Motivo,
					   a.IdColegio, a.Nombre as nombre_abogado, a.Apellido as apellido_abogado, m.Tomo as tomo_abogado, m.Folio as folio_abogado, m.Matricula as matricula_abogado,m.Cuit as cuit_abogado
				
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join matriculaciones as m on m.IdMatriculacion = cta.IdMatriculacion
				left join abogados as a on a.IdAbogado = cta.IdAbogado
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido
		
				where cta.IdConsulta = ?";						
			
		$query = $this->db->query($sql, array($numerosorteo));
		return $query->getResultArray();			
			
	}
	function devolver_consultas_para_administrador($desde,$hasta,$estado_sorteos){
		
		$sql = "SELECT cta.*, 
					   ctes.Cuit, ctes.Apellido, ctes.Nombre, ctes.Telefono, ctes.Celular, ctes.Email,
					   tc.NombreTipoConsulta,
					   ec.NombreEstadoConsulta,ec.IdEstadoConsulta,ec.Aplica,
					   p.NombrePartido,
					   mec.Motivo,
					   m.IdColegio, a.Nombre as nombre_abogado, a.Apellido as apellido_abogado, m.Tomo as tomo_abogado, m.Folio as folio_abogado, m.Matricula as matricula_abogado,m.Cuit as cuit_abogado
				
				FROM consultas as cta
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = cta.IdConsulta 
                join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
				left join matriculaciones as m on m.IdMatriculacion = cta.IdMatriculacion
				left join abogados as a on a.IdAbogado = cta.IdAbogado		
				left join consultantes as ctes on cta.IdConsultante = ctes.IdConsultante
				left join tipos_consultas as tc on tc.IdTipoConsulta = cta.IdTipoConsulta
				left join estados_consultas as ec on ec.IdEstadoConsulta = mec.IdEstado
				left join partidos as p on p.Id = cta.IdPartido
		
				where  mec.IdEstado = ?	 and FechaSorteo between ? and ?";	
		
		$query = $this->db->query($sql, array($estado_sorteos,$desde,$hasta));
		return $query->getResultArray();
	
	}
	function guardar_excusarse_de_causa($estadoconsulta,$motivo,$id_consulta,$idcolegio,$idusuario){
		
		$movimientosEstadosConsultas = new Movimientos_estados_consultas($db);
		
		//mecanismo para evitar el doble incremento
		if((empty($movimientosEstadosConsultas->where('IdEstado',$estadoconsulta)->where('IdConsulta' , $id_consulta)->findAll())) and 
		   (empty($movimientosEstadosConsultas->where('IdEstado',2)->where('IdConsulta' , $id_consulta)->findAll()))){
			
			$sql = "update consultas as c				
					join matriculaciones as m on m.IdMatriculacion = c.IdMatriculacion
					
					set m.DeudaSorteo = m.DeudaSorteo + (select suma from estados_consultas where IdEstadoConsulta = ?)
					where c.IdConsulta = ? and m.IdColegio = ? ";				
			$query = $this->db->query($sql, array($estadoconsulta,$id_consulta,$idcolegio));
			
		}
		
		$mensaje = 'Excusacion de abogado en consulta número '.$id_consulta;
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdEstadoConsulta,IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($estadoconsulta,$idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la excusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,$estadoconsulta,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
				
	}
	function guardar_recusar_abogado($estadoconsulta,$motivo,$id_consulta,$idcolegio,$idusuario){
		
		$movimientosEstadosConsultas = new Movimientos_estados_consultas($db);
		
		if((empty($movimientosEstadosConsultas->where('IdEstado',$estadoconsulta)->where('IdConsulta' , $id_consulta)->findAll())) and
		   (empty($movimientosEstadosConsultas->where('IdEstado',5)->where('IdConsulta' , $id_consulta)->findAll()))){
				  
			$sql = "update consultas as c
					join matriculaciones as m on m.IdMatriculacion = c.IdMatriculacion
					
					set m.DeudaSorteo = m.DeudaSorteo + (select suma from estados_consultas where IdEstadoConsulta = ?)
					where c.IdConsulta = ? and m.IdColegio = ? ";				
			$query = $this->db->query($sql, array($estadoconsulta,$id_consulta,$idcolegio));
		
		}
		
		$mensaje = 'Recusado por Colegio de Abogados en consulta número '.$id_consulta;
		$mensaje .= ' Quien solicita: El Cliente';
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdEstadoConsulta,IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($estadoconsulta,$idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la recusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,$estadoconsulta,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
				
	}	
	function guardar_cambiar_estado_a_pendiente($id_consulta_cambiar_estado,$idusuario){
		
		$movimientosEstadosConsultas = new Movimientos_estados_consultas($db);
				  
		$sql = "update consultas			
				set IdEstadoConsulta = 4
				where IdConsulta = ?";				
		$query = $this->db->query($sql, array($id_consulta_cambiar_estado));	
		
		$mensaje = 'Cambio a estado Pendiente en consulta número '.$id_consulta_cambiar_estado;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdEstadoConsulta,IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array(4,$idusuario,$mensaje,$id_consulta_cambiar_estado,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la recusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta_cambiar_estado,$idusuario,4,$mensaje,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
				
	}
	function guardar_finalizar_causa($id_consulta,$idcolegio,$idusuario){
		
		//marcamos las consulta como finalizada
		$sql = "update consultas as c				
				join matriculaciones as m on m.IdAbogado = c.IdAbogado
				
				set c.IdEstadoConsulta = 8
				where c.IdConsulta = ? and m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Finaliza causa número '.$id_consulta;
				
		// Guardamos en el log_sorteos la finalizacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas el cierre  
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,8,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//8 = Cerro
				
	}	
	function guardar_finalizar_causa_por_paso_del_tiempo($id_consulta){
		
		//marcamos las consulta como finalizada
		$sql = "update consultas			
				set IdEstadoConsulta = 8
				where IdConsulta = ?";				
		$query = $this->db->query($sql, array($id_consulta));		
		
		$mensaje = 'Finaliza causa automática por paso del tiempo.';
				
		// Guardamos en el log_sorteos la finalizacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array(9999,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));		//9999 ES LA EJECUCION AUTOMATICA
		
		// Guardamos en el movimientos_estados_consultas el cierre  
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,Motivo,IdUsuario,IdEstado,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$mensaje,9999,8,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//8 = Cerro //9999 ES LA EJECUCION AUTOMATICA
				
	}	
	function guardar_aceptar_causa($id_consulta,$idusuario){
		
		//marcamos la consulta como aceptada		
		$sql = "update consultas set IdEstadoConsulta = 7 where IdConsulta = ? ";				
		$query = $this->db->query($sql, array($id_consulta));
		
		$mensaje = 'Aceptación de abogado a consulta número '.$id_consulta;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la aceptacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,7,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//7 = Aceptada
				
	}
	/*
	function guardar_excusarse_de_causa($motivo,$id_consulta,$idcolegio,$idusuario){
		
		//marcamos al abogado como disponible para sorteo
		//sumamos uno al campo DeudaSorteo
		//sacamos al abogado de la consulta
		//marcamos las consulta como excusada
	
		$sql = "update consultas as c
				join abogados as a on a.IdAbogado = c.IdAbogado
				join matriculaciones as m on m.IdAbogado = a.IdAbogado
				
				set c.IdEstadoConsulta = 1
				where c.IdConsulta = ? and m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Excusacion de abogado en consulta número '.$id_consulta;
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la excusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,1,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//1 = Excuso
				
	}
	function guardar_finalizar_causa($id_consulta,$idcolegio,$idusuario){
		
		//marcamos las consulta como finalizada
		$sql = "update consultas as c				
				join matriculaciones as m on m.IdAbogado = c.IdAbogado
				
				set c.IdEstadoConsulta = 8
				where c.IdConsulta = ? and m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Finaliza causa número '.$id_consulta;
				
		// Guardamos en el log_sorteos la finalizacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas el cierre  
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,8,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//8 = Cerro
				
	}	
	function guardar_recusar_abogado($motivo,$id_consulta,$idcolegio,$idusuario){
		
		//marcamos al abogado como disponible para sorteo
		//sumamos uno al campo DeudaSorteo
		//sacamos al abogado de la consulta
		//marcamos las consulta como excusada
		$sql = "update consultas as c
				join abogados as a on a.IdAbogado = c.IdAbogado
				join matriculaciones as m on m.IdAbogado = a.IdAbogado
				
				set m.FueSorteado = 0, m.DeudaSorteo = m.DeudaSorteo + 1, c.IdAbogado = ?, c.IdEstadoConsulta = 1
				where m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Recusado por Colegio de Abogados en consulta número '.$id_consulta;
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la recusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,2,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//2 = Recusada
				
	}
	function guardar_recusar_abogado_motivo_abogado($motivo,$id_consulta,$idcolegio,$idusuario){

		$sql = "update consultas as c
				join abogados as a on a.IdAbogado = c.IdAbogado
				join matriculaciones as m on m.IdAbogado = a.IdAbogado
				
				set c.IdEstadoConsulta = 2
				where c.IdConsulta = ? and m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Recusado por Colegio de Abogados en consulta número '.$id_consulta;
		$mensaje .= ' Quien solicita: El Abogado';
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la recusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,2,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//2 = Recusada
				
	}	
	function guardar_recusar_abogado_motivo_cliente($motivo,$id_consulta,$idcolegio,$idusuario){
		
		$sql = "update consultas as c
				join abogados as a on a.IdAbogado = c.IdAbogado
				join matriculaciones as m on m.IdAbogado = a.IdAbogado
				
				set m.DeudaSorteo = m.DeudaSorteo + 1, c.IdEstadoConsulta = 2
				where c.IdConsulta = ? and m.IdColegio = ? ";				
		$query = $this->db->query($sql, array($id_consulta,$idcolegio));
		
		$mensaje = 'Recusado por Colegio de Abogados en consulta número '.$id_consulta;
		$mensaje .= ' Quien solicita: El Cliente';
		$mensaje .= ' Motivo: '.$motivo;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la recusacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,2,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//2 = Recusada
				
	}	
	function guardar_aceptar_causa($id_consulta,$idusuario){
		
		//marcamos la consulta como aceptada		
		$sql = "update consultas set IdEstadoConsulta = 7 where IdConsulta = ? ";				
		$query = $this->db->query($sql, array($id_consulta));
		
		$mensaje = 'Aceptación de abogado a consulta número '.$id_consulta;
		
		// Guardamos en el log_sorteos la excusacion 
		$sql = "INSERT log_estados_consultas(IdAbogado,Movimiento,IdConsulta,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idusuario,$mensaje,$id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
		
		// Guardamos en el movimientos_estados_consultas la aceptacion 
		$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdUsuario,IdEstado,created_at,updated_at)VALUES(?,?,?,?,?)";				
		$query = $this->db->query($sql, array($id_consulta,$idusuario,7,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));//7 = Aceptada
				
	}
	*/
}?>