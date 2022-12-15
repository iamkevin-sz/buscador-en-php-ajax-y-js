<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>almacen</title>
    <style>
        table, th, td{
            border: 1px solid;
        }

        table{
            width:80%;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
    
<h2>Almacen</h2>

<form action="" method="post">
    <label for="campo">Buscar: </label>
    <input type="text" name="campo" id="campo">
</form>

<p></p>

<table>
    <thead>
        <th>Num. Empleado</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha nacimiento</th>
        <th>Fecha ingreso</th>
        <th></th>
        <th></th>
    </thead>

    <tbody id="content">

    </tbody>
</table>

</body>

<script>
    getData()

    document.getElementById("campo").addEventListener("keyup", getData)


    function getData(){
        let input = document.getElementById("campo");
        let content = document.getElementById("content");
        let url = "load.php"; //es la url que hace la consulta
        let formData = new FormData()  //esto para que podamos enviar los parametro 
        formData.append('campo', input)
        // generaremos nuestra peticion con fetch

        fetch(url, {
            method: "POST",
            body: formData
        }).then(response => response.json())  // aqui obtenemos el formato json que enviamos del script load
        .then(data => {         //todo lo que estamos obteniendo lo llamaremos data y le asignamos otras llaves, tomamos content que es el body de la tabla
            content.innerHTML = data
        }).catch(err => console.log(err))
    }
</script>

</html>