<?php namespace App\Models;

use CodeIgniter\Model;

class Log_cambios_de_estados_localidades extends Model{
	
        protected $table      = 'log_cambios_de_estados_localidades';
        protected $primaryKey = 'IdLogCambioEstadoLocalidad';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdUsuario', 'IdLocalidad', 'NuevoEstado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>