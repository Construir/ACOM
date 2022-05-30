<?php namespace App\Models;

use CodeIgniter\Model;

class Requirentes_modelo extends Model{
	
        protected $table      = 'requirentes';
        protected $primaryKey = 'IdRequirente';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['Cuit', 'Apellido', 'Nombre', 'Telefono', 'Celular', 'Email', 'IdProvincia', 'IdPartido', 'IdLocalidad', 'Calle', 'Numero', 'Piso', 'Departamento', 'Detalle', 'IdAbogado', 'IdTipoConsulta'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>