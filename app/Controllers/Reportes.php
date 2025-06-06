<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\SucursalModel;
use App\Models\VentasModel;
use App\ThirdParty\Fpdf\PlantillaProductos;
use App\ThirdParty\Fpdf\PlantillaVentas;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Reportes extends BaseController
{

    public function creaVentas()
    {
        if (!verificar('reportes', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }
        return view('reportes/crea_ventas');
    }

    // Muesta el reporte de venta
    public function verReporteVentas()
    {
        $reglas = [
            'fecha_inicio' => ['label' => 'fecha de inicio', 'rules' => 'required'],
            'fecha_fin'    => ['label' => 'fecha de fin', 'rules' => 'required'],
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['fecha_inicio', 'fecha_fin', 'estado']);

        return view('reportes/ver_reporte_ventas', ['post' => $post]);
    }

    public function generaVentas($inicio, $fin, $estaus)
    {
        $ventasModel = new VentasModel();
        $ventas = $ventasModel->ventasRango($inicio, $fin, $estaus, $this->session->get('id_sucursal'));

        $logo = base_url('images/logo.png');

        $datos = [
            'titulo' => 'Reporte de ventas',
            'logo' => $logo,
            'inicio' => $this->ordenarFecha($inicio),
            'fin' => $this->ordenarFecha($fin)
        ];

        $pdf = new PlantillaVentas('P', 'mm', 'letter', $datos);
        $pdf->SetTitle('Reporte de ventas');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetWidths([40, 40, 80, 40]);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Row(['Fecha', 'Folio', 'Cliente', 'Total']);
        $pdf->SetFont('Arial', '', 9);

        $total = 0;
        $numVentas = 0;

        foreach ($ventas as $venta) {
            $pdf->row(
                [
                    $this->ordenarFechaHora($venta['fecha_alta']),
                    $venta['folio'],
                    $venta['nombre'],
                    env('SIMMONEY') . ' ' . number_format($venta['total'], 2, '.', ',')
                ]
            );
            $total = $total + $venta['total'];
            ++$numVentas;
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(160, 5, 'Total', 0, 0, 'R');
        $pdf->Cell(40, 5, env('SIMMONEY') . ' ' . number_format($total, 2, '.', ','), 1, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(70, 5, mb_convert_encoding('Número de ventas: ', 'ISO-8859-1', 'UTF-8') . $numVentas, 0, 0, 'L');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ReporteVentas.pdf", "I");
    }

    // Muesta el reporte de productos
    public function verReporteProductos()
    {
        return view('reportes/ver_reporte_productos');
    }

    // Genera reporte de productos
    public function generaProductos()
    {
        $productosModel = new ProductosModel();
        $productos = $productosModel->productosInventario($this->session->get('id_sucursal'));

        $logo = base_url('images/logo.png');

        $datos = [
            'titulo' => 'Reporte de productos',
            'logo' => $logo
        ];

        $pdf = new PlantillaProductos('P', 'mm', 'letter', $datos);
        $pdf->SetTitle('Reporte de ventas');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetWidths([30, 95, 30, 20, 20]);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Row(['Código', 'Nombre', 'Precio', 'Inventariable', 'Existencias']);
        $pdf->SetFont('Arial', '', 7);

        $numProductos = 0;

        foreach ($productos as $producto) {
            $pdf->row(
                [
                    $producto['codigo'],
                    $producto['nombre'],
                    env('SIMMONEY') . ' ' . number_format($producto['precio'], 2, '.', ','),
                    $producto['inventariable'],
                    $producto['existencia']
                ]
            );
            $numProductos++;
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln(3);
        $pdf->Cell(70, 5, mb_convert_encoding('Número de productos: ', 'ISO-8859-1', 'UTF-8') . $numProductos, 0, 0, 'L');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("ReporteVentas.pdf", "I");
    }

    private function ordenarFecha($fecha)
    {
        $arreglo = explode("-", $fecha);
        return $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0];
    }

    private function ordenarFechaHora($fechaHora)
    {
        $fecha = substr($fechaHora, 0, 10);
        $hora = substr($fechaHora, 11);
        $arreglo = explode("-", $fecha);
        return $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' ' . $hora;
    }

    public function procesarImportacion()
    {
        $productoModel = new ProductosModel();
        $archivo = $this->request->getFile('archivo_excel');

        // Verifica si se seleccionó un archivo
        if ($archivo->isValid() && !$archivo->hasMoved()) {
            $data = $this->leerExcel($archivo->getTempName());

            // Procesa los datos y guárdalos en la base de datos
            foreach ($data as $producto) {
                $productoModel->insert($producto);
            }

            // Redirecciona a la página de éxito o maneja de otra manera
            return redirect()->to('productos');
        } else {
            // Maneja el caso de error de carga de archivo
            return redirect()->to('productos');
        }
    }

    // Método para leer datos desde el archivo Excel
    private function leerExcel($filePath)
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = [];
        // Itera sobre las filas del archivo Excel y agrega los datos a un array
        foreach ($sheet->getRowIterator() as $row) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            // Asegúrate de que la fila tenga la cantidad correcta de columnas
            if (count($rowData) == 5) {
                $data[] = [
                    'codigo' => $rowData[0],
                    'nombre' => $rowData[1],
                    'precio' => $rowData[2],
                    'inventariable' => $rowData[3],
                    'existencia' => $rowData[4],
                    'activo' => '1',
                    'id_sucursal' => $this->session->get('id_sucursal')
                ];
            }
        }

        return $data;
    }
}
