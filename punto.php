<?php
// Conexión a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'autoos', 3307);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Inicializar variables
$nombre = $fechanacimiento = $rfc = "";
$mensaje = "";

$nombreadmin = $clave = "";

// Variables de Cliente
$nombrecliente = $direccion = $telefono = "";

//Variable de Producto
$nombreproducto = $precio = "";

// Insertar nuevo producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertarproducto'])) {
    $nombreproducto = $_POST['nombreproducto'];
    $precio = (double) $_POST['precio'];
    

    if (!empty($nombreproducto) && !empty($precio)) {
        $sqlproductos = "INSERT INTO productos (nombreproducto, precio) VALUES ('$nombreproducto', '$precio')";
        if (mysqli_query($conexion, $sqlproductos)) {
            $mensaje = "Producto agregado exitosamente.";
        } else {
            $mensaje = "Error al agregar cliente: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}
//Buscar Producto

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscarproducto'])) {
    $buscar_producto = $_POST['buscar_producto'];
    $sqlproductos = "SELECT * FROM productos WHERE nombreproducto LIKE '$buscar_producto%'";
    $resultado_producto = mysqli_query($conexion, $sqlproductos);
    $producto_encontrado = mysqli_fetch_assoc($resultado_producto);
    if ($producto_encontrado) {
        $nombreproducto = $producto_encontrado['nombreproducto'];
        $precio = $producto_encontrado['precio'];

        $id_productos = $producto_encontrado['idproductos'];
    } else {
        $mensaje = "Producto no encontrado.";
    }
}

// Modificar Producto

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificarproducto'])) {
    $id_productos = $_POST['id_productos'];
    $nombreproducto = $_POST['nombreproducto'];
    $precio = (double) $_POST['precio'];

    if (!empty($id_productos) && !empty($nombreproducto) && !empty($precio)) {
        $sqlproductos = "UPDATE productos SET nombreproducto='$nombreproducto', precio='$precio' WHERE idproductos=$id_productos";
        if (mysqli_query($conexion, $sqlproductos)) {
            $mensaje = "Producto modificado exitosamente.";
        } else {
            $mensaje = "Error al modificar Producto: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

//Eliminar 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarproducto'])) {
    $id_productos = $_POST['id_productos'];
    if (!empty($id_productos)) {
        $sqlproductos = "DELETE FROM productos WHERE idproductos=$id_productos";
        if (mysqli_query($conexion, $sqlproductos)) {
            $mensaje = "Producto eliminado exitosamente.";
            $nombreproducto = $precio = "";
        } else {
            $mensaje = "Error al eliminar producto: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "ID de producto no válido.";
    }
}



//Insertar nuevo Cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertarcliente'])) {
    $nombrecliente = $_POST['nombrecliente'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    if (!empty($nombrecliente) && !empty($direccion) && !empty($telefono)) {
        $sqlcliente = "INSERT INTO cliente (nombrecliente, direccion, telefono) VALUES ('$nombrecliente', '$direccion', '$telefono')";
        if (mysqli_query($conexion, $sqlcliente)) {
            $mensaje = "Cliente agregado exitosamente.";
        } else {
            $mensaje = "Error al agregar cliente: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}
//Buscar Cliente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscarcliente'])) {
    $buscar_cliente = $_POST['buscar_cliente'];
    $sqlcliente = "SELECT * FROM cliente WHERE nombrecliente LIKE '$buscar_cliente%'";
    $resultado_cliente = mysqli_query($conexion, $sqlcliente);
    $cliente_encontrado = mysqli_fetch_assoc($resultado_cliente);
    if ($cliente_encontrado) {
        $nombrecliente = $cliente_encontrado['nombrecliente'];
        $direccion = $cliente_encontrado['direccion'];
        $telefono = $cliente_encontrado['telefono'];
        $id_cliente = $cliente_encontrado['idcliente'];
    } else {
        $mensaje = "Cliente no encontrado.";
    }
}

// Modificar Cliente

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificarcliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombrecliente = $_POST['nombrecliente'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    if (!empty($id_cliente) && !empty($nombrecliente) && !empty($direccion) && !empty($telefono)) {
        $sqlcliente = "UPDATE cliente SET nombrecliente='$nombrecliente', direccion='$direccion', telefono='$telefono' WHERE idcliente=$id_cliente";
        if (mysqli_query($conexion, $sqlcliente)) {
            $mensaje = "Cliente modificado exitosamente.";
        } else {
            $mensaje = "Error al modificar cliente: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

//Eliminar Cliente

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarcliente'])) {
    $id_cliente = $_POST['id_cliente'];
    if (!empty($id_cliente)) {
        $sqlcliente = "DELETE FROM cliente WHERE idcliente=$id_cliente";
        if (mysqli_query($conexion, $sqlcliente)) {
            $mensaje = "Cliente eliminado exitosamente.";
            $nombrecliente = $direccion = $telefono = "";
        } else {
            $mensaje = "Error al eliminar cliente: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "ID de cliente no válido.";
    }
}

// Insertar nuevo empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertar'])) {
    $nombre = $_POST['nombre'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $rfc = $_POST['rfc'];

    if (!empty($nombre) && !empty($fechanacimiento) && !empty($rfc)) {
        $sql = "INSERT INTO empleados (nombre, fechanacimiento, rfc) VALUES ('$nombre', '$fechanacimiento', '$rfc')";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Empleado agregado exitosamente.";
        } else {
            $mensaje = "Error al agregar empleado: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

// Buscar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $buscar_nombre = $_POST['buscar_nombre'];
    $sql = "SELECT * FROM empleados WHERE nombre LIKE '$buscar_nombre%'";
    $resultado_buscar = mysqli_query($conexion, $sql);
    $empleado_encontrado = mysqli_fetch_assoc($resultado_buscar);
    if ($empleado_encontrado) {
        $nombre = $empleado_encontrado['nombre'];
        $fechanacimiento = $empleado_encontrado['fechanacimiento'];
        $rfc = $empleado_encontrado['rfc'];
        $id_empleado = $empleado_encontrado['idempleado'];
    } else {
        $mensaje = "Empleado no encontrado.";
    }
}

// Modificar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    $id_empleado = $_POST['id_empleado'];
    $nombre = $_POST['nombre'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $rfc = $_POST['rfc'];

    if (!empty($id_empleado) && !empty($nombre) && !empty($fechanacimiento) && !empty($rfc)) {
        $sql = "UPDATE empleados SET nombre='$nombre', fechanacimiento='$fechanacimiento', rfc='$rfc' WHERE idempleado=$id_empleado";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Empleado modificado exitosamente.";
        } else {
            $mensaje = "Error al modificar empleado: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Por favor, complete todos los campos.";
    }
}

// Eliminar empleado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $id_empleado = $_POST['id_empleado'];
    if (!empty($id_empleado)) {
        $sql = "DELETE FROM empleados WHERE idempleado=$id_empleado";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Empleado eliminado exitosamente.";
            $nombre = $fechanacimiento = $rfc = "";
        } else {
            $mensaje = "Error al eliminar empleado: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "ID de empleado no válido.";
    }
}

// Obtener todos los empleados
$sql = "SELECT * FROM empleados";
$resultado = mysqli_query($conexion, $sql);

//Obtener Administradores
$sqladmin = "SELECT * FROM admin";
$resultadoadmin = mysqli_query($conexion, $sqladmin);

//Obtener Clientes
$sqlcliente = "SELECT * FROM cliente";
$resultadocliente = mysqli_query($conexion, $sqlcliente);

//Obtener Productos
$sqlproductos= "SELECT * FROM productos";
$resultadoproductos = mysqli_query($conexion, $sqlproductos);

$sqlpedidos="SELECT * FROM pedidos";
$resultadopedidos = mysqli_query($conexion, $sqlpedidos);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav a { margin-right: 15px; text-decoration: none; cursor: pointer; color: blue; }
        nav a:hover { text-decoration: underline; }
        .mensaje { color: green; }
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .formulario { margin-top: 20px; }
        .formulario input { display: block; margin-bottom: 10px; padding: 5px; width: 300px; }
        .formulario button { padding: 5px 10px; }
        #modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        #modal-contenido { background-color: #fff; margin: 10% auto; padding: 20px; width: 400px; position: relative; }
        #modal-cerrar { position: absolute; top: 10px; right: 10px; cursor: pointer; }
        #modalcliente { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        #modal-contenidocliente { background-color: #fff; margin: 10% auto; padding: 20px; width: 400px; position: relative; }
        #modal-cerrarcliente { position: absolute; top: 10px; right: 10px; cursor: pointer; }
        #modalproductos { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
        #modal-contenidoproductos { background-color: #fff; margin: 10% auto; padding: 20px; width: 400px; position: relative; }
        #modal-cerrarproductos { position: absolute; top: 10px; right: 10px; cursor: pointer; }
        .seccion { display: none; }
        .seccion.activa { display: block; }

        /* Estilos generales mejorados */
* {
    box-sizing: border-box;
}

body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    margin: 0; 
    padding: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

/* Contenedor principal */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Navegación mejorada */
nav { 
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    padding: 15px 30px;
    border-radius: 15px;
    margin-bottom: 30px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    text-align: center;
}

nav a { 
    display: inline-block;
    margin: 0 15px; 
    text-decoration: none; 
    cursor: pointer; 
    color: #4a5568;
    font-weight: 600;
    padding: 12px 24px;
    border-radius: 25px;
    transition: all 0.3s ease;
    background: transparent;
    border: 2px solid transparent;
}

nav a:hover { 
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

nav a.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

/* Secciones */
.seccion {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.seccion h1 {
    color: #2d3748;
    margin-bottom: 30px;
    font-size: 2.5em;
    text-align: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Formularios mejorados */
.formulario, .formulariocliente, .formularioproductos {
    background: #f8fafc;
    padding: 25px;
    border-radius: 15px;
    margin: 20px 0;
    border: 1px solid #e2e8f0;
}

.formulario input, .formulariocliente input, .formularioproductos input {
    width: 100%;
    max-width: 400px;
    padding: 12px 16px;
    margin-bottom: 15px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: white;
}

.formulario input:focus, .formulariocliente input:focus, .formularioproductos input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.formulario label, .formulariocliente label, .formularioproductos label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #4a5568;
}

/* Botones mejorados */
button, .formulario button, .formulariocliente button, .formularioproductos button {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    margin: 5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

button:hover, .formulario button:hover, .formulariocliente button:hover, .formularioproductos button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}


button[name="eliminar"], button[name="eliminarcliente"], button[name="eliminarproducto"] {
    background: linear-gradient(135deg, #f56565, #e53e3e);
    box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
}

button[name="eliminar"]:hover, button[name="eliminarcliente"]:hover, button[name="eliminarproducto"]:hover {
    box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
}


form:not(.formulario):not(.formulariocliente):not(.formularioproductos) {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: center;
    flex-wrap: wrap;
}

form:not(.formulario):not(.formulariocliente):not(.formularioproductos) input {
    flex: 1;
    min-width: 250px;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 25px;
    font-size: 16px;
    transition: all 0.3s ease;
}

form:not(.formulario):not(.formulariocliente):not(.formularioproductos) input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}


table { 
    border-collapse: collapse; 
    width: 100%; 
    margin-top: 30px;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
}

th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 1px;
}

td { 
    border: none;
    border-bottom: 1px solid #f1f5f9;
    padding: 15px; 
    text-align: left;
    transition: background-color 0.3s ease;
}

tr:hover td {
    background-color: #f8fafc;
}

tr:last-child td {
    border-bottom: none;
}


#modal, #modalcliente, #modalproductos, #modaladmin { 
    display: none; 
    position: fixed; 
    top: 0; 
    left: 0; 
    width: 100%; 
    height: 100%; 
    background-color: rgba(0,0,0,0.7);
    backdrop-filter: blur(5px);
    z-index: 1000;
}

#modal-contenido, #modal-contenidocliente, #modal-contenidoproductos, #modal-contenidoadmin { 
    background: white;
    margin: 5% auto; 
    padding: 40px; 
    width: 90%;
    max-width: 500px;
    position: relative;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#modal-cerrar, #modal-cerrarcliente, #modal-cerrarproductos, #modal-cerraradmin { 
    position: absolute; 
    top: 15px; 
    right: 20px; 
    cursor: pointer;
    font-size: 24px;
    color: #a0aec0;
    transition: color 0.3s ease;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f7fafc;
}

#modal-cerrar:hover, #modal-cerrarcliente:hover, #modal-cerrarproductos:hover, #modal-cerraradmin:hover {
    color: #e53e3e;
    background: #fed7d7;
}

.modal h2 {
    color: #2d3748;
    margin-bottom: 25px;
    text-align: center;
    font-size: 1.8em;
}


.mensaje { 
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin: 20px 0;
    text-align: center;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.error { 
    background: linear-gradient(135deg, #f56565, #e53e3e);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    margin: 20px 0;
    text-align: center;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
}


@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    nav {
        padding: 10px;
    }
    
    nav a {
        display: block;
        margin: 5px 0;
        text-align: center;
    }
    
    .seccion {
        padding: 20px;
    }
    
    .seccion h1 {
        font-size: 2em;
    }
    
    form:not(.formulario):not(.formulariocliente):not(.formularioproductos) {
        flex-direction: column;
    }
    
    form:not(.formulario):not(.formulariocliente):not(.formularioproductos) input {
        min-width: 100%;
    }
    
    table {
        font-size: 14px;
    }
    
    th, td {
        padding: 10px 8px;
    }
    
    #modal-contenido, #modal-contenidocliente, #modal-contenidoproductos {
        width: 95%;
        margin: 10% auto;
        padding: 20px;
    }
}


.seccion.activa {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


.button-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin: 20px 0;
}

.form-row {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.form-row > div {
    flex: 1;
    min-width: 200px;
}
    </style>
    <script>
        function mostrarSeccion(seccionId) {
            
            const secciones = document.querySelectorAll('.seccion');
            secciones.forEach(sec => sec.classList.remove('activa'));

            
            document.getElementById(seccionId).classList.add('activa');
        }

     
        window.onload = function() {
            mostrarSeccion('empleados');
        }

        function mostrarModal() {
            document.getElementById('modal').style.display = 'block';
        }
        function cerrarModal() {
            document.getElementById('modal').style.display = 'none';
        }
        function mostrarModalAdmin(){
            document.getElementById('modaladmin').style.display = 'block';
        }
        function cerrarModalAdmin() {
            document.getElementById('modaladmin').style.display = 'none';
        }
        function mostrarModalCliente(){
            document.getElementById('modalcliente').style.display = 'block';
        }
        function cerrarModalCliente() {
            document.getElementById('modalcliente').style.display = 'none';
        }

        function mostrarModalProductos(){
            document.getElementById('modalproductos').style.display = 'block';
        }
        function cerrarModalProductos() {
            document.getElementById('modalproductos').style.display = 'none';
        }

    </script>
</head>
<body>

<nav>
    <a onclick="mostrarSeccion('pedidos')">Pedidos</a>
   
    <a onclick="mostrarSeccion('productos')">Productos</a>
   
    <a onclick="mostrarSeccion('empleados')">Empleados</a>
    <a onclick="mostrarSeccion('clientes')">Clientes</a>
</nav>

<!-- Secciones -->

<!-- Pedidos -->
<div id="pedidos" class="seccion">
    <h1>Pedidos</h1>
   
<table>
        <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Cliente</th>
            <th>Fecha</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultadopedidos)) { ?>
            <tr>
                <td><?php echo $fila['idpedido']; ?></td>
                <td><?php echo $fila['preciototal']; ?></td>
                <td><?php echo $fila['idcliente']; ?></td>
                <td><?php echo $fila['fechapedido']; ?></td>
            </tr>
        <?php } ?>
    </table>
    
    
</div>




<!-- Productos -->
<div id="productos" class="seccion">
    <h1>Productos</h1>
  

 <form method="POST">
        <input type="text" name="buscar_producto" placeholder="Buscar por nombre" required>
        <button type="submit" name="buscarproducto">Buscar</button>
    </form>

 <div class="formularioproductos">
        <form method="POST">
            <input type="hidden" name="id_productos" value="<?php echo isset($id_productos) ? $id_productos : ''; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombreproducto" value="<?php echo $nombreproducto; ?>" required>
            <label>Precio:</label>
            <input type="number" name="precio" value="<?php echo $precio; ?>" step="any" required>
           
            <button type="submit" name="modificarproducto">Modificar</button>
            <button type="submit" name="eliminarproducto" onclick="return confirm('¿Está seguro de eliminar este producto?');">Eliminar</button>
        </form>
    </div>

 <button onclick="mostrarModalProductos()">Agregar Producto</button>

 <div id="modalproductos">
        <div id="modal-contenidoproductos">
            <span id="modal-cerrarproductos" onclick="cerrarModalProductos()">X</span>
            <h2>Agregar Nuevo Productos</h2>
            <form method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombreproducto" required>
                <label>Precio:</label>
                <input type="number" name="precio" step="any" required>
                
                <button type="submit" name="insertarproducto">Insertar productos</button>
            </form>
        </div>
    </div>

 <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultadoproductos)) { ?>
            <tr>
                <td><?php echo $fila['idproductos']; ?></td>
                <td><?php echo $fila['nombreproducto']; ?></td>
                <td><?php echo $fila['precio']; ?></td>
                
            </tr>
        <?php } ?>
    </table>

</div>




<div id="empleados" class="seccion">
    <h1>Gestión de Empleados</h1>

    <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>

    <!-- Formulario de búsqueda -->
    <form method="POST">
        <input type="text" name="buscar_nombre" placeholder="Buscar por nombre" required>
        <button type="submit" name="buscar">Buscar</button>
    </form>

    <!-- Formulario de empleado -->
    <div class="formulario">
        <form method="POST">
            <input type="hidden" name="id_empleado" value="<?php echo isset($id_empleado) ? $id_empleado : ''; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" required>
            <label>Fecha de Nacimiento:</label>
            <input type="date" name="fechanacimiento" value="<?php echo $fechanacimiento; ?>" required>
            <label>RFC:</label>
            <input type="text" name="rfc" value="<?php echo $rfc; ?>" required>
            <button type="submit" name="modificar">Modificar</button>
            <button type="submit" name="eliminar" onclick="return confirm('¿Está seguro de eliminar este empleado?');">Eliminar</button>
        </form>
    </div>

    
    <button onclick="mostrarModal()">Agregar Empleado</button>

   
    <div id="modal">
        <div id="modal-contenido">
            <span id="modal-cerrar" onclick="cerrarModal()">X</span>
            <h2>Agregar Nuevo Empleado</h2>
            <form method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <label>Fecha de Nacimiento:</label>
                <input type="date" name="fechanacimiento" required>
                <label>RFC:</label>
                <input type="text" name="rfc" required>
                <button type="submit" name="insertar">Insertar</button>
            </form>
        </div>
    </div>

    
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha de Nacimiento</th>
            <th>RFC</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $fila['idempleado']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['fechanacimiento']; ?></td>
                <td><?php echo $fila['rfc']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<div id="clientes" class="seccion">
    <h1>Clientes</h1>
    

     <form method="POST">
        <input type="text" name="buscar_cliente" placeholder="Buscar por nombre" required>
        <button type="submit" name="buscarcliente">Buscar</button>
    </form>

     <div class="formulariocliente">
        <form method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo isset($id_cliente) ? $id_cliente : ''; ?>">
            <label>Nombre:</label>
            <input type="text" name="nombrecliente" value="<?php echo $nombrecliente; ?>" required>
            <label>Fecha de Nacimiento:</label>
              <input type="text" name="direccion" value="<?php echo $direccion; ?>" required>
            <label>RFC:</label>
            <input type="text" name="telefono" value="<?php echo $telefono; ?>" required>
            <button type="submit" name="modificarcliente">Modificar</button>
            <button type="submit" name="eliminarcliente" onclick="return confirm('¿Está seguro de eliminar este empleado?');">Eliminar</button>
        </form>
    </div>

    <button onclick="mostrarModalCliente()">Agregar Cliente</button>

    <div id="modalcliente">
        <div id="modal-contenidocliente">
            <span id="modal-cerrarcliente" onclick="cerrarModalCliente()">X</span>
            <h2>Agregar Nuevo Cliente</h2>
            <form method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombrecliente" required>
                <label>Direccion</label>
                <input type="text" name="direccion" required>
                <label>Telefono:</label>
                <input type="text" name="telefono" required>
                <button type="submit" name="insertarcliente">Insertar</button>
            </form>
        </div>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultadocliente)) { ?>
            <tr>
                <td><?php echo $fila['idcliente']; ?></td>
                <td><?php echo $fila['nombrecliente']; ?></td>
                <td><?php echo $fila['direccion']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
            </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
