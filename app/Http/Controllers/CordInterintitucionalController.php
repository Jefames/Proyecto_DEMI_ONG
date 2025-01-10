<?php

namespace App\Http\Controllers;

use App\Models\CallCenter;
use App\Models\CoordinacionInterinstitucional;
use App\Models\Coordination;
use App\Models\Derivada;
use App\Models\ServiceType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CordInterintitucionalController extends Controller
{

    public  function index(){
        $expedientesCI = CoordinacionInterinstitucional::all();
        return view('services.cord_interinstitucional.index', ['expedientes' => $expedientesCI]);
    }
    public function create()
    {
        $derivadas = Derivada::all();
        $coordinations = Coordination::all();

        return view('services.cord_interinstitucional.create', compact('derivadas','coordinations'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:50',
            'seg_nombre' => 'nullable|string|max:50',
            'ter_nombre' => 'nullable|string|max:50',
            'apellido' => 'required|string|max:50',
            'seg_apellido' => 'nullable|string|max:50',
            'ter_apellido' => 'nullable|string|max:50',
            'dpi' => 'nullable|string|max:13',
            'edad' => 'string|max:3',
            'sexo' => 'string|max:15',
            'pueblo' => 'nullable|string|max:25',
            'estado_civil' => 'string|max:15',
            'escolaridad' => 'string|max:25',
            'referidas_instituciones' => 'required|string|max:25',
            'referida_departamento' => 'required|string|max:25',
            'tipo_asesoria' => 'required|string|max:35',
            'descripcion_caso' => 'required|string',
        ]);

        $cord_interins = new CoordinacionInterinstitucional();
        // Asignar valores a los campos del modelo
        $tipo_servicio = ServiceType::where('cod_service', '02')->first();
        $cord_interins->tipo_servicio_id = $tipo_servicio->id;
        $cord_interins->fecha = $validatedData['fecha'];
        $cord_interins->nombre = $validatedData['nombre'];
        $cord_interins->seg_nombre = $validatedData['seg_nombre']?? null;
        $cord_interins->ter_nombre = $validatedData['ter_nombre']?? null;
        $cord_interins->apellido = $validatedData['apellido'];
        $cord_interins->seg_apellido = $validatedData['seg_apellido']?? null;
        $cord_interins->ter_apellido = $validatedData['ter_apellido']?? null;
        $cord_interins->dpi = $validatedData['dpi'] ?? null;
        $cord_interins->edad = $validatedData['edad'];
        $cord_interins->sexo = $validatedData['sexo'];
        $cord_interins->pueblo = $validatedData['pueblo'] ?? null;
        $cord_interins->estado_civil = $validatedData['estado_civil'];
        $cord_interins->escolaridad = $validatedData['escolaridad'];
        $cord_interins->tipo_asesoria = $validatedData['tipo_asesoria'];
        $cord_interins->referida_instituciones = $validatedData['referidas_instituciones'];
        $cord_interins->descripcion_caso = $validatedData['descripcion_caso'];
        $cord_interins->referida_departamento = $validatedData['referida_departamento'];

        $id_user = Auth::id();
        $cord_interins->user_creator_id = $id_user;
        $cord_interins->save();


        return redirect()->route('cord_interinstitucional.index')->with('success', 'Expediente creado y guardado con éxito!');
    }

    public function inactivar($id)
    {
        $expediente = CoordinacionInterinstitucional::findOrFail($id);
        $expediente->estado = false; // Asumiendo que tienes un campo 'activo' en tu modelo
        $expediente->save();

        return redirect()->route('cord_interinstitucional.index')->with('success', 'Operación Exitosa!');
    }

    public  function show(CoordinacionInterinstitucional $expediente){
    //   $expedientesCall = CallCenter::all();
    return view('services.cord_interinstitucional.show',compact('expediente'));
    }

    public function edit($id)
    {
        $expediente = CoordinacionInterinstitucional::findOrFail($id);

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('services.cord_interinstitucional.edit', compact('expediente'));
    }
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'nombre' => 'required|string|max:50',
            'seg_nombre' => 'nullable|string|max:50',
            'ter_nombre' => 'nullable|string|max:50',
            'apellido' => 'required|string|max:50',
            'seg_apellido' => 'nullable|string|max:50',
            'ter_apellido' => 'nullable|string|max:50',
            'dpi' => 'nullable|string|max:13',
            'edad' => 'string|max:3',
            'sexo' => 'string|max:15',
            'pueblo' => 'nullable|string|max:25',
            'estado_civil' => 'string|max:15',
            'escolaridad' => 'string|max:25',
            'referidas_instituciones' => 'required|string|max:25',
            'referida_departamento' => 'required|string|max:25',
            'tipo_asesoria' => 'required|string|max:35',
            'descripcion_caso' => 'required|string',
        ]);

        $expediente = CoordinacionInterinstitucional::findOrFail($id);

        // Actualizar los campos del expediente
        $expediente->fecha = $validatedData['fecha'];
        $expediente->nombre = $validatedData['nombre'];
        $expediente->seg_nombre = $validatedData['seg_nombre']?? null;
        $expediente->ter_nombre = $validatedData['ter_nombre']?? null;
        $expediente->apellido = $validatedData['apellido'];
        $expediente->seg_apellido = $validatedData['seg_apellido']?? null;
        $expediente->ter_apellido = $validatedData['ter_apellido']?? null;
        $expediente->dpi = $validatedData['dpi'] ?? null;
        $expediente->edad = $validatedData['edad'];
        $expediente->sexo = $validatedData['sexo'];
        $expediente->pueblo = $validatedData['pueblo'] ?? null;
        $expediente->estado_civil = $validatedData['estado_civil'];
        $expediente->escolaridad = $validatedData['escolaridad'];
        $expediente->tipo_asesoria = $validatedData['tipo_asesoria'];
        $expediente->referida_instituciones = $validatedData['referidas_instituciones'];
        $expediente->descripcion_caso = $validatedData['descripcion_caso'];
        $expediente->referida_departamento = $validatedData['referida_departamento'];
        $expediente->save();


        return redirect()->route('cord_interinstitucional.index')->with('success', 'Expediente actualizado con éxito!');
    }

    //INDEX REPORTES EXP
    public function reportes(){
        $expedientes = CoordinacionInterinstitucional::all();
        return view('services.cord_interinstitucional.reportes', ['expedientes' => $expedientes]);
    }

    //GENERAR PDF
    public function generarReporte(Request $request){

        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo_reporte' => 'required',
        ]);

        $data = CoordinacionInterinstitucional::whereBetween('fecha', [$validatedData['fecha_inicio'],
            $validatedData['fecha_fin']])->get();

        if ($validatedData['tipo_reporte'] == 'pdf') {
            // Generar reporte en PDF
            $expedientes = $data;
            $form_data = $validatedData;
            $pdf = Pdf::loadView('services.cord_interinstitucional.pdf_report', compact('form_data','expedientes'));
            return $pdf->stream('DEMI-reporte_expediente_CI.pdf');
        } else if ($validatedData['tipo_reporte'] == 'excel') {
            // Generar reporte en Excel
            $export = new class($data) implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
            {
                use RegistersEventListeners;
                private $data;

                public function __construct($data)
                {
                    $this->data = $data;
                }

                public function collection()
                {
                    return $this->data->map(function ($item, $index) {
                        return [
                            'No' => $index+1,
                            'Fecha' => $item->fecha ?: 'N/A',
                            'Nombre' => $item->nombre ?: 'N/A',
                            'Segundo Nombre' => $item->seg_nombre ?: 'N/A',
                            'Tercer Nombre' => $item->ter_nombre ?: 'N/A',
                            'Apellido' => $item->apellido ?: 'N/A',
                            'Segundo Apellido' => $item->seg_apellido ?: 'N/A',
                            'Apellido de Casada' => $item->ter_apellido ?: 'N/A',
                            'Sexo' => $item->sexo ?: 'N/A',
                            'Edad' => $item->edad ?: 'N/A',
                            'DPI' => $item->dpi ?: 'N/A',
                            'Pueblo' => $item->pueblo ?: 'N/A',
                            'Estado Civil' => $item->estado_civil ?: 'N/A',
                            'Escolaridad' => $item->escolaridad ?: 'N/A',
                            'Refererida a Institucion' => $item->referida_instituciones ?: 'N/A',
                            'Referida por Departamento' => $item->referida_departamento ?: 'N/A',
                            'Tipo de Asesoria' => $item->tipo_asesoria ?: 'N/A',
                            'Descripcion breve del Caso' => $item->descripcion_breve ?: 'N/A',
                        ];
                    });
                }

                public function headings(): array
                {
                    return [
                        'No',
                        'Fecha',
                        'Nombre',
                        'Segundo Nombre',
                        'Tercer Nombre',
                        'Primer Apellido',
                        'Segundo Apellido',
                        'Apellido de Casada',
                        'Sexo',
                        'Edad',
                        'DPI',
                        'Pueblo',
                        'Estado Civil',
                        'Escolaridad',
                        'Refererida a Institucion',
                        'Referida por Departamento',
                        'Tipo de Asesoria',
                        'Descripcion breve del Caso',
                    ];
                }

                public function styles(Worksheet $sheet)
                {
                    $sheet->getStyle('A4:M4')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF00' // Color amarillo para los encabezados
                            ]
                        ]
                    ]);
                }

                public static function beforeSheet(BeforeSheet $event)
                {
                    //$event->sheet->getDelegate()->mergeCells('A1:B3');
                    $drawing = new Drawing();
                    $drawing->setName('Logo');
                    $drawing->setDescription('Logo de la Empresa');
                    $drawing->setPath(public_path('assets/img/logo.png')); // Asegúrate de que la ruta sea correcta
                    $drawing->setHeight(60); // Ajusta la altura según sea necesario
                    $drawing->setCoordinates('A1'); // Ajusta la posición según sea necesario
                    $drawing->setWorksheet($event->sheet->getDelegate());
                    // Insertar filas adicionales al principio de la hoja
                    $event->sheet->getDelegate()->insertNewRowBefore(2, 2);
                }

                public function registerEvents(): array
                {
                    return [
                        BeforeSheet::class => [self::class, 'beforeSheet'],
                    ];
                }

            };

            return Excel::download($export, 'DEMI-reporte_expedienteCI_'.
                $validatedData['fecha_inicio'].'_al_'.$validatedData['fecha_fin'].'.xlsx');
        }
    }


}
