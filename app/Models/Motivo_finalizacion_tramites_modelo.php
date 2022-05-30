<?php namespace App\Models;

use CodeIgniter\Model;

class Motivo_finalizacion_tramites_modelo extends Model{
	
        protected $table      = 'motivo_finalizacion_tramite';
        protected $primaryKey = 'IdMotivoFinalizacion';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreMotivoFinalizacion', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

		function devolver_motivos_de_finalizacion($tipoconsulta){
		
			if($tipoconsulta <= 4){
				$query = $this->query('SELECT * FROM motivo_finalizacion_tramite where IdMotivoFinalizacion in (1,2,3) order by NombreMotivoFinalizacion asc');
			}else{
				$query = $this->query('SELECT * FROM motivo_finalizacion_tramite where IdMotivoFinalizacion in (4,5) order by NombreMotivoFinalizacion asc');
			}	
			return $query->getResultArray();			
			
		}
}?>