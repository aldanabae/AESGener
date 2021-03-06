<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planilla_model extends CI_Model {
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function crearPlanilla($ruta, $fecha, $anio, $mes, $tipoP, $sesion){
		$idEmpleado = $sesion['idEmpleado'];

		$this->db->insert('planilla', 
			array('url'=>$ruta, 
					'dia'=>$fecha['mday'], 
					'mes'=>$mes, 
					'anio'=>$anio,
					'idEmpleado'=>$idEmpleado,
					'idTipoPlanilla'=> $tipoP));
		$idPlanilla = $this->db->insert_id();
		return $idPlanilla;
	}

	function getKPI($nomKPI){
		$this->db->select('*');
		$this->db->where('kpi.abreviaturaKPI', $nomKPI);
		$this->db->from('kpi');
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	function obtenerMeses(){
		$this->db->select('*');
		$this->db->from('mes');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
			else return false;	
	}

	function obtenerTiposPlanillas(){
		$this->db->select('*');
		$this->db->from('tipo_planilla');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
			else return false;	
	}

	function obtenerDivisionesSAP(){
		$this->db->select('*');
		$this->db->from('division_sap');
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query;
			else return false;
	}

	function obtenerDivision($idDivisionSAP){
		$this->db->select('*');
		$this->db->where('idDivSAP', $idDivisionSAP);
		$this->db->from('division_sap');

		$query = $this->db->get();

		if ($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	function obtenerParametro($idDivSAP){
		$this->db->select('*');
		$this->db->where('idDivSAP', $idDivSAP);
		$this->db->where('activo', 1);
		$this->db->from('parametro');
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	function buscarUbicacion($fi, $col, $idKPI){
		$this->db->select('*');
		$this->db->where('ubicacion.idKPI', $idKPI);
		$this->db->where('ubicacion.letra', $col);
		$this->db->where('ubicacion.nro', $fi);
		$this->db->from('ubicacion');
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	function buscarUbicacionKPI($idKPI){
		$this->db->select('*');
		$this->db->where('ubicacion.idKPI', $idKPI);
		$this->db->where('ubicacion.idUnidadGen', 0);
		$this->db->where('ubicacion.idDivision', 0);
		$this->db->where('ubicacion.idComplejo', 0);
		$this->db->where('ubicacion.idPlanta', 0);
		$this->db->from('ubicacion');
		$query = $this->db->get();

		if ($query->num_rows() > 0){
			foreach ($query->result() as $fila){
				$data[] = $fila;
			}	
			return $data;
		}else{
			return false;
		}
	}

	function crearLineaMTBF($mtbf, $mtbfTarget, $tsf, $idUnidadGen, $idPlanilla, $idKPI){
		$this->db->insert('linea_mtbf', 
			array('mtbf'=>$mtbf, 
					'mtbfTarget'=>$mtbfTarget, 
					'tsf'=>$tsf,
					'idUnidadGen'=>$idUnidadGen,
					'idPlanilla'=> $idPlanilla,
					'idKPI'=> $idKPI));
		$idLineaMTBF = $this->db->insert_id();
		return $idLineaMTBF;
	}

	function crearLineaCostos($ctmActual, $ctmBudget, $idDivision, $idComplejo, $idPlanilla, $idKPI){
		$this->db->insert('linea_costos', 
			array('ctmActual'=>$ctmActual, 
					'ctmBudget'=>$ctmBudget, 
					'idDivision'=>$idDivision,
					'idComplejo'=>$idComplejo,
					'idPlanilla'=> $idPlanilla,
					'idKPI'=> $idKPI));
		$idLineaCostos = $this->db->insert_id();
		return $idLineaCostos;
	}

	function crearLineaAES($actualMes, $targetMes, $ytdActual, $ytdTarget, $fyf, $fyBudget, $hedp, $hedf, $hsf,
                            $idUnidadGen, $idDivision, $idComplejo, $idPlanta, $idPlanilla, $idKPI){
		$this->db->insert('linea_aes', 
			array('actualMes'=>$actualMes, 
					'targetMes'=>$targetMes,
					'ytdActual'=>$ytdActual,
					'ytdTarget'=>$ytdTarget,
					'fyf'=>$fyf,
					'fyBudget'=>$fyBudget,
					'hedp'=>$hedp,
					'hedf'=>$hedf,
					'hsf'=>$hsf,
					'idUnidadGen'=>$idUnidadGen, 
					'idDivision'=>$idDivision,
					'idComplejo'=>$idComplejo,
					'idPlanta'=> $idPlanta,
					'idPlanilla'=> $idPlanilla,
					'idKPI'=> $idKPI));
		$idLineaAES = $this->db->insert_id();
		return $idLineaAES;
	}

	function crearLineaSAP($hsPlanificadasBL, $hsEjecutadasBL, $hsPendientesBL, $backlogReal, $hsTrabRealTotal, 
                            $hsTRCorrectivo, $hsTRPreventivo, $hsDispMensual, $hsTRPlanificadas, 
                            $cantOTCompletas, $cantOTs, $trabajoProactivo, $idDivisionSAP, $idPlanilla, $idKPI){
		$this->db->insert('linea_sap', 
			array('hsPlanificadasBL'=>$hsPlanificadasBL, 
					'hsEjecutadasBL'=>$hsEjecutadasBL,
					'hsPendientesBL'=>$hsPendientesBL,
					'backlogReal'=>$backlogReal,
					'hsTrabRealTotal'=>$hsTrabRealTotal,
					'hsTRCorrectivo'=>$hsTRCorrectivo,
					'hsTRPreventivo'=>$hsTRPreventivo,
					'hsDispMensual'=>$hsDispMensual,
					'hsTRPlanificadas'=>$hsTRPlanificadas,
					'cantOTCompletas'=>$cantOTCompletas, 
					'cantOTs'=>$cantOTs,
					'trabajoProactivo'=>$trabajoProactivo,
					'idDivSAP'=>$idDivisionSAP,
					'idPlanilla'=> $idPlanilla,
					'idKPI'=> $idKPI));
		$idLineaSAP = $this->db->insert_id();
		return $idLineaSAP;
	}

	function borrarPlanilla($idPlanilla){
		$this->db->delete('planilla',array('idPlanilla'=>$idPlanilla));
	}	
}


