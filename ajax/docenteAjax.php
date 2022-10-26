<?php
require_once '../controlador/DocenteControlador.php';

$method = $_POST['method'];

function validarCampos(){

}

$objDocente = new DocenteControlador();
if(isset($_POST['codDocente'])){
    $objDocente->codDocente = $_POST['codDocente'];
}

switch ($method)
{
    case 'g':
            $objDocente->documento = $_POST['documento'];
            $objDocente->nombres = $_POST['nombres'];
            $objDocente->apellidos = $_POST['apellidos'];
            $objDocente->correo = $_POST['correo'];
            $objDocente->telefono = $_POST['telefono'];
            $res = $objDocente->guardarDocenteControlador($objDocente);
            if($res){
                echo "Guardado correctamente.";
            }
            else{
                echo "No fue guardado.";
            }
        break;
    case 'l':
        $lists = $objDocente->listarDocenteControlador();
        $tabla = '';
        foreach ($lists as $list){
            $tabla.= '<tr>
                            <td>'.$list['documento'].'</td>
                            <td>'.$list['nombres'].'</td>
                            <td>'.$list['apellidos'].'</td>
                            <td>'.$list['correo'].'</td>
                            <td>'.$list['telefono'].'</td>
                            <td>
                                <a href="#" class="btn btn-success" onclick="editarDocente('.$list['id'].',\''.$list['documento'].'\',\''.$list['nombres'].'\',\''.$list['apellidos'].'\',\''.$list['correo'].'\',\''.$list['telefono'].'\')"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="eliminarDocente('.$list['id'].')"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>';  
        }
        echo $tabla;
        break;
    case 'e':
        $lists = $objDocente->editarDocenteControlador($objDocente->codDocente);
        foreach ($lists as $list){
            echo json_encode($list);
        }
        break;
    case 'a':
        $objDocente->documento = $_POST['documento'];
        $objDocente->nombres = $_POST['nombres'];
        $objDocente->apellidos = $_POST['apellidos'];
        $objDocente->correo = $_POST['correo'];
        $objDocente->telefono = $_POST['telefono'];
        $res = $objDocente->actualizarDocenteControlador($objDocente);
        if($res){
            echo "actualizado correctamente.";
        }
        else{
            echo "No fue actualizado.";
        }
        break;
    case 'd':
        $res = $objDocente->eliminarDocenteControlador($objDocente->codDocente);
        if($res){
            echo "Eliminado correctamente.";
        }
        else{
            echo "No fue eliminado.";
        }
        break;
    default:
        echo "Acción no encontrada.";
        break;
}