<?php

namespace Fd\EstablecimientoBundle\Model;

use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

class PlanillaSedesYAnexos extends PlanillaDeCalculo {
    
//    $datos es un array de objetos establecimiento_edificio que luego se transforma en datos de cada reglon de la pagina de salida

    protected function cargaDatos($datos, $em) {

        $encabezado[] = '#';
        $encabezado[] = 'Establecimiento';
        $encabezado[] = 'CUE';
        $encabezado[] = 'Domicilio';
        $encabezado[] = 'C.Postal';
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
            $dp = $ed->getDomicilioPrincipal();
            $d = $dp->__toString();
            $anexo = !$ee->isSede() ? ' - ' . $ee->getNombre() : '';
            
            $te = $this->em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                    ->findTe($ee);
            
            //es un array o nulo
            $rector = $this->em->getRepository('EstablecimientoBundle:Autoridad')
                    ->findRectores($e);
            
            
            $columna = 'A';
            $posicion->setCellValue($columna . $fila, $fila - $this->fila_inicio_datos );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getNombre() . $anexo );
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getCue() . '/' . $ee->getCueAnexo());   //cue anexo
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $d);                                      //domicilio
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $dp->getCPostal());                                      //codigo postal
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getBarrio()->__toString());   //barrio

            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getComuna()->__toString());    //comuna
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ed->getDistritoEscolar()->__toString());
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $ee->getEmail());
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $e->getUrl());
            
            ++$columna;
            $posicion->setCellValue($columna . $fila, $te);
            
            ++$columna;
            $autoridad = is_null($rector) ? 'sin rector' : $rector['apellido'] . ', ' . $rector['nombre'];
            $posicion->setCellValue($columna . $fila, $autoridad);
            
            ++$columna;
            $autoridad_email = is_null($rector) ? '---' : $rector['email'];
            $posicion->setCellValue($columna . $fila, $autoridad_email);
            
            $fila += 1;
        };
    }

}
