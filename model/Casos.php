<?php 
	
	class Casos{

		private $idEnv;
		private $nit;
		private $cliente;
		private $asunto;
		private $desc;
		private $soft;
		private $fecha;
		private $asesor;
		private $files;

		private $idcaso;
		private $iduser;
		private $service;

		private $note;
		private $typeNote;
		private $codAssgn;
		private $typeTheme;
		private $theme;

		function __construct(){
			$this->db = Database::getInstance();
		}

		public function __SET($a, $v){
			return $this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function ListEnviroment(){
			$sql="SELECT * FROM Entorno";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListType(){
			$sql="SELECT * FROM Tipo WHERE Entorno_idEntorno=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idEnv);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListAllType(){
			$sql="SELECT * FROM Tipo";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListAC_model(){
			$sql="SELECT * FROM Usuarios WHERE Rol_idRol=3 AND Estado=0";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function SaveCase_model(){
			$sql2="INSERT INTO Casos (Nit, Cliente, Asunto, Descripcion, Fecha_reg, Usuarios_idUsuario, Tipo_idTipo, Archivo) SELECT ?,?,?,?,?,?,?,? FROM dual
			WHERE NOT EXISTS (SELECT * FROM Casos WHERE Descripcion=?)";
			$sql='INSERT INTO Casos VALUES (NULL, ?,?,?,?,?,?,?,?);';
			$stm=$this->db->prepare($sql2);
			$stm->bindparam(1 , $this->nit);
			$stm->bindparam(2 , $this->cliente);
			$stm->bindparam(3 , $this->asunto);
			$stm->bindparam(4 , $this->desc);
			$stm->bindparam(5 , $this->fecha);
			$stm->bindparam(6 , $this->asesor);
			$stm->bindparam(7 , $this->soft);
			$stm->bindparam(8 , $this->files);
			$stm->bindparam(9 , $this->desc);
			$stm->execute();
			return $stm;
		}

		public function ListCases_model(){
			$sql="SELECT c.*, Date(c.Fecha_reg) as fecha, u.Nombre, u.Apellidos FROM Casos c LEFT JOIN Usuarios u ON 
			(c.Usuarios_idUsuario=u.idUsuario) WHERE c.idCaso NOT IN (SELECT Casos_idCaso FROM Asignados);";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ShowMoreCase_model(){
			$sql="SELECT c.*, Date(c.Fecha_reg) as fecha, u.Nombre FROM Casos c LEFT JOIN Usuarios u ON 
			(c.Usuarios_idUsuario=u.idUsuario) WHERE c.idCaso=?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1 , $this->idcaso);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function CasesCount_model(){
			$sql="SELECT COUNT(*) FROM Casos WHERE idCaso NOT IN(SELECT Casos_idCaso FROM Asignados);";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchColumn();
		}

		public function ListService_model(){
			$sql="SELECT * FROM Servicio";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		// public function Assingcases_model(){
		// 	$sql="INSERT INTO Asignados(Casos_idCaso, Usuarios_idUsuario, Servicio_idServicio) VALUES (?,?,?)";
		// 	$stm=$this->db->prepare($sql);
		// 	$stm->bindparam(1, $this->idcaso);
		// 	$stm->bindparam(2, $this->iduser);
		// 	$stm->bindparam(3, $this->service);
		// 	$stm->execute();
		// 	return $stm;
		// }
		public function Assingcases_model(){
			$sql="INSERT INTO Asignados(Casos_idCaso, Usuarios_idUsuario, Servicio_idServicio, Fecha_Asignado) 
			SELECT ?, ?, ?, ? FROM dual WHERE NOT EXISTS (SELECT * FROM Asignados WHERE Casos_idCaso = ?)";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idcaso);
			$stm->bindparam(2, $this->iduser);
			$stm->bindparam(3, $this->service);
			$stm->bindparam(4, $this->fecha);
			$stm->bindparam(5, $this->idcaso);
			$stm->execute();
			return $stm;
		}

		public function ListUsers_model(){
			$sql="SELECT * FROM Usuarios WHERE Rol_idRol<>3 AND Estado=0";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function CodCaseAssgn_model(){
			$sql="SELECT MAX(idAsignados) FROM Asignados";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchColumn();
		}

		// public function NoteAssgn_model(){
		// 	$sql="INSERT INTO Notas VALUES (NULL, ?,?,?)";
		// 	$stm=$this->db->prepare($sql);
		// 	$stm->bindparam(1, $this->note);
		// 	$stm->bindparam(2, $this->codAssgn);
		// 	$stm->bindparam(3, $this->typeNote);
		// 	$stm->execute();
		// 	return $stm;
		// }
		public function NoteAssgn_model(){
			$sql="INSERT INTO Notas (Nota, Asignados_idAsignados, Tipo_nota_idTipo_nota) 
			SELECT ?,?,? FROM dual WHERE NOT EXISTS (SELECT * FROM Notas 
			WHERE Nota=?);";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->note);
			$stm->bindparam(2, $this->codAssgn);
			$stm->bindparam(3, $this->typeNote);
			$stm->bindparam(4, $this->note);
			$stm->execute();
			return $stm;
		}

		public function ListThemes_model(){
			$sql="SELECT t.*, ti.Nombre as Tipo FROM Tema t INNER JOIN Tipo ti ON (t.Tipo_idTipo=ti.idTipo)";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function NewTheme_model(){
			$sql="INSERT INTO Tema VALUES (NULL, ?,?)";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->theme);
			$stm->bindparam(2, $this->typeTheme);
			$stm->execute();
			return $stm;
		}

		public function ListClientsComplete_model(){
			$sql="SELECT Nit, Cliente FROM Casos WHERE Nit=?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListClients_model(){
			$sql="SELECT DISTINCT(Nit) as Nit, Cliente FROM Casos;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

	}

 ?>