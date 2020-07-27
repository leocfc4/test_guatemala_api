# test_guatemala_api
test_guatemala_api

-En el archivo index se configura lo que es permisologia para poder hacer peticiones, 
se configura como la ruta base donde se encuentran los controladores y se indica la ruta donde esta la conexion

-En la clese sesion del controller, es la encargada de capturar una variable token y simular una sesion

-En l clase promocion se definen las funciones que hacen las consultas de listado y detalles a la base de datos

-La funcion get('/promociones) Valida que desde la App se envie en el header el token de la sesion , y general el json del retorno

-La funcion get('/promocion) Valida que desde la App se envie en el header el token de la sesion , y general el json del retorno en este caso del detalle.
Ademas recibe como parametro el id numerico del item a consultar

-El archivo db.php del al carpeta config se encargade la conexion al la BD

