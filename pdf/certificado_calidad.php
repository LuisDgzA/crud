<?php 
    include("../conexion.php");
    require_once('tcpdf/config/lang/spa.php');
    require_once('tcpdf/tcpdf.php');
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

    $meses = ['', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
    $mesActual = $meses[date('n')];
    $elaboracion = date('d').' '.$mesActual.' '.date('Y');

    $id = $_GET['id'];
    $cantidad = $_GET['cant'];
    $lote = $_GET['lote'];
    $query = "SELECT CONCAT_WS(' ', proveedores.email, proveedores.telefono) as proveedor, proveedor_resultado.responsable,
             proveedor_resultado.lote, proveedores.condiciones as caducidad, proveedores.envio as presentacion 
             FROM `proveedor_resultado` 
             INNER JOIN proveedor_analisis ON proveedor_analisis.id = proveedor_resultado.proveedor_analisis_id 
             INNER JOIN proveedores ON proveedores.id = proveedor_analisis.proveedor_id 
             WHERE proveedor_analisis.proveedor_id = $id 
             AND lote = '$lote'";
    $res = mysqli_query($conexion, $query);
    $info = mysqli_fetch_assoc($res);
    $fecha = explode('-', $info['caducidad']);
    $mes = $fecha[1];
    if($mes < 10) $mes = str_replace('0', '', $mes);
    $caducidad = $fecha[2].' '.$meses[$mes].' '.$fecha[0];

    $query_analisis = "SELECT analisis.categoria
                       FROM proveedor_analisis 
                       INNER JOIN analisis ON analisis.id_analisis = proveedor_analisis.analisis_id 
                       INNER JOIN proveedor_resultado ON proveedor_resultado.proveedor_analisis_id = proveedor_analisis.id
                       WHERE proveedor_analisis.proveedor_id = $id
                       AND proveedor_resultado.lote = '$lote'
                       GROUP BY analisis.categoria";
    $res_query = mysqli_query($conexion, $query_analisis);
    $info_analisis = mysqli_fetch_all($res_query, MYSQLI_ASSOC);
    class MYPDF extends TCPDF {

		public function Header() {
			//$this->setY(35);
		}
		public function Footer() {
			$paginas = "Página " . $this->PageNo() . ' de ' . $this->getAliasNbPages();
			$this->SetY(-11);
			$this->SetFont(PDF_FONT_NAME_MAIN, '', 7);
			$this->Cell(0, 3, $paginas, 0, 0, 'C');
		}
        public function printHeader($w, $h, $txt){
            $this->Ln(9);
            $this->setX(25);
			$this->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
			$this->Cell($w, $h, $txt, 1, 0, 'C', 0);
            $this->Ln();
            $this->setX(25);
            $this->Cell(50, 4, 'Análisis', 1, 0, 'C', 0);
            $this->Cell(30, 4, 'Unidad', 1, 0, 'C', 0);
            $this->Cell(26, 4, 'Mínimo', 1, 0, 'C', 0);
            $this->Cell(26, 4, 'Máximo', 1, 0, 'C', 0);
            $this->Cell(28, 4, 'Resultado', 1, 0, 'C', 0);
		}
	}
	
	$pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

    $pdf->SetCreator('');
    $pdf->SetAuthor('');
    $pdf->SetTitle('Certificado De Calidad');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->AddPage();

	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 14);
    $pdf->setY(20);
    $pdf->Cell(0, 0, 'CERTIFICADO DE CALIDAD', 0, 0, 'C', 0);
    
    $pdf->setXY(25, 30);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Fecha', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, date('d/m/Y'), 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Clave y Nombre', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $info['proveedor'], 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Lote', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $info['lote'], 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Fecha de elaboración', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $elaboracion, 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Consumo preferente', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $caducidad, 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Cantidad', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $cantidad, 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Presentación', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $info['presentacion'], 1, 0, 'L', 0);
    $pdf->Ln();
    $pdf->setX(25);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
    $pdf->Cell(50, 4, 'Responsable', 1, 0, 'L', 0);
	$pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
    $pdf->Cell(110, 4, $info['responsable'], 1, 0, 'L', 0);
    
    // $pdf->Ln(9);

    foreach($info_analisis as $analisis){
        switch ($analisis['categoria']) {
            case 'Sensorial':
                $cat = 'Sensorial';
                $pdf->printHeader(160, 4, 'SENSORIAL', 1, 0, 'C', 0);
                $resultados = getResultados($conexion, $id, $cat, $lote);
                foreach($resultados as $resultado){
                    $pdf->Ln();
                    $pdf->setX(25);
			        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
                    $pdf->Cell(50, 4, $resultado['nombre_a'], 1, 0, 'C', 0);
                    $pdf->Cell(30, 4, $resultado['unidad'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['minimo'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['maximo'], 1, 0, 'C', 0);
                    $pdf->Cell(28, 4, $resultado['resultado'], 1, 0, 'C', 0);
                }
                break;
            case 'Fisicoquímicos':
                $cat = 'Fisicoquímicos';
                $pdf->printHeader(160, 4, 'FISICOQUÍMICOS', 1, 0, 'C', 0);
                $resultados = getResultados($conexion, $id, $cat, $lote);
                foreach($resultados as $resultado){
                    $pdf->Ln();
                    $pdf->setX(25);
			        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
                    $pdf->Cell(50, 4, $resultado['nombre_a'], 1, 0, 'C', 0);
                    $pdf->Cell(30, 4, $resultado['unidad'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['minimo'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['maximo'], 1, 0, 'C', 0);
                    $pdf->Cell(28, 4, $resultado['resultado'], 1, 0, 'C', 0);
                }
                break;
            case 'Microbiológicos':
                $cat = 'Microbiológicos';
                $pdf->printHeader(160, 4, 'MICROBIOLÓGICOS', 1, 0, 'C', 0);
                $resultados = getResultados($conexion, $id, $cat, $lote);
                foreach($resultados as $resultado){
                    $pdf->Ln();
                    $pdf->setX(25);
			        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'R', 10);
                    $pdf->Cell(50, 4, $resultado['nombre_a'], 1, 0, 'C', 0);
                    $pdf->Cell(30, 4, $resultado['unidad'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['minimo'], 1, 0, 'C', 0);
                    $pdf->Cell(26, 4, $resultado['maximo'], 1, 0, 'C', 0);
                    $pdf->Cell(28, 4, $resultado['resultado'], 1, 0, 'C', 0);
                }
                break;
            
            default:
                # code...
                break;
        }
    }
    
    $pdf->Output();
    exit();

    function getResultados($conexion, $id, $cat, $lote){
        $query_results = "SELECT proveedor_analisis.analisis_id, analisis.nombre_a, analisis.categoria, analisis.unidad, 
                            proveedor_analisis.minimo, proveedor_analisis.maximo, IF('$cat' = 'Sensorial', proveedor_resultado.resultado, FORMAT(AVG(proveedor_resultado.resultado),2)) as resultado 
                            FROM proveedor_analisis 
                            INNER JOIN analisis ON analisis.id_analisis = proveedor_analisis.analisis_id 
                            INNER JOIN proveedor_resultado ON proveedor_resultado.proveedor_analisis_id = proveedor_analisis.id
                            WHERE proveedor_analisis.proveedor_id = $id AND analisis.categoria = '$cat' AND proveedor_resultado.lote = '$lote'
                            GROUP BY analisis.nombre_a;";
        $res_query = mysqli_query($conexion, $query_results);
        $info_res = mysqli_fetch_all($res_query, MYSQLI_ASSOC);
        return $info_res;
    }
?>

