<?php

session_start();


$database='localhost';
$database_user='root';
$database_password='';
$database_name='login';


//conect to database

$con=mysqli_connect($database, $database_user, $database_password ,$database_name);

if(mysqli_connect_errno()){
    exit('Error al conectar con la base de datos: ' . mysqli_connect_errno());
};

//prepare our SQL statement and preventt injectior

if($stmt=$con->prepare('SELECT id, password FROM usuarios WHERE username = ?')){
    $stmt->bind_param('s',$_POST['username']);
    $stmt->execute();

    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id,$password);
        $stmt->fetch();

        if(md5($_POST['password']) === $password){
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');
        }else{
            //mensaje incorrecto
            echo('El usuario y/o contraseña no estan correctos');
            header('refresh:2;url=index.php');
        }
    }else{
        //mensaje incorrecto
        echo('El usuario y/o contraseña no estan correctos');
        header('refresh:2;url=index.php');
    }
    $stmt->close();
}

?>