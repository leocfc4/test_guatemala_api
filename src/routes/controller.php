<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    class sesion {
		public static function onInitSession($token) {
			$_SESSION["session"] = $token;
			return true;
		}

		public static function getToken() {
			return $_SESSION["session"];
		}

		public static function checkToken($token) {
			if($_SESSION["session"] == $token) {
				return true;
			}
			return false;
		}

		public static function onDestroySession() {
			session_destroy();
			setcookie("session", "", time() - 3600);
			return(true);
		}
	}

	class promocion {
        private $conn = null;

        public static function getPromociones() 
        {
			$data = array();
            $conn = DB::conexion();
            $result = $conn->query("SELECT * FROM promocion");
			while($row = $result->fetch_assoc()) {	
				$data[] = $row;
			}
            return $data;
		}
		
		public static function getPromocion($id) 
        {
			$data = array();
            $conn = DB::conexion();
            $result = $conn->query("SELECT * FROM promocion WHERE id = '$id'");
			while($row = $result->fetch_assoc()) {	
				$data[] = $row;
			}
            return $data[0];
        }
	}

    $app->post('/login', function (Request $request, Response $response) {
		$res = array();
		$_SESSION["user_token"] = $request->getParsedBody()["token"];
		$res[] = array(
			"status" => 200,
			"message" => "Login success"
		);
		return($response->withJson($res));
	});

	$app->get('/token', function (Request $request, Response $response) {
		return($response->withJson(sesion::getToken()));
	});

	$app->get('/logout', function (Request $request, Response $response) {
		$res = array();
		$logout = sesion::onDestroySession();
		$res[] = array(
			"status" => 200,
			"message" => "Logout successfully"
		);
		return($response->withJson($res));
	});

	$app->get('/promociones', function (Request $request, Response $response) {
		$res = array();
		$header = $request->getHeader("token");
		if($header != []) {
			if($header[0] === $header[0]) {
				$res[] = array(
					"status" => 200,
					"message" => promocion::getPromociones()
				);				
			}
			else {
				$res[] = array(
					"status" => 403,
					"message" => "Unauthorized"
				);
			}	
		}
		else {
			$res[] = array(
				"status" => 401,
				"message" => "Unauthorized"
			);			
		}
		return($response->withJson($res));
	});

	$app->get('/promocion/{id:[0-9]+}', function (Request $request, Response $response) {
		$res = array();
		$header = $request->getHeader("token");
		if($header != []) {
			if($header[0] === $header[0]) {
				$res[] = array(
					"status" => 200,
					"message" => promocion::getPromocion($request->getAttribute('id'))
				);				
			}
			else {
				$res[] = array(
					"status" => 403,
					"message" => "Unauthorized"
				);
			}	
		}
		else {
			$res[] = array(
				"status" => 401,
				"message" => "Unauthorized"
			);			
		}
		return($response->withJson($res));
	});