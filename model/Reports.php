<?php 

	class Reports{

		private $monthIni;
		private $monthFin;

		function __construct(){
			$this->db=Database::getInstance();
		}

		public function __SET($a, $v){
			return $this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function CasosMesActual(){
			$sql="SELECT c.Nit, c.Cliente, MONTH(c.Fecha_reg) as mes,  Date(c.Fecha_reg) as fecha, u.Nombre, u.Apellidos, a.Estado FROM Casos c 
			LEFT JOIN Usuarios u ON(c.Usuarios_idUsuario=u.idUsuario) LEFT JOIN asignados a ON (c.idCaso=a.Casos_idCaso) WHERE
			MONTH(c.Fecha_reg) = MONTH(NOW());";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function CasosPorRango(){
			$sql="SELECT c.*, a.Estado, MONTH(c.Fecha_reg) as mes, DAY(c.Fecha_reg) as day,  Date(c.Fecha_reg) as fecha, u.Nombre, u.Apellidos FROM Casos c LEFT JOIN Usuarios u ON 
			(c.Usuarios_idUsuario=u.idUsuario) LEFT JOIN asignados a ON (c.idCaso=a.Casos_idCaso) WHERE MONTH(c.Fecha_reg) BETWEEN ? AND ? ORDER BY day ASC";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->monthIni);
			$stm->bindparam(2, $this->monthFin);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListaNCasos(){
			$sql="SELECT Nit, Cliente, COUNT(*) as n_casos FROM Casos group by Cliente ORDER BY n_casos desc;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function CasosPorAsesor(){
			$sql="SELECT u.Nombre, u.Apellidos, Count(*) as n_casos FROM casos c INNER JOIN usuarios u ON (c.Usuarios_idUsuario=u.idUsuario) 
			GROUP BY u.Nombre, u.Apellidos ORDER BY n_casos DESC;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function CasosRegistrados(){
			$sql="SELECT c.Nit, c.Cliente, Date(c.Fecha_reg) as fecha, a.Estado, t.Nombre as Tema FROM Casos c LEFT JOIN Asignados a ON 
			(c.idCaso=a.Casos_idCaso) LEFT JOIN Tema t ON (t.idTema=a.Tema_idTema);";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	}

 ?>