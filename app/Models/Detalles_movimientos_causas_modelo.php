<?php namespace App\Models;

use CodeIgniter\Model;

class Detalles_movimientos_causas_modelo extends Model{
	
        protected $table      = 'detalles_movimientos_causas';
        protected $primaryKey = 'IdDetalleMovimiento';

        protected $returnType = 'array';
        protected $useSoftDeletes = true;

        protected $allowedFields = ['IdConsulta', 'IdTipoTramite', 'RazonSocialEmpleador', 'CuitEmpleador', 'TelefonoEmpleador', 'CelularEmpleador', 'EmailEmpleador', 'Notas', 'FechaIncidente', 'FechaAudienciaConAseguradora', 'FechaEntrevistaConTrabajador', 'FechaInicioTramite', 'NumeroExpediente', 'EstudioComplementarios', 'DocumentacionComplementaria', 'SolicitudProrroga', 'FechaAudienciaMedica', 'PlanteoAlegato', 'FechaDictamenMedico', 'IdMotivoFinalizacionTramite', 'FechaAudienciaAcuerdo', 'ResultadoAudiencia', 'FechaActoClausura', 'ApeloComisionMedicaCentral', 'FechaApelacionComisionMedicaCentral', 'FechaApelacionComicionMedicaCentral', 'FechaFinalizacionComisionMedicaCentral', 'ResultadoComisionMedicaCentral', 'ApeloJusticiaOrdinaria', 'FechaApelacionJusticiaOrdinaria', 'Juzgado', 'NumeroExpedienteJusticiaOrdinaria', 'Caratula', 'FechaSentenciaJusticiaOrdinaria', 'ResultadoSentenciaJusticiaOrdinaria', 'FechaResultadoSentenciaJusticiaOrdinaria', 'ResultadoJusticiaOrdinaria', 'Estado'];

        protected $useTimestamps = true;
        protected $createdField  = 'created_at';
        protected $updatedField  = 'updated_at';
        protected $deletedField  = 'deleted_at';

        protected $validationRules    = [];
        protected $validationMessages = [];
        protected $skipValidation     = false;
		
		function modificar_datos_gestion_administrativa($id_consulta,$tipoconsulta,$fecha_incidente,$fecha_audincia_con_aseguradora,$fecha_entrevista_con_trabajador,
														$fecha_inicio_tramite,$numero_expediente,$solicitud_de_estudios_médicos_complementarios,
														$solicitud_de_documentacion_complementaria,$solicitud_de_prorroga,$fecha_audiencia_medica,
														$planteo_alegato,$fecha_dictamen_medico,$desplegable_motivo_finalizacion_tramite,
														$fecha_acto_clausura,$fecha_de_audiencia_de_acuerdo,$resultado_de_la_audiencia_con_acuerdo){
		
			$sql = "update detalles_movimientos_causas 			
					set IdTipoTramite = ?,FechaIncidente = ?,FechaAudienciaConAseguradora = ?,FechaEntrevistaConTrabajador = ?,FechaInicioTramite = ?,NumeroExpediente = ?,EstudioComplementarios = ?,DocumentacionComplementaria = ?,SolicitudProrroga = ?,FechaAudienciaMedica = ?,PlanteoAlegato = ?,FechaDictamenMedico = ?,IdMotivoFinalizacionTramite = ?,FechaAudienciaAcuerdo = ?, ResultadoAudiencia = ? 
					where IdConsulta = ?";	
					
			$query = $this->db->query($sql, array($tipoconsulta,$fecha_incidente,$fecha_audincia_con_aseguradora,$fecha_entrevista_con_trabajador,
												  $fecha_inicio_tramite,$numero_expediente,$solicitud_de_estudios_médicos_complementarios,
												  $solicitud_de_documentacion_complementaria,$solicitud_de_prorroga,$fecha_audiencia_medica,
												  $planteo_alegato,$fecha_dictamen_medico,$desplegable_motivo_finalizacion_tramite,
												  $fecha_acto_clausura,$fecha_de_audiencia_de_acuerdo,$resultado_de_la_audiencia_con_acuerdo,$id_consulta));
						
		} 
}?>