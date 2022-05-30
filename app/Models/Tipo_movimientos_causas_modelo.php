<?php namespace App\Models;

use CodeIgniter\Model;

class Tipo_movimientos_causas_modelo extends Model{
	
        protected $table      = 'tipos_movimientos_causa';
        protected $primaryKey = 'IdTipoMovimiento';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreTipoMovimiento'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		


}?>