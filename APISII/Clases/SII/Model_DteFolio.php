<?php

/**
 * LibreDTE
 * Copyright (C) SASCO SpA (https://sasco.cl)
 *
 * Este programa es software libre: usted puede redistribuirlo y/o
 * modificarlo bajo los términos de la Licencia Pública General Affero de GNU
 * publicada por la Fundación para el Software Libre, ya sea la versión
 * 3 de la Licencia, o (a su elección) cualquier versión posterior de la
 * misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero
 * SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita
 * MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO.
 * Consulte los detalles de la Licencia Pública General Affero de GNU para
 * obtener una información más detallada.
 *
 * Debería haber recibido una copia de la Licencia Pública General Affero de GNU
 * junto a este programa.
 * En caso contrario, consulte <http://www.gnu.org/licenses/agpl.html>.
 */


/**
 * Clase para mapear la tabla dte_folio de la base de datos
 * Comentario de la tabla:
 * Esta clase permite trabajar sobre un registro de la tabla dte_folio
 * @author SowerPHP Code Generator
 * @version 2015-09-22 10:44:45
 */

require_once 'Folios.php';
require_once 'Data.php';
require_once 'Model_DteCaf.php';

class Model_DteFolio
{

    // Datos para la conexión a la base de datos
    protected $_database = 'default'; ///< Base de datos del modelo
    protected $_table = 'dte_folio'; ///< Tabla del modelo

    // Atributos de la clase (columnas en la base de datos)
    public $emisor; ///< integer(32) NOT NULL DEFAULT '' PK FK:contribuyente.rut
    public $dte; ///< smallint(16) NOT NULL DEFAULT '' PK FK:dte_tipo.codigo
    public $certificacion; ///< boolean() NOT NULL DEFAULT 'false' PK
    public $siguiente; ///< integer(32) NOT NULL DEFAULT ''
    public $disponibles; ///< integer(32) NOT NULL DEFAULT ''
    public $alerta; ///< integer(32) NOT NULL DEFAULT ''
    public $alertado; ///< boolean() NOT NULL DEFAULT 'false'

