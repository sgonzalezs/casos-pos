<?php 
	

	class Asignados{

		private $idAssgn;
		private $user;
		private $service;
		private $client;

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

		public function ListCasesAssigneds_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Asunto, c.Descripcion, u.Nombre as Asignado, u.Apellidos, s.Nombre as Servicio, us.Nombre AS Asesor, 
			us.Apellidos as Last_Asesor, us.idusuario as codAsesor,  t.Nombre as Tipo, a.Estado  FROM Asignados a INNER JOIN Usuarios u 
			ON (a.Usuarios_idUsuario=u.idusuario) INNER JOIN Servicio s ON (s.idServicio=a.Servicio_idServicio) INNER JOIN Casos c ON 
			(c.idCaso=a.Casos_idCaso) INNER JOIN Usuarios us ON (us.idUsuario=c.Usuarios_idUsuario) INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) 
			INNER JOIN Entorno e ON(t.Entorno_idEntorno=e.idEntorno) WHERE a.Estado=0;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListCasesReassigneds_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Asunto, c.Descripcion, u.Nombre as Asignado, u.Apellidos, s.Nombre as Servicio, us.Nombre AS Asesor, 
			us.Apellidos as Last_Asesor, us.idusuario as codAsesor,  t.Nombre as Tipo, a.Estado  FROM Asignados a INNER JOIN Usuarios u 
			ON (a.Usuarios_idUsuario=u.idusuario) INNER JOIN Servicio s ON (s.idServicio=a.Servicio_idServicio) INNER JOIN Casos c ON 
			(c.idCaso=a.Casos_idCaso) INNER JOIN Usuarios us ON (us.idUsuario=c.Usuarios_idUsuario) INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) 
			INNER JOIN Entorno e ON(t.Entorno_idEntorno=e.idEntorno) WHERE a.Estado=2;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function AssignedCount_model(){
			$sql="SELECT COUNT(*) FROM Asignados WHERE Estado=0;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchColumn();
		}

		public function ReassignedCount_model(){
			$sql="SELECT COUNT(*) FROM Asignados WHERE Estado=2;";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchColumn();
		}

		public function ShowMore_model(){
			$sql="SELECT a.*, c.Nit, c.Cliente, c.Asunto, c.Archivo, c.Descripcion, Date(c.Fecha_reg) as Fecha_reg, t.Nombre as Tipo, e.Nombre as Entorno 
			FROM Asignados a INNER JOIN Casos c ON (c.idCaso=a.Casos_idCaso) INNER JOIN Tipo t ON (t.idTipo=c.Tipo_idTipo) INNER JOIN Entorno e ON 
			(t.Entorno_idEntorno=e.idEntorno) WHERE a.idAsignados=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function NoteAssigned_model(){
			$sql="SELECT * FROM Notas WHERE Asignados_idAsignados=? and Tipo_nota_idTipo_nota=1";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function NoteREAssigned_model(){
			$sql="SELECT * FROM Notas WHERE Asignados_idAsignados=? and Tipo_nota_idTipo_nota=3";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ShowMoreSolution_model(){
			$sql='SELECT a.idAsignados, DATE(c.Fecha_reg) as Registro, DATE(a.Fecha_fin) as Fin, TIMESTAMPDIFF(HOUR, c.Fecha_reg, a.Fecha_fin) as
			diffHour, TIMESTAMPDIFF(DAY, c.Fecha_reg, a.Fecha_fin) as diffDay, TIMESTAMPDIFF(Minute, c.Fecha_reg, a.Fecha_fin) as
			diffMin ,c.idCaso, n.Nota, te.Nombre as Tema FROM Asignados a INNER JOIN Casos c ON (a.Casos_idCaso=c.idCaso) INNER JOIN Notas n ON 
			(a.idAsignados=n.Asignados_idAsignados) INNER JOIN Tema te ON (te.idTema=a.Tema_idTema) WHERE n.Tipo_nota_idTipo_nota=2 AND a.idAsignados=?;';
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListServiceReAssign_model(){
			$sql="SELECT * FROM Servicio";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListTecReAssign_model(){
			$sql="SELECT idUsuario, Nombre, Apellidos FROM Usuarios WHERE Rol_idRol<>3 AND Estado=0 AND idUsuario NOT IN 
			(SELECT Usuarios_idUsuario FROM Asignados WHERE idAsignados = ?);";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->idAssgn);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ListAssesor_model(){
			$sql="SELECT idUsuario, Nombre, Apellidos FROM Usuarios WHERE Rol_idRol=3 AND Estado=0 AND idUsuario <> ?;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->user);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ReAssign_model(){
			$sql="UPDATE Asignados SET Usuarios_idUsuario=?, Estado=0, Servicio_idServicio=? WHERE idAsignados=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->user);
			$stm->bindparam(2, $this->service);
			$stm->bindparam(3, $this->idAssgn);
			$stm->execute();
			return $stm;
		}

		public function updateAssesor_model(){
			$sql='UPDATE Casos SET Usuarios_idUsuario=? WHERE Nit=?';
			$statement=$this->db->prepare($sql);
			$statement->bindparam(1, $this->user);
			$statement->bindparam(2, $this->client);
			$statement->execute();
			return $statement;
		}

	}

 ?>