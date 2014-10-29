<?php

namespace Fd\OfertaEducativaBundle\Tests\Controller;

use Fd\EstablecimientoBundle\Tests\Controller\LoginWebTestCase;
use Fd\OfertaEducativaBundle\Entity\Carrera;


/**
 * testea el crud de establecimiento del backend
 */
class CarreraControllerTest extends LoginWebTestCase {

    public $manager;
    
    public function setUp() {
        parent::setup();
        
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        
        $this->manager = static::$kernel->getContainer()
                ->get('ofertaeducativa.carrera.manager');
    }
//    private function getEm() {
//    private function getRepo() {
    
    public function testBuscarAction() {
        $this->assertTrue( $this->manager instanceof \Fd\OfertaEducativaBundle\Model\CarreraManager);
        
        $this->assertTrue( $this->client instanceof \Symfony\Component\BrowserKit\Client);
        
        $client = $this->client;
    
        $crawler = $client->request('GET', '/carrera/buscar');
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
        
        carrera_filter[estado] = 'Activa';
    }
    
//    public function generarDatosBusquedaPaginada($form) {
//    public function crearFormBusqueda($datos_sesion = null) {
//    private function getComboEstados() {
//    private function getComboFormaciones() {
//    public function obtenerCarrerasPaginadas($datos) {
//    public function nuevoAction() {
//    public function crearAction(Request $request) {
//    public function eliminarAction(Carrera $carrera_anterior, Request $request) {
//    public function editarAction($entity) {
//    private function createDeleteForm($id) {
//    public function comboAction($establecimiento_id = null) {
//    public function actualizarAction(Request $request, Carrera $entity) {
//    public function fichaAction($carrera) {
//    public function do_asignarAction(Request $request) {
//    public function asignar_establecimientoAction(Carrera $carrera, Request $request) {
//    private function getEstablecimientosForms($carrera) {
//    private function crearAsignarForm($establecimiento, $carrera, $nro_form) {
////    public function donde_se_dictaAction($carrera_id) {
//    public function nomina_donde_se_dictaAction($carrera_id) {
//    public function nominaAction() {
//    public function nomina_resumidaAction() {
//    public function nomina_resumida_donde_se_dictaAction(Carrera $carrera) {
//    public function nomina_resumida_planilla_de_calculoAction() {
//    public function historia_estado_validezAction(Request $request, $id) {
//    public function indicadores_cohorteAction() {
//    public function indicadores_cohorte_establecimientoAction($establecimiento_id) {
//    public function indicadores_cohorte_unidad_ofertaAction($unidad_oferta_id) {
//    public function resumen_validezAction() {
//    public function resumen_validez_establecimientoAction($establecimiento_id) {
//    public function resumen_validez_carreraAction($carrera, $clase_css) {
//    public function cuadro_matriculaAction($carrera) {
//        $ordenar = function ($elemento1, $elemento2) {
//    public function tarjeta_carreraAction($carrera_id) {
//    public function desvincularNormaAction($carrera, $norma) {
//    public function vincularNormaAction($carrera, $norma) {

}
