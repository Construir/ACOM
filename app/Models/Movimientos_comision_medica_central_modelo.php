<?php namespace App\Models;

use CodeIgniter\Model;

class Movimientos_comision_medica_central_modelo extends Model{
	
        protected $table      = 'movimientos_comision_medica_central';
        protected $primaryKey = 'IdMovimiento';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdConsulta', 'FechaMovimiento', 'Detalle'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
			
		function eliminar_movimiento_comision_medica_central($id_consulta,$id_movimiento){
							
			$sql = "update movimientos_comision_medica_central 
					set deleted_at = ?
					where IdConsulta = ? and IdMovimiento = ?";						
			$query = $this->db->query($sql, array(date("Y-m-d h:i:s"),$id_consulta,$id_movimiento));
	
		}
}?>