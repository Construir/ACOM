<?php namespace App\Models;

use CodeIgniter\Model;

class Localidades_modelo extends Model{
	
        protected $table      = 'localidades';
        protected $primaryKey = 'IdLocalidad';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['NombreLocalidad', 'Municipio', 'Departamento', 'Provincia', 'IdMunicipio', 'IdDepartamento', 'IdProvincia', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function devolver_localidades_por_colegio($idColegio){
			
			$sql = "SELECT * FROM localidades where IdDepartamento = ?";						
			
			$query = $this->db->query($sql, array($idColegio));
			return $query->getResultArray();			
			
		}
		function devolver_departamentos(){
			$query = $this->query('SELECT * FROM localidades order by NombreLocalidad asc');
			return $query->getResultArray();
		}
		function devolver_localidades(){
			$query = $this->query('SELECT * FROM localidades order by NombreLocalidad asc');
			return $query->getResultArray();
		}
		function devolver_localidades_x_partido($partido){
			
			$sql = "SELECT * 
					FROM municipios as m
					join localidades as l on l.IdMunicipio = m.IdMunicipio
					where Id = ? and l.Estado = 1
					order by NombreLocalidad asc";						
			
			$query = $this->db->query($sql, array($partido));
			return $query->getResultArray();
			
		}
		function devolver_localidades_por_partido($partido){
			
			$sql = "SELECT * 
					FROM municipios as m
					join localidades as l on l.IdMunicipio = m.IdMunicipio
					where Id = ?
					order by NombreLocalidad asc";						
			
			$query = $this->db->query($sql, array($partido));
			return $query->getResultArray();
			
		}
		function deshabilitar_localidad($idlocalidad){
			
			$sql = "update localidades set Estado = 0 where IdLocalidad = ?";										
			$query = $this->db->query($sql, array($idlocalidad));
			
		}
		function habilitar_localidad($idlocalidad){
			
			$sql = "update localidades set Estado = 1 where IdLocalidad = ?";										
			$query = $this->db->query($sql, array($idlocalidad));
			
		}

}?>