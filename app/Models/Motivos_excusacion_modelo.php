<?php namespace App\Models;

use CodeIgniter\Model;

class Motivos_excusacion_modelo extends Model{
	
        protected $table      = 'motivos_excusacion';
        protected $primaryKey = 'IdMotivoExcusacion';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreMotivoExcusacion', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>