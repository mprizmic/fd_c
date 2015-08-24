<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaMatriculaDeLocalizacion extends PlanillaDeCalculo {

    protected function cargaDatos($datos) {

        $encabezado[] = '#';
        $encabezado[] = 'Nombre';
        $encabezado[] = 'CUE';
        $encabezado[] = 'Nivel';
        $encabezado[] = 'Matricula';
        $encabezado[] = 'Comuna';
        $encabezado[] = 'DE';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            //empiezo a poner datos en la columna A
            $posicion->setCellValue(chr($key + 65) . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;

        /// $datos tiene objetos establecimiento_edificio
        foreach ($datos as $dato) {

//            //variables intermedias
//            $e = $ee->getEstablecimientos();
//            $ed = $ee->getEdificios();
            $anexo = ($dato['anexo'] <> '00') ? ' - ' . $dato['nombre_anexo'] : '';

            $columna = 'A';
            $posicion->setCellValue($columna . $fila, $fila - $this->fila_inicio_datos);

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['establecimiento'] . $anexo);

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['cue'] . '/' . $dato['anexo']);   //cue anexo

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['nivel']);

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['matricula']);

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['comuna']);

            ++$columna;
            $posicion->setCellValue($columna . $fila, $dato['DE']);

            $fila += 1;
        };
    }

}
