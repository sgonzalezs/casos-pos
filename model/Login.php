<?php 
	
	class Login{

		private $user;
		private $pass;
		private $rol;

		function __construct(){
			$this->db = Database::getInstance();
		}

		public function __SET($a, $v){
			return $this->$a=$v;
		}

		public function __GET($a){
			return $this->$a;
		}

		public function Signin_Model(){
			$query="SELECT idUsuario, Nombre, Apellidos, Clave, Rol_idRol FROM Usuarios WHERE idUsuario=? AND Estado=0";
			$stm=$this->db->prepare($query);
			$stm->bindParam(1, $this->user);
			$stm->execute();
			return $stm->fetchAll();
		}

		public function userRolModel(){
			$query="SELECT * FROM Rol WHERE idRol=?";
			$stm=$this->db->prepare($query);
			$stm->bindParam(1, $this->rol);
			$stm->execute();
			return $stm->fetch();
		}

	}

 ?>