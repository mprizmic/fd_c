<?php

namespace Fd\EstablecimientoBundle\Utilities;

/**
 * Esta clase representa a una planilla de cálculo y los pasos para que un response
 * de un controller se devuelva como un download de planilla.
 * Usa el objeto y el servicio del liuggio excel bundle
 */
//use Doctrine\ORM\EntityManagerInterface;
    
abstract class PlanillaDeCalculo{
    
    protected $php_excel_service;
    protected $phpExcelObject;
    protected $titulo;
    protected $encabezado_columnas;
    protected $datos;
    protected $response;
    protected $filename;
    protected $fila_inicio_datos;
    protected $em;
    
    public function __construct($php_excel, $titulo = null, $datos = null, $em = null, $filename = null, $fila_inicio_datos = 5) {
        $this->php_excel_service = $php_excel;
        $this->titulo = $titulo;
        $this->datos = $datos;
        $this->filename = $filename;
        $this->fila_inicio_datos = $fila_inicio_datos;
        $this->em = $em;
    }

    /**
     * Tiene que ser public porque la voy a acceder desde la clase que la hereda
     * @param type $titulo
     */
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    /**
     * Tiene que ser public porque la voy a acceder desde la clase que la hereda
     * @param type $datos
     */
    public function setDatos($encabezado_columnas, $datos){
        $this->encabezado_columnas = $encabezado_columnas;
        $this->datos = $datos;
    }
    
    public function setFilename( $filename ){
        $this->filename = $filename;
    }
    public function setFilaInicioDatos( $fila_inicio_datos ){
        $this->fila_inicio_datos = $fila_inicio_datos;
    }
    
    public function generarPlanillaResponse(){
        
        $this->crearPlanilla();
        
        $this->ponerTitulo($this->titulo);
        
        $this->fechar();
        
        $this->cargaDatos($this->datos, $this->em);
        
        $this->generarRespuesta();
        
        return $this->response;
    }
    
    protected function crearPlanilla(){
        $this->phpExcelObject = $this->php_excel_service->createPHPExcelObject();
        $this->phpExcelObject->setActiveSheetIndex(0);

    }
    protected function ponerTitulo($titulo){
        $this->phpExcelObject->getActiveSheet()->setCellValue('A1', 'Dirección de Formación Docente');
        $this->phpExcelObject->getActiveSheet()->setCellValue('A2', $titulo);
    }

    protected function fechar() {
        $this->phpExcelObject->getActiveSheet()->setCellValue('A3', date('d-m-Y'));
    }
    abstract protected function cargaDatos($datos, $em);
    
    protected function generarRespuesta(){
        //activo la primera hoja
        $this->phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->php_excel_service->createWriter($this->phpExcelObject, 'Excel5');

        // create the response
        $this->response = $this->php_excel_service->createStreamedResponse($writer);
        
        // los headers van el listener de la annotation
    }
}