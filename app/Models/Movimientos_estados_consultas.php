<?php namespace App\Models;

use CodeIgniter\Model;

class Movimientos_estados_consultas extends Model{
	
        protected $table      = 'movimientos_estados_consultas';
        protected $primaryKey = 'IdMovimientoEstadoConsulta';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdConsulta', 'IdUsuario', 'IdEstado', 'Motivo'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>