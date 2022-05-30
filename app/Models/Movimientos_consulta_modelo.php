<?php namespace App\Models;

use CodeIgniter\Model;

class Movimientos_consulta_modelo extends Model{
	
        protected $table      = 'movimientos_consultas';
        protected $primaryKey = 'IdMovimientoConsulta';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdConsulta', 'Titulo', 'IdTipoMovimiento', 'FechaMovimiento', 'Detalle'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		


}?>