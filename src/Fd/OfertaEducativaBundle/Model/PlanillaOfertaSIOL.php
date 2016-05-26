<?php

namespace Fd\OfertaEducativaBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaOfertaSIOL extends PlanillaDeCalculo {

    protected function cargaDatos($datos, $em) {

        $encabezado[] = '#';
        $encabezado[] = 'CUE';
        $encabezado[] = 'Establecimiento';
        $encabezado[] = 'Carrera';
        $encabezado[] = 'Tipo Formación';
        $encabezado[] = 'Disciplina';
        $encabezado[] = 'Turno';
        $encabezado[] = 'Cupo';
        $encabezado[] = 'Ex Ing';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            //empiezo a poner datos en la columna A
            $posicion->setCellValue( chr($key + 65) . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;
        
        /// $datos tiene objetos establecimiento_edificio
        foreach ($datos as $uo) {
            
            //variables intermedias
            
            $columna = 'A';
            $posicion->setCellValue($columna . $fila, $fila - $this->fila_inicio_datos );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['cue'] . '/' . $uo['sedeanexo']);   //cue anexo
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['nombre']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['carrera']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['formacion']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['disciplina']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['turno']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $uo['cupo']);
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, ($uo['examen'])?'Examen de ingreso':'');

            $fila += 1;
        };
    }

}
