<?php 
	

	class Historial {

		private $idAssgn;
		private $role;

		function __construct(){
			$this->db = Database::getInstance();
		}

		public function __SET($a, $v){
			return $this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function ListHistory_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Asunto, c.Descripcion, u.Nombre as Asignado, u.Apellidos, s.Nombre as Servicio, us.Nombre AS Asesor, 
			us.Apellidos as Last_Asesor, t.Nombre as Tipo, a.Estado  FROM Asignados a INNER JOIN Usuarios u ON (a.Usuarios_idUsuario=u.idusuario) 
			INNER JOIN Servicio s ON (s.idServicio=a.Servicio_idServicio) INNER JOIN Casos c ON (c.idCaso=a.Casos_idCaso) INNER JOIN Usuarios us ON 
			(us.idUsuario=c.Usuarios_idUsuario) INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) INNER JOIN Entorno e ON
			(t.Entorno_idEntorno=e.idEntorno) WHERE a.Estado=1;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ShowMoreSolution_model(){
			$sql='SELECT a.idAsignados, c.Fecha_reg as Registro, a.Fecha_fin as Fin, TIMESTAMPDIFF(HOUR, c.Fecha_reg, a.Fecha_fin) as
			diffHour, TIMESTAMPDIFF(DAY, c.Fecha_reg, a.Fecha_fin) as diffDay, TIMESTAMPDIFF(Minute, c.Fecha_reg, a.Fecha_fin) as
			diffMin ,c.idCaso, n.Nota, te.Nombre as Tema, ti.Nombre as Tipo FROM Asignados a INNER JOIN Casos c ON (a.Casos_idCaso=c.idCaso) 
			INNER JOIN Notas n ON (a.idAsignados=n.Asignados_idAsignados) INNER JOIN Tema te ON (te.idTema=a.Tema_idTema) 
			INNER JOIN Tipo ti ON (ti.idTipo=te.Tipo_idTipo)WHERE n.Tipo_nota_idTipo_nota=2 AND a.idAsignados=?;';
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function getGraphics(){
			$sql='SELECT count(idAsignados) as n_casos, concat(u.Nombre," ", u.Apellidos) as nombre 
			FROM asignados a INNER JOIN usuarios u ON (u.idUsuario=a.Usuarios_idUsuario)
			WHERE a.estado=1 AND u.Rol_idRol=? AND u.Estado=0 GROUP BY a.Usuarios_idUsuario 
			ORDER BY n_casos desc';
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->role);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function pieTheme(){
			$sql='SELECT count(a.idAsignados) as n_casos, ti.Nombre FROM asignados a 
			INNER JOIN tema t ON(a.Tema_idTema=t.idTema) INNER JOIN tipo ti ON (t.Tipo_idTipo=ti.idTipo) 
			WHERE a.Estado=1 GROUP BY ti.idTipo;';
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}
	}


 ?>