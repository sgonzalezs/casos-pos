<?php 

	class Persona{

		private $iduser;
		private $id_olduser;
		private $nombre;
		private $apellidos;
		private $correo;
		private $clave;
		private $rol;
		private $state;

		function __construct(){

			$this->db = Database::getInstance();

		}

		public function __SET($a, $v){
			$this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function Rol(){
			$sql="SELECT * FROM Rol";
			$stm=$this->db->prepare($sql);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function SaveUser(){
			$sql="INSERT INTO Usuarios VALUES(?,?,?,?,?,?, 0)";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->bindparam(2, $this->nombre);
			$stm->bindparam(3, $this->apellidos);
			$stm->bindparam(4, $this->correo);
			$stm->bindparam(5, $this->clave);
			$stm->bindparam(6, $this->rol);
			$stm->execute();
			return $stm;
		}

		public function ListUsers(){
			$sql="SELECT u.*, r.Nombre as Rol FROM Usuarios u INNER JOIN Rol r on (u.Rol_idRol=r.idRol) WHERE u.Estado=0 AND
			u.idUsuario<>? AND u.idUsuario<>'admin'";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ChangeState_model(){
			$sql="UPDATE Usuarios SET Estado=? WHERE idUsuario=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->state);
			$stm->bindparam(2, $this->iduser);
			$stm->execute();
			return $stm;
		}

		public function listChangeAssesor(){
			$sql="SELECT idUsuario, Nombre, Apellidos FROM Usuarios WHERE idUsuario <> ? AND Rol_idRol=3 AND Estado=0";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function listChangeTec(){
			$sql="SELECT idUsuario, Nombre, Apellidos FROM Usuarios WHERE idUsuario <> ? AND Rol_idRol<>3 AND Estado=0";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function ChangeUserAssigned(){
			$sql="UPDATE Asignados SET Usuarios_idUsuario=? WHERE Usuarios_idUsuario=? AND Estado<>1;";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->bindparam(2, $this->id_olduser);
			$stm->execute();
			return $stm;
		}

		public function ChangeUserCases(){
			$sql="UPDATE Casos SET Usuarios_idUsuario=? WHERE Usuarios_idUsuario=?";
			$stm=$this->db->prepare($sql);
			$stm->bindparam(1, $this->iduser);
			$stm->bindparam(2, $this->id_olduser);
			$stm->execute();
			return $stm;
		}

		// SELECT DISTINCT(nit), cliente FROM casos WHERE Usuarios_idUsuario='anav';
		// SELECT idUsuario, nombre, apellidos FROM usuarios where Rol_idRol=3 AND idUsuario<>'anav';

	}


 ?>