<?php 
	

	class MisCasos{

		private $iduser;
		private $idAssgn;
		private $description;
		private $typeN;
		private $date;
		private $nameService;
		private $typeService;

		function __construct(){
			$this->db = Database::getInstance();
		}
		
		// function __construct(){
		// 	 $con=new Database();
		// 	 $this->db = $con->Connected();
		// }

		public function __SET($a, $v){
			return $this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function ListCasesPersonal_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Asunto, c.Descripcion, u.Nombre as Asignado, u.Apellidos, s.Nombre as Servicio, us.Nombre AS Asesor, us.Apellidos as Last_Asesor  FROM Asignados a INNER JOIN Usuarios u ON 
			(a.Usuarios_idUsuario=u.idusuario) INNER JOIN Servicio s ON (s.idServicio=a.Servicio_idServicio) INNER JOIN Casos c ON 
			(c.idCaso=a.Casos_idCaso) INNER JOIN Usuarios us ON (us.idUsuario=c.Usuarios_idUsuario) WHERE a.Usuarios_idUsuario = ? AND a.Estado=0;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function MyCasesCount_model(){
			$sql="SELECT COUNT(*) FROM Asignados WHERE Estado=0 AND Usuarios_idUsuario = ?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchColumn();
		}

		public function ShowMoreMyCases_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Archivo, c.Asunto, c.Descripcion, Date(c.Fecha_reg) as Fecha_reg, t.Nombre as Tipo, e.Nombre as Entorno 
			FROM Asignados a INNER JOIN Casos c ON (c.idCaso=a.Casos_idCaso) INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) INNER JOIN Entorno e ON 
			(t.Entorno_idEntorno=e.idEntorno) WHERE a.idAsignados=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ShowMoreMyAssineds_model(){
			$sql="SELECT c.idCaso, c.Nit, c.Cliente, c.Archivo, c.Asunto, c.Descripcion, Date(c.Fecha_reg) as Fecha_reg, t.Nombre as Tipo, e.Nombre 
			as Entorno FROM Casos c INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) INNER JOIN Entorno e ON (t.Entorno_idEntorno=e.idEntorno) WHERE c.idCaso=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function NoteMyCase_model(){
			$sql="SELECT * FROM Notas WHERE Asignados_idAsignados=? and Tipo_nota_idTipo_nota=1";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function EndMyscase_model(){
			$sql="UPDATE Asignados SET Estado=1, Fecha_fin=?, Tema_idTema=? WHERE idAsignados=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->date);
			$stm->bindparam(2, $this->theme);
			$stm->bindparam(3, $this->idAssgn);
			$stm->execute();
			return $stm;
		}

		public function NewNote_model(){
			$sql="INSERT INTO Notas (Nota, Asignados_idAsignados, Tipo_nota_idTipo_nota) SELECT ?,?,? FROM dual WHERE NOT EXISTS (SELECT * FROM Notas 
			WHERE Nota=? AND Asignados_idAsignados=?);";
			// $sql2="INSERT INTO Notas VALUES (NULL, ?,?,?)";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->description);
			$stm->bindparam(2, $this->idAssgn);
			$stm->bindparam(3, $this->typeN);
			$stm->bindparam(4, $this->description);
			$stm->bindparam(5, $this->idAssgn);
			$stm->execute();
			return $stm;
		}

		public function ListTheme(){
			$sql="SELECT t.*, ti.Nombre as Tipo, CONCAT(t.Nombre,' - ',ti.Nombre) as Tema 
			FROM Tema t INNER JOIN Tipo ti ON (t.Tipo_idTipo=ti.idTipo);";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function NoteFinCase_model(){
			$sql="SELECT * FROM Notas WHERE Asignados_idAsignados=? and Tipo_nota_idTipo_nota=2";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListClients_model(){
			$sql="SELECT DISTINCT(Nit) as Nit, Cliente FROM Casos;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListClientsComplete_model(){
			$sql="SELECT Nit, Cliente, Usuarios_idUsuario FROM Casos WHERE Nit=?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListMyAssigned_model(){
			$sql="SELECT a.*, c.idCaso, c.Nit, DATE(c.Fecha_reg) as fecha_registro, c.Cliente, c.Asunto, c.Descripcion, u.Nombre as Asignado, u.Apellidos, 
			s.Nombre as Servicio, us.Nombre AS Asesor, us.Apellidos as Last_Asesor  FROM Asignados a INNER JOIN Usuarios u ON
			(a.Usuarios_idUsuario=u.idusuario) INNER JOIN Servicio s ON(s.idServicio=a.Servicio_idServicio) RIGHT JOIN Casos c ON 
			(c.idCaso=a.Casos_idCaso) INNER JOIN Usuarios us ON (us.idUsuario=c.Usuarios_idUsuario) WHERE c.Usuarios_idUsuario=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function SaveService(){
			$sql="INSERT INTO Servicio VALUES (NULL, ?,?)";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->nameService);
			$stm->bindparam(2, $this->typeService);
			$stm->execute();
			return $stm;
		}

		public function ListService(){
			$sql="SELECT * FROM Servicio";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			$result=$stm->fetchAll();
			return $result; 
		}

		public function ReassignCase(){
			$sql="UPDATE Asignados SET Estado=2 WHERE idAsignados=?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm;
		}

	}


 ?>