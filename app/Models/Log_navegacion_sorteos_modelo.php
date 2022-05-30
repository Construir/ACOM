<?php namespace App\Models;

use CodeIgniter\Model;

class Log_navegacion_sorteos_modelo extends Model{
	
        protected $table      = 'log_navegacion_sorteos';
        protected $primaryKey = 'IdLogNavegacion';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdUsuario', 'Fecha', 'Navegador', 'SistemaOperativo', 'Ip'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>