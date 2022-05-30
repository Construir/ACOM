<?php namespace App\Models;

use CodeIgniter\Model;

class Log_ejecucion_tares_programadas_modelo extends Model{
	
        protected $table      = 'log_ejecucion_tares_programadas';
        protected $primaryKey = 'IdLogEjecucionTareasProgramadas';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdTipoTarea', 'NombreTarea', 'FechaEjecucion'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		
	
	function devolver_tarea_de_hoy($id_tipo_tarea){
		
		$sql = "SELECT * FROM log_ejecucion_tares_programadas where IdTipoTarea = ? and FechaEjecucion = ?";						
			
		$query = $this->db->query($sql, array($id_tipo_tarea,date("Y-m-d")));
		return $query->getResultArray();			
			
	}
}?>