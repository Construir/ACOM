<?php namespace App\Models;

use CodeIgniter\Model;

class Consultantes_modelo extends Model{
	
        protected $table = 'consultantes';
        protected $primaryKey = 'IdConsultante';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['Cuit', 'Apellido', 'Nombre', 'Telefono', 'Celular', 'Email', 'IdProvincia', 'IdPartido', 'IdLocalidad', 'Calle', 'Numero', 'Piso', 'Departamento', 'Detalle', 'IdTipoConsulta', 'IdAbogado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;	

}?>