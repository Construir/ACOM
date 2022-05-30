<?php namespace App\Models;

use CodeIgniter\Model;

class Estado_matricula_modelo extends Model{
	
	protected $table      = 'estado_matriculas';
	protected $primaryKey = 'IdEstadoMatricula';

	protected $returnType = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['FechaInicio','IdTipoEstado', 'IdMatricula', 'IdUsuario', 'Motivo'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;	
	
	function guardar_estado_matricula($idmatricula,$fecha_desde,$idusuario,$estado,$motivo){
		
		$sql = "INSERT estado_matriculas(IdMatricula,FechaInicio,IdUsuario,IdTipoEstado,Motivo,created_at,updated_at)VALUES(?,?,?,?,?,?,?)";				
		$query = $this->db->query($sql, array($idmatricula,$fecha_desde,$idusuario,$estado,$motivo,date('Y-m-d H:i:s'),date('Y-m-d H:i:s')));		
		return $this->db->insertID();
		
	}
	/*
	function actualizar_estado_matricula($idmatricula,$idusuario,$estado){
		
		$sql = "update estado_matriculas set FechaInicio = ?, IdTipoEstado = ?, IdUsuario = ? where IdMatricula = ?";				
		$query = $this->db->query($sql, array(date('Y-m-d H:i:s'),$estado,$idusuario,$idmatricula));
		return $query->getResultArray();
	}	
	*/
	/*
	function desaprobar_matricula($idmatricula,$idusuario,$motivo){
		
		$sql = "update estado_matriculas set FechaInicio = ?, IdTipoEstado = 3, Motivo = ?, IdUsuario = ? where IdMatricula = ?";				
		$query = $this->db->query($sql, array(date('Y-m-d H:i:s'),$motivo,$idusuario,$idmatricula));
		return $query->getResultArray();
	}
	*/
	function devolver_ultimo_estado_matricula($idmatricula){
			
		$sql = "select *			   
				from matriculaciones as m
			    join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from  estado_matriculas where  FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula = m.IdMatriculacion 
				join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual	 
				where m.IdMatriculacion = ? and em.IdTipoEstado not in (4,5,7)";
				
				/*
				4 = SUSPENDIDO POR COLEGIO						
				5 = SUSPENDIDO A PEDIDO DEL ABOGADO						
				7 = ELIMINADO						
				*/
				
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();
		
	}	
	function devolver_ultimo_estado_matricula_abogado($idmatricula){
			
		$sql = "select *			   
				from matriculaciones as m
			    join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from  estado_matriculas where  FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula = m.IdMatriculacion 
				join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual	 
				where m.IdMatriculacion = ? and em.IdTipoEstado not in (6)";
				
				/*
				4 = SUSPENDIDO POR COLEGIO						
				5 = SUSPENDIDO A PEDIDO DEL ABOGADO						
				7 = ELIMINADO						
				*/
				
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();
		
	}
	function devolver_ultimo_estado_de_licencia($idmatricula){
			
		$sql = "select *			   
				from matriculaciones as m
			    join (select max(IdEstadoMatricula) IdEstadoActual, idMatricula from  estado_matriculas where  FechaInicio<=now() group by idMatricula ) as ultimoEstado on ultimoEstado.idMatricula = m.IdMatriculacion 
				join estado_matriculas as em on em.IdEstadoMatricula = ultimoEstado.IdEstadoActual	 
				where m.IdMatriculacion = ? and em.IdTipoEstado = 6";
				
				/*
				6 = LICENCIA										
				*/
				
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();
		
	}
	function devolver_movimiento_matricula($idmatricula){
			
		$sql = "SELECT tem.NombreTipoEstado,em.*								  
			   
				FROM estado_matriculas as em
			    join tipo_estados_matricula as tem on tem.IdTiposEstadoMatricula = em.IdTipoEstado	 
				where IdMatricula = ? 
				order by FechaInicio asc";						
		
		$query = $this->db->query($sql, array($idmatricula));
		return $query->getResultArray();
		
	}
		
		
}?>			