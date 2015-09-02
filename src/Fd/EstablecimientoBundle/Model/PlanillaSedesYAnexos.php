<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaSedesYAnexos extends PlanillaDeCalculo {

    protected function cargaDatos($datos) {

        $encabezado[] = '#';
        $encabezado[] = 'Establecimiento';
        $encabezado[] = 'CUE';
        $encabezado[] = 'Domicilio';
        $encabezado[] = 'Barrio';
        $encabezado[] = 'DE';
        $encabezado[] = 'Comuna';
        $encabezado[] = 'Email.Inst.';
        $encabezado[] = 'URL';
        $encabezado[] = 'TE';
        $encabezado[] = 'Rector';
        $encabezado[] = 'Email rector';

        $posicion = $this->phpExcelObject->getActiveSheet(0);

        foreach ($encabezado as $key => $value) {
            //empiezo a poner datos en la columna A
            $posicion->setCellValue( chr($key + 65) . $this->fila_inicio_datos, $value);
        }

        $fila = $this->fila_inicio_datos + 1;
        
        /// $datos tiene objetos establecimiento_edificio
        foreach ($datos as $ee) {
            
            //variables intermedias
            $e = $ee->getEstablecimientos();
            $ed = $ee->getEdificios();
            $d = $ed->getDomicilioPrincipal()->__toString();
            $anexo = $ee->getCueAnexo() <> '00' ? ' - ' . $ee->getNombre() : '';
            $rector = $e->getRector();
            
            $columna = 'A';
            $posicion->setCellValue($columna . $fila, $fila - $this->fila_inicio_datos );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getNombre() . $anexo );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getCue() . '/' . $ee->getCueAnexo());   //cue anexo
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $d);                                      //domicilio
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getBarrio()->__toString());   //barrio

            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getComuna()->__toString());    //comuna
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getDistritoEscolar()->__toString());
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ee->getEmail1());
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getUrl());
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ee->getTe1());
            ++$columna;
            $posicion->setCellValue($columna . $fila, $rector->__toString());
            ++$columna;
            $posicion->setCellValue($columna . $fila, $rector->getEmail());
            
            $fila += 1;
        };
    }

}