    // Información de las columnas de la tabla en la base de datos
    public static $columnsInfo = array(
        'emisor' => array(
            'name'      => 'Emisor',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => true,
            'fk'        => array('table' => 'contribuyente', 'column' => 'rut')
        ),
        'dte' => array(
            'name'      => 'Dte',
            'comment'   => '',
            'type'      => 'smallint',
            'length'    => 16,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => true,
            'fk'        => array('table' => 'dte_tipo', 'column' => 'codigo')
        ),
        'certificacion' => array(
            'name'      => 'Certificacion',
            'comment'   => '',
            'type'      => 'boolean',
            'length'    => null,
            'null'      => false,
            'default'   => 'false',
            'auto'      => false,
            'pk'        => true,
            'fk'        => null
        ),
        'siguiente' => array(
            'name'      => 'Siguiente',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'disponibles' => array(
            'name'      => 'Disponibles',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'alerta' => array(
            'name'      => 'Alerta',
            'comment'   => '',
            'type'      => 'integer',
            'length'    => 32,
            'null'      => false,
            'default'   => '',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),
        'alertado' => array(
            'name'      => 'Alertado',
            'comment'   => '',
            'type'      => 'boolean',
            'length'    => null,
            'null'      => false,
            'default'   => 'false',
            'auto'      => false,
            'pk'        => false,
            'fk'        => null
        ),

    );



    /**
     * Método para guardar el mantenedor del folio usando una transacción
     * serializable
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2015-09-22
     */
    public function save($exitOnFailTransaction = true)
    {
        // if (!$this->db->beginTransaction(true) and $exitOnFailTransaction)
        //     return false;
        // parent::save();
        // return $this->db->commit();
    }

    /**
     * Método que calcula la cantidad de folios que quedan disponibles y guarda
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2016-01-27
     */
    public function calcularDisponibles()
    {
        $this->db->beginTransaction(true);
        $cafs = $this->db->getTable('
            SELECT desde, hasta
            FROM dte_caf
            WHERE
                emisor = :emisor
                AND dte = :dte
                AND certificacion = :certificacion
                AND desde >= (
                    SELECT desde
                    FROM dte_caf
                    WHERE
                        emisor = :emisor
                        AND dte = :dte
                        AND certificacion = :certificacion
                        AND :folio BETWEEN desde AND hasta
                )
        ', [':emisor' => $this->emisor, ':dte'=>$this->dte, 'certificacion' => (int)$this->certificacion, ':folio'=>$this->siguiente]);
        $n_cafs = count($cafs);
        if (!$n_cafs)
            return false;
        if ($n_cafs==1) {
            $this->disponibles = $cafs[0]['hasta'] - $this->siguiente + 1;
        }
        else {
            for ($i=1; $i<$n_cafs; $i++) {
                if ($cafs[$i]['desde']!=($cafs[$i-1]['hasta']+1))
                    break;
            }
            $this->disponibles = $cafs[$i-1]['hasta'] - $this->siguiente + 1;
        }
        $status = $this->save(false);
        if (!$status) {
            $this->db->rollback();
            return false;
        }
        $this->db->commit();
        return true;
    }

    /**
     * Método que entrega el listado de archivos CAF que existen cargados para
     * el tipo de DTE
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-10-20
     */
    public function getCafs($order = 'ASC')
    {
        $cafs = $this->db->getTable('
            SELECT desde, hasta, (hasta - desde + 1) AS cantidad, xml
            FROM dte_caf
            WHERE emisor = :rut AND dte = :dte AND certificacion = :certificacion
            ORDER BY desde '.($order=='ASC'?'ASC':'DESC').'
        ', [':rut'=>$this->emisor, ':dte'=>$this->dte, ':certificacion'=>$this->certificacion]);
        foreach ($cafs as &$caf) {
            $xml = \website\Dte\Utility_Data::decrypt($caf['xml']);
            if (!$xml)
                return false;
            $Caf = new Folios($xml);
            $caf['fecha_autorizacion'] = $Caf->getFechaAutorizacion();
            $caf['meses_autorizacion'] = Utility_Date::countMonths($caf['fecha_autorizacion']);
            unset($caf['xml']);
        }
        return $cafs;
    }

    /**
     * Método que entrega el objeto del tipo de DTE asociado al folio
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-07-19
     */
    public function getTipo()
    {
        return (new \website\Dte\Admin\Mantenedores\Model_DteTipos())->get($this->dte);
    }

    /**
     * Método que entrega el objeto del contribuyente asociado al mantenedor de folios
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-18
     */
    public static function getEmisor()
    {
        return (new Model_Contribuyentes())->get($this->emisor);
    }

    /**
     * Método que permite realizar el timbraje de manera automática
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2020-01-26
     */
    public function timbrar($cantidad = null)
    {
        // corregir cantidad si no se pasó
        if (!$cantidad) {
            if (!$this->alerta) {
                throw new \Exception('No hay alerta configurada');
            }
            $cantidad = $this->alerta * 5;
        }
        // recuperar firma electrónica
        $Emisor = $this->getEmisor();
        $Firma = $Emisor->getFirma();
        if (!$Firma) {
            throw new \Exception('No hay firma electrónica');
        }
        // solicitar timbraje
        $r = libredte_api_consume(
            '/sii/dte/caf/solicitar/'.$Emisor->getRUT().'/'.$this->dte.'/'.$cantidad.'?certificacion='.(int)$this->certificacion,
            [
                'auth' => [
                    'cert' => [
                        'cert-data' => $Firma->getCertificate(),
                        'pkey-data' => $Firma->getPrivateKey(),
                    ],
                ],
            ]
        );
        if ($r['status']['code']!=200) {
            throw new \Exception('No se pudo obtener el CAF desde el SII: '.$r['body']);
        }
        // entregar XML
        return $r['body'];
    }

    /**
     * Método que guardar un archivo de folios en la base de datos
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-11-05
     */
    public static function guardarFolios($empresa, $ambiente, $xml, $nombrexml)
    {
        //echo "ambiente->".$ambiente;
        $Emisor = $empresa;
        $Folios = new Folios($xml);
        // si no se pudo validar el caf error
        if (!$Folios->getTipo()) {
            throw new \Exception('No fue posible cargar el CAF:<br/>'.implode('<br/>', Log::readAll()));
        }
        // verificar que el caf sea del emisor
        if ($Folios->getEmisor()!=$Emisor) {
            throw new \Exception('RUT del CAF '.$Folios->getEmisor().' no corresponde con el RUT de la empresa '.$Emisor->razon_social.' '.$Emisor->rut.'-'.$Emisor->dv);
        }
        // verificar que el folio que se está subiendo sea para el ambiente actual de la empresa
        $ambiente_empresa = $ambiente;
        $ambiente_caf = $Folios->getCertificacion() ? 'certificación' : 'producción';
        if ($ambiente_empresa!=$ambiente_caf) {
            throw new \Exception('Empresa está en ambiente de '.$ambiente_empresa.' pero folios son de '.$ambiente_caf);
        }


        
        $existe_folio = get_existe_folios_asignas($Folios->getDesde());
        // FOLIO NO HA SIDO INGRESADO A SISTEMA
        if($existe_folio == false){
            if(inserta_folios_asignas($Emisor, $Folios->getDesde(), $Folios->getHasta(), $nombrexml)){
                //NUEVO
                for($i = $Folios->getDesde(); $i<=$Folios->getHasta(); $i++){
                    inserta_folios_disponibles($i);
                }
                return "CAF (".$Folios->getDesde()."-".$Folios->getHasta().") ingresado";
            }
            else{
                return "Error tratando de ingresar CAF";
            }
        }
        else{
            return "CAF (".$Folios->getDesde()."-".$Folios->getHasta().") en ambiente de ".$ambiente_caf." ya estaba cargado";
        }
   
    }

    /**
     * Método que entrega el uso mensual de los folios
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-10-20
     */
    public function getUsoMensual($limit = 12, $order = 'ASC')
    {
        $periodo_col = $this->db->date('Ym', 'fecha');
        return $this->db->getTable('
            SELECT * FROM (
                SELECT '.$periodo_col.' AS mes, COUNT(*) AS folios
                FROM dte_emitido
                WHERE emisor = :rut AND dte = :dte AND certificacion = :certificacion
                GROUP BY '.$periodo_col.'
                ORDER BY '.$periodo_col.' DESC
                LIMIT '.(int)$limit.'
            ) AS t ORDER BY mes '.($order=='ASC'?'ASC':'DESC').'
        ', [':rut'=>$this->emisor, ':dte'=>$this->dte, ':certificacion'=>$this->certificacion]);
    }


   

    /**
     * Método que entrega los folios que están antes del folio siguiente, para
     * los cuales hay CAF y no se han usado
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2017-09-11
     */
    public static function getSinUso($empresa)
    {   
        // si no hay caf error
        // if (getCafs($empresa) == false) {
        //     return [];
        // }

        // buscar primer folio usado del CAF (se busca sólo desde este en adelante)
        $primer_folio = getPrimerFolio($empresa);
        // if ($primer_folio == '') {
        //     return [];
        // }
        // buscar rango
        $folios = get_folios_rango_aux($empresa);
        $folios_disp = get_folios_sin_uso($empresa, $folios, $primer_folio);
        return $folios_disp;
    }

    /**
     * Método que entrega el estado de todos los folios asociados a todos los
     * CAFs del mantenedor de folios
     * @author Esteban De La Fuente Rubio, DeLaF (esteban[at]sasco.cl)
     * @version 2018-05-18
     */
    public function getEstadoFolios($estados = 'recibidos,anulados,pendientes', $retry = 100)
    {
        $estados = explode(',', $estados);
        // arreglo para resultado
        $folios = [];
        if (in_array('recibidos', $estados)) {
            $folios['recibidos'] = [];
        }
        if (in_array('anulados', $estados)) {
            $folios['anulados'] = [];
        }
        if (in_array('pendientes', $estados)) {
            $folios['pendientes'] = [];
        }
        // obtener todos los cafs existentes
        $cafs = (new Model_DteCafs())->setWhereStatement(
            ['emisor = :emisor', 'dte = :dte', 'certificacion = :certificacion'],
            [':emisor'=>$this->emisor, ':dte'=>$this->dte, ':certificacion'=>(int)$this->certificacion]
        )->setOrderByStatement('desde')->getObjects();
        // recorrer cada caf e ir extrayendo los campos
        foreach($cafs as $DteCaf) {
            // obtener folios recibidos
            if (in_array('recibidos', $estados)) {
                for ($i=0; $i<$retry; $i++) {
                    try {
                        $folios['recibidos'] = array_merge($folios['recibidos'], $DteCaf->getFoliosRecibidos());
                        break;
                    } catch (\Exception $e) {
                        usleep(200000);
                    }
                }
            }
            // obtener folios anulados
            if (in_array('anulados', $estados)) {
                for ($i=0; $i<$retry; $i++) {
                    try {
                        $folios['anulados'] = array_merge($folios['anulados'], $DteCaf->getFoliosAnulados());
                        break;
                    } catch (\Exception $e) {
                        usleep(200000);
                    }
                }
            }
            // obtener folios pendientes
            if (in_array('pendientes', $estados)) {
                for ($i=0; $i<$retry; $i++) {
                    try {
                        $folios['pendientes'] = array_merge($folios['pendientes'], $DteCaf->getFoliosPendientes());
                        break;
                    } catch (\Exception $e) {
                        usleep(200000);
                    }
                }
            }
        }
        return $folios;
    }

}
