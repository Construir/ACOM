<?php namespace App\Models;

use CodeIgniter\Model;

class Estado_consultas_modelo extends Model{
	
	protected $table      = 'estados_consultas';
	protected $primaryKey = 'IdEstadoConsulta';

	protected $returnType = 'array';
	protected $useSoftDeletes = true;

	protected $allowedFields = ['NombreEstadoConsulta', 'Estado', 'Suma', 'Aplica'];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = false;			
	
	function devolver_estados_consultas_por_usuario($id_perfil_usuario){
		
		if($id_perfil_usuario == 1){//abogado		

			$query = $this->query('SELECT * FROM estados_consultas where Aplica like "E" order by NombreEstadoConsulta asc');
			return $query->getResultArray();
			
		}else{//es un colegio o el administrador
						
			$query = $this->query('SELECT * FROM estados_consultas where Aplica like "R" order by NombreEstadoConsulta asc');
			return $query->getResultArray();
			
		}			

	}	
	function devolver_estados_consultas_con_filtro_tiempo(){
		
		$query = $this->query('SELECT * FROM estados_consultas where Aplica like "E" and IdEstadoConsulta not in (5) order by NombreEstadoConsulta asc');
		return $query->getResultArray();	
		
	}
	function devolver_estados_consultas_sin_filtro_tiempo(){
		
		$query = $this->query('SELECT * FROM estados_consultas where Aplica like "E" order by NombreEstadoConsulta asc');
		return $query->getResultArray();	
		
	}
}?>			