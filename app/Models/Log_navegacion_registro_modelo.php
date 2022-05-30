<?php namespace App\Models;

use CodeIgniter\Model;

class Log_navegacion_registro_modelo extends Model{
	
        protected $table      = 'log_navegacion_registro';
        protected $primaryKey = 'IdLogNavegacionRegistro';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

       // protected $allowedFields = ['IdUsuario', 'Fecha', 'Navegador', 'SistemaOperativo', 'Ip'];
		protected $allowedFields = ['IdUsuario', 'Fecha', 'Navegador', 'SistemaOperativo', 'Ip', 'Apellido', 'Nombre', 'Telefono', 'Cuit', 'IdColegio', 'Matricula', 'Tomo', 'Folio', 'IdProvincia', 'IdPartido', 'IdLocalidad', 'Calle', 'Numero', 'Piso', 'Oficina', 'Email', 'HorariosAtencion'];
        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;		

}?>