<?php namespace App\Models;

use CodeIgniter\Model;

class Sorteos_modelo extends Model{
	
    function sortear_abogado($Cuit,$Apellido,$Nombre,$Telefono,$Celular,$Email,$IdProvincia,$IdPartido,$Idlocalidad,
							 $Calle,$Numero,$Piso,$Departamento,$Detalle,$IdTipoConsulta,$Idusuario){
		
		$this->db->transBegin();
		
		$sorteo_ok = false;		
							 
		do{
			
			$sql = 'select  m.IdMatriculacion, m.IdColegio, a.IdAbogado, a.nombre, a.apellido,a.cuit,m.tomo,m.folio,depto.NombreDepartamento,depto.Acronimo, m.FueSorteado,m.DeudaSorteo,tem.NombreTipoEstado 
				
				FROM abogados as a 
				join matriculaciones as m on a.IdAbogado = m.IdAbogado and m.FueSorteado = 0
				join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from estado_matriculas where FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula = m.IdMatriculacion 
				join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual
				join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado
				join departamentos as depto on depto.IdDepartamento = m.IdColegio
				join (select max(IdDomicilio) as ultimoDom, IdMatriculacion from domicilios where Estado = 1  group by IdMatriculacion )
				as ultimodomicilio on ultimodomicilio.IdMatriculacion = m.IdMatriculacion 
				join domicilios as d on d.IdDomicilio = ultimodomicilio.ultimoDom 

				where m.deleted_at is null
				and em.IdTipoEstado = 2
				and d.IdPartido = ?
				and a.Cuit not in (SELECT abogado.Cuit 
								   from consultas as c 
								   join consultantes as cliente on cliente.IdConsultante = c.IdConsultante
								   join abogados as abogado on abogado.IdAbogado = c.IdAbogado
								   WHERE cliente.Cuit = ?)
								   
				order by m.DeudaSorteo desc, FueSorteado asc, rand() LIMIT 1';
				
				$query = $this->db->query($sql, array($IdPartido,$Cuit));				
				$abogado = $query->getResultArray();
		
			if(!empty($abogado)){
				
				//SI tengo abogado para asignar me fijo si esta por anulacion de sorteo entonces no lo saco del listado y le decremento la cantidad de nulas que tenia asi baja la prioridad de ser asignado.
				if($abogado[0]['DeudaSorteo'] > 0){						
					
					//actualizamos la deuda
					$sql = "update matriculaciones set DeudaSorteo = DeudaSorteo-1 where IdAbogado = ? and IdColegio = ?";				
					$query = $this->db->query($sql, array($abogado[0]['IdAbogado'],$abogado[0]['IdColegio']));				
					
					$mensaje = 'Nuevo Sorteo DEVUELTO. Se decremento el campo deudaSorteo en 1';
					
				}else{
					
					//marcamos como sorteado
					$sql = "update matriculaciones set fueSorteado = 1 where IdAbogado = ? and IdColegio = ?";				
					$query = $this->db->query($sql, array($abogado[0]['IdAbogado'],$abogado[0]['IdColegio']));
					
					$mensaje = 'Nuevo Sorteo NORMAL. Se cambio el campo fueSorteado a 1';
					
				}
				
				// Guardamos en el log_sorteos 
				$sql = "INSERT log_sorteos(IdAbogado,IdPartido,Detalle,created_at,updated_at)VALUES(?,?,?,?,?)";				
				$query = $this->db->query($sql, array($abogado[0]['IdAbogado'],$IdPartido,$mensaje,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
				
				//Guardamos el consultante
				$sql = "INSERT consultantes(Cuit, Apellido, Nombre, Telefono, Celular, Email, IdProvincia, IdPartido, IdLocalidad, Calle, Numero, Piso, Departamento,Detalle,IdTipoConsulta,IdAbogado,created_at,updated_at)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";				
											 
				$query = $this->db->query($sql, array($Cuit,$Apellido,$Nombre,$Telefono,$Celular,$Email,$IdProvincia,$IdPartido,$Idlocalidad,$Calle,$Numero,$Piso,$Departamento,$Detalle,$IdTipoConsulta,$abogado[0]['IdAbogado'],date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
											 
				$id_consultante = $this->db->insertID(); 

				//Guardamos la consultas
				$sql = "INSERT consultas(IdTipoConsulta,IdConsultante,IdAbogado,IdMatriculacion,IdEstadoConsulta,IdPartido,IdLocalidad,Descripcion,Pregunta,Respuesta,CodigoVerificacion,RazonSocialEmpleador,DomicilioLaboral,TelefonoEmpleador,FechaSorteo,created_at,updated_at)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";			
				$query = $this->db->query($sql, array($IdTipoConsulta,$id_consultante,$abogado[0]['IdAbogado'],$abogado[0]['IdMatriculacion'],4,$IdPartido,$Idlocalidad,$Detalle,NULL,NULL,NULL,NULL,NULL,NULL,date('Y-m-d H:i:s'),date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));	
						
				$id_consulta = $this->db->insertID(); 
				
				// Guardamos en el movimientos_estados_consultas el estado inicial de la causa 
				$sql = "INSERT movimientos_estados_consultas(IdConsulta,IdEstado,created_at,updated_at)VALUES(?,?,?,?)";				
				$query = $this->db->query($sql, array($id_consulta,4,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));// 4 = Sin Respuesta	

				// Creamos un registro en Detalles Movimientos Causas para guardar los datos del seguimiento
				$sql = "INSERT detalles_movimientos_causas(IdConsulta,created_at,updated_at)VALUES(?,?,?)";				
				$query = $this->db->query($sql, array($id_consulta,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));				
				
				$sorteo_ok = true;
								
			}else{

				//Reinicimos el campo FueSorteado para todos los abogados de ese partido
				$sql = "update matriculaciones as m
						join domicilios as d on d.IdMatriculacion = m.IdMatriculacion
						set FueSorteado = 0 
						where d.IdPartido = ?";				
				$query = $this->db->query($sql, array($IdPartido));
				
				//Guardamos en el log el reinicio del partido
				$sql = "INSERT log_sorteos(IdAbogado,IdPartido,Detalle,created_at,updated_at)VALUES(?,?,?,?,?)";				
				$query = $this->db->query($sql, array(0,$IdPartido,'Se reinicia el campo fueSorteado para TODOS los abogados del Partido',date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));
				
			}
			
		} while($sorteo_ok == false);
		
		if ($this->db->transStatus() === FALSE){
			
			$this->db->transRollback();			
			return 0;	
		}else{
			
			$this->db->transCommit();
			return $id_consulta;
			
		}		
		
		//return $id_consulta;
	} 
	
    function devolver_sorteo($cuit){
	  
		$sql = "SELECT * 
				FROM consultantes as cliente
				join consultas as co on co.IdConsultante = cliente.IdConsultante
				join (select max(IdMovimientoEstadoConsulta) as ultimoEstado,IdConsulta from movimientos_estados_consultas group by IdConsulta)
				as Tablaultimoestado on Tablaultimoestado.IdConsulta = co.IdConsulta 
				join movimientos_estados_consultas as mec on mec.IdMovimientoEstadoConsulta = Tablaultimoestado.ultimoEstado
							
				where cliente.Cuit = ? and DATE_ADD(FechaSorteo,INTERVAL 10 DAY) >= now() and mec.IdEstado not in(1,2,3,5)";						
			
		$query = $this->db->query($sql, array($cuit));
		return $query->getResultArray();
		
    }   
/*
	function devolver_sorteo($cuit){
	  
		$sql = "SELECT * 
				FROM consultantes as cliente
				join consultas as co on co.IdConsultante = cliente.IdConsultante
				
				where cliente.Cuit = ? and DATE_ADD(FechaSorteo,INTERVAL 10 DAY) >= now()";						
			
		$query = $this->db->query($sql, array($cuit));
		return $query->getResultArray();
		
    }
	*/
	function devolver_sorteos_x_matricula($idmatricula){
		
		$sql = "SELECT *
				FROM consultas as c
				join matriculaciones as m on c.IdMatriculacion = m.IdMatriculacion
				where m.IdMatriculacion = ?";
								
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();						

	}
	/*
	function devolver_sorteos_x_matricula($idmatricula){
		
		$sql = "SELECT *
				FROM consultas as c
				join matriculaciones as m on c.IdAbogado = m.IdAbogado
				where m.IdMatriculacion = ?";
								
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();						

	}	
	*/
}?>