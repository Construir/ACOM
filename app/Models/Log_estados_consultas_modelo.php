<?php namespace App\Models;

use CodeIgniter\Model;

class Log_estados_consultas_modelo extends Model{
	
        protected $table      = 'log_estados_consultas';
        protected $primaryKey = 'IdLogEstadoConsulta';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdEstadoConsulta', 'IdConsulta', 'IdAbogado', 'Movimiento'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>