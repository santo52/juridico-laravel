<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActuacionController extends Controller
{
    public function inicio()
    {
        $this->crear();
    }

    public function crear()
    {
        /* @TODO Permisos para acceder a cada una de las opciones */

        // if (!Number::validarInt($this->_post('crear'))) {
        //     $this->_view->documentos = $this->_documentoModel->getAllDocumentos(true);
        //     $this->_view->plantillasDocumento = $this->_plantillasDocumentoModel->getAllPlantillasDocumento(true);
        //     $this->_view->validaciones = Message::getValidaciones();
        //     $this->_view->render('crear', true);
        //     $this->_view->cargarJs('crear');

        // }
        // else {
        //     /* Inicio de la transacción */
        //     Model::startTransaction();

        //     $nombreActuacion = $this->_post('nombreActuacion');

        //     /* Valida si la actuación ya existe */
        //     if ($this->_actuacionModel->existsActuacion($nombreActuacion)) {
        //         /* Error al existir la actuación */
        //         Model::failTransaction(Message::get('ACTUACION_CREA_1', array($nombreActuacion)));

        //     }
        //     else {
        //         /* Construye el dto de actuaciones */
        //         $this->_actuacionDto = $this->_actuacionModel->buildActuacionDto($this->_actuacionDto, $this->_post());
        //         /* Inserta la actuación */
        //         $resultado = $this->_actuacionModel->insertActuacion($this->_actuacionDto);
        //         if (!$resultado) {
        //             /* Error al insertar la actuación */
        //             Model::failTransaction();

        //         }
        //         else {
        //             $idActuacion = $this->_actuacionModel->getUltimoIdInsertado();
        //             if (!Number::validarInt($idActuacion)) {
        //                 /* Error al obtener el id de la actuación insertada */
        //                 Model::failTransaction();

        //             }
        //             else {
        //                 $continuar = true;
        //                 $explInfoDocumentosAsociados = explode('||', $this->_post('infoDocumentosAsociados'));
        //                 foreach ($explInfoDocumentosAsociados as $documentoAsociado) {
        //                     /* Construye el dto de cada documento asociado a la actuación */
        //                     $this->_actuacionDocumentoDto = $this->_actuacionModel->buildActuacionDocumentoDto($this->_actuacionDocumentoDto, $idActuacion, $documentoAsociado);
        //                     /* Inserta cada documento asociado a la actuación */
        //                     $resultado = $this->_actuacionModel->insertDocumentoActuacion($this->_actuacionDocumentoDto);
        //                     if (!$resultado) {
        //                         /* Error al insertar cada documento asociado a la actuación */
        //                         Model::failTransaction();
        //                         $continuar = false;
        //                         break;
        //                     }
        //                 }

        //                 if ($continuar) {
        //                     $explInfoPlantillasAsociadas = explode('||', $this->_post('infoPlantillasAsociadas'));
        //                     foreach ($explInfoPlantillasAsociadas as $plantillaAsociada) {
        //                         /* Construye el dto de cada plantilla de documento asociada a la actuación */
        //                         $this->_actuacionPlantillaDocumentoDto = $this->_actuacionModel->buildActuacionPlantillaDocumentoDto($this->_actuacionPlantillaDocumentoDto, $idActuacion, $plantillaAsociada);
        //                         /* Inserta cada plantilla de documento asociada a la actuación */
        //                         $resultado = $this->_actuacionModel->insertPlantillaDocumentoActuacion($this->_actuacionPlantillaDocumentoDto);
        //                         if (!$resultado) {
        //                             /* Error al insertar cada plantilla de documento asociada a la actuación */
        //                             Model::failTransaction();
        //                             break;
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     /* Fin de la transacción */
        //     $transaccion = Model::completeTransaction();
        //     if ($transaccion) {
        //         echo Message::set(State::$SUCCESS_CODE, Message::get('ACTUACION_CREA_2') . ' <a href="' . $_SERVER['REQUEST_URI'] . '">Crear otra actuación</a>', true);

        //     }
        //     else {
        //         echo Message::set(State::$ERROR_CODE, Message::get('ACTUACION_CREA_3'), true);
        //     }
        // }
    }

    public function listar()
    {
        /* @TODO Permisos para acceder a cada una de las opciones */

        // if (!Number::validarInt($this->_post('listar'))) {
        //     $this->_view->paso = 1;
        //     $this->_view->actuaciones = $this->_actuacionModel->getAllActuaciones();
        //     $this->_view->validaciones = Message::getValidaciones();
        //     $this->_view->render('listar', true);
        //     $this->_view->cargarJs('listar');

        // }
        // else {
        //     $this->_view->listaActuaciones = $this->_actuacionModel->getListadoActuaciones($this->_post('autoActuaciones'));
        //     $this->_view->paso = 2;
        //     $this->_view->render('listar');
        // }
    }

    public function modificar($idActuacion)
    {
        // $infoActuacion = $this->_actuacionModel->getActuacionById($idActuacion);
        // if (count($infoActuacion) == 0)
        //     Uri::redireccionar();

        // if (!Number::validarInt($this->_post('modificar'))) {
        //     $this->_view->documentos = $this->_documentoModel->getAllDocumentos(true);
        //     $this->_view->plantillasDocumento = $this->_plantillasDocumentoModel->getAllPlantillasDocumento(true);
        //     $this->_view->infoDocumentosActuaciones = $this->_actuacionModel->getDocumentosActuacionById($idActuacion);
        //     $this->_view->infoPlantillasDocumentoActuaciones = $this->_actuacionModel->getPlantillasDocumentoActuacionById($idActuacion);
        //     $this->_view->infoActuacion = $infoActuacion;
        //     $this->_view->validaciones = Message::getValidaciones();
        //     $this->_view->render('modificar', true);
        //     $this->_view->cargarJs('modificar');

        // }
        // else {
        //     /* Inicio de la transacción */
        //     Model::startTransaction();

        //     $nombreActuacion = $this->_post('nombreActuacion');

        //     /* Valida si la actuación ya existe */
        //     if ($this->_actuacionModel->existsActuacion($nombreActuacion, $idActuacion)) {
        //         /* Error al existir la actuación */
        //         Model::failTransaction(Message::get('ACTUACION_CREA_1', array($nombreActuacion)));

        //     }
        //     else {
        //         /* Construye el dto de actuaciones */
        //         $this->_actuacionDto = $this->_actuacionModel->buildActuacionDto($this->_actuacionDto, $this->_post(), $idActuacion);
        //         /* Modifica la actuación */
        //         $resultado = $this->_actuacionModel->updateActuacion($this->_actuacionDto);
        //         if (!$resultado) {
        //             /* Error al insertar la actuación */
        //             Model::failTransaction();

        //         }
        //         else {
        //             /* Elimina todos los documentos asociados a la actuación */
        //             $resultado = $this->_actuacionModel->deleteRealDocumentosActuacion($idActuacion);
        //             if (!$resultado) {
        //                 /* Error al eliminar todos los documentos asociados a la actuación */
        //                 Model::failTransaction();

        //             }
        //             else {
        //                 /* Elimina todas las plantillas de documento asociadas a la actuación */
        //                 $resultado = $this->_actuacionModel->deleteRealPlantillasDocumentoActuacion($idActuacion);
        //                 if (!$resultado) {
        //                     /* Error al eliminar todas las plantillas de documento asociadas a la actuación */
        //                     Model::failTransaction();

        //                 }
        //                 else {
        //                     $continuar = true;
        //                     $explInfoDocumentosAsociados = explode('||', $this->_post('infoDocumentosAsociados'));
        //                     foreach ($explInfoDocumentosAsociados as $documentoAsociado) {
        //                         /* Construye el dto de cada documento asociado a la actuación */
        //                         $this->_actuacionDocumentoDto = $this->_actuacionModel->buildActuacionDocumentoDto($this->_actuacionDocumentoDto, $idActuacion, $documentoAsociado);
        //                         /* Inserta cada documento asociado a la actuación */
        //                         $resultado = $this->_actuacionModel->insertDocumentoActuacion($this->_actuacionDocumentoDto);
        //                         if (!$resultado) {
        //                             /* Error al insertar cada documento asociado a la actuación */
        //                             Model::failTransaction();
        //                             $continuar = false;
        //                             break;
        //                         }
        //                     }

        //                     if ($continuar) {
        //                         $explInfoPlantillasAsociadas = explode('||', $this->_post('infoPlantillasAsociadas'));
        //                         foreach ($explInfoPlantillasAsociadas as $plantillaAsociada) {
        //                             /* Construye el dto de cada plantilla de documento asociada a la actuación */
        //                             $this->_actuacionPlantillaDocumentoDto = $this->_actuacionModel->buildActuacionPlantillaDocumentoDto($this->_actuacionPlantillaDocumentoDto, $idActuacion, $plantillaAsociada);
        //                             /* Inserta cada plantilla de documento asociada a la actuación */
        //                             $resultado = $this->_actuacionModel->insertPlantillaDocumentoActuacion($this->_actuacionPlantillaDocumentoDto);
        //                             if (!$resultado) {
        //                                 /* Error al insertar cada plantilla de documento asociada a la actuación */
        //                                 Model::failTransaction();
        //                                 break;
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     /* Fin de la transacción */
        //     $transaccion = Model::completeTransaction();
        //     if ($transaccion) {
        //         echo Message::set(State::$SUCCESS_CODE, Message::get('ACTUACION_MODI_1', array($nombreActuacion)), true);

        //     }
        //     else {
        //         echo Message::set(State::$ERROR_CODE, Message::get('ACTUACION_MODI_2'), true);
        //     }
        // }
    }

    public function eliminar()
    {
        // if (Number::validarInt($this->_post('eliminar'))) {
        //     $infoActuacion = $this->_actuacionModel->getActuacionById($this->_post('idActuacion'));
        //     $nombreActuacion = $infoActuacion[0]['nombre_actuacion'];

        //     /* Inicio de la transacción */
        //     Model::startTransaction();

        //     /* Elimina la actuación */
        //     $resultado = $this->_actuacionModel->deleteActuacion($this->_post('idActuacion'));
        //     if (!$resultado) {
        //         /* Error al eliminar la actuación */
        //         Model::failTransaction();
        //     }

        //     /* Fin y validación de la transacción */
        //     $transaccion = Model::completeTransaction();
        //     if ($transaccion)
        //         echo Message::set(State::$SUCCESS_CODE, Message::get('ACTUACION_LIST_3', array($nombreActuacion)), true);
        //     else
        //         echo Message::set(State::$ERROR_CODE, Message::get('ACTUACION_LIST_4', array($nombreActuacion)), true);
        // }
    }

    public function recuperar()
    {
    //     if (Number::validarInt($this->_post('recuperar'))) {
    //         $infoActuacion = $this->_actuacionModel->getActuacionById($this->_post('idActuacion'));
    //         $nombreActuacion = $infoActuacion[0]['nombre_actuacion'];

    //         /* Inicio de la transacción */
    //         Model::startTransaction();

    //         /* Recupera la actuación */
    //         $resultado = $this->_actuacionModel->undeleteActuacion($this->_post('idActuacion'));
    //         if (!$resultado) {
    //             /* Error al recuperar la actuación */
    //             Model::failTransaction();
    //         }

    //         /* Fin y validación de la transacción */
    //         $transaccion = Model::completeTransaction();
    //         if ($transaccion)
    //             echo Message::set(State::$SUCCESS_CODE, Message::get('ACTUACION_LIST_5', array($nombreActuacion)), true);
    //         else
    //             echo Message::set(State::$ERROR_CODE, Message::get('ACTUACION_LIST_6', array($nombreActuacion)), true);
    //     }
    }
}
