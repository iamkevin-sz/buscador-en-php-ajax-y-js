<?php


require 'config.php';

// columnas tabla
$columns = ['no_emp', 'fecha_nacimiento', 'nombre', 'apellido', 'fecha_ingreso'];
// tabla empleados
$table = 'empleados';


$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$where = '';
if($campo !=null)[
    $where = "WHERE(";

    $cont = count($columns); // lo que hace es contar las columnas del arreglo

    for($i = 0; $i<$cont; i++){
        $where.= $columns[$i]. "LIKE '%". $campo. "%' OR "; // LO QUE HACE "OR" ES IR AVANZANDO EN CADA COLUMNA CON EL LIKE, EL SGT SERA APELLIDO LIKE Y EL CAMPO LUEGO GENERO Y ASI SUCESIVAMNETE HASTA QUE SOLO QUEDE EL OR, PERO CUANDO QUEDE EL OR TENDREMOS QUE ELMINARLO, PARA ESO USAMOS LO SGT
    }
    $where = substr_replace($where, "", -3); //esto reemplazara los caracteres que le digamos, en este caso lo remplazara por caracteres vacios los 3 campos del final, es decir el spacio y el or son 3
    $where .=")";
]

$sql = " SELECT " . implode(", ", $columns) . " 
FROM $table
$where";
// echo $table;

$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows;  //nos indica cuantas filas nos trae la consulta para asi hacer un validacion

$html = '';


if($num_rows > 0){

    while($row = $resultado->fetch_assoc()){
        $html.= '<tr>';
        $html.= '<td>'.$row['no_emp'].'</td>';
        $html.= '<td>'.$row['nombre'].'</td>';
        $html.= '<td>'.$row['apellido'].'</td>';
        $html.= '<td>'.$row['fecha_nacimiento'].'</td>';
        $html.= '<td>'.$row['fecha_ingreso'].'</td>';
        $html.= '<td><a href="">Editar</a></td>';
        $html.= '<td><a href="">Eliminar</a></td>';   
        $html.= '</tr>';
    }

}else{
    $html.= '<tr>';
    $html.= '<td colspan="7">Sin resultados</td>';
    $html.= '</tr>';
} 

echo json_encode($html, JSON_UNESCAPED_UNICODE);  //lo mostramos en formato json para que la peticion ajax lo pueda leer, usamos json_unescaped_unicode por si tiene caracteres especiales para que lo reconozca



