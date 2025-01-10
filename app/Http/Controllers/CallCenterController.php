<?php

namespace App\Http\Controllers;

use App\Models\CallCenter;
use App\Models\Coordination;
use App\Models\Derivada;
use App\Models\ServiceType;
use Grpc\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CallCenterController extends Controller
{
    //

    public  function index(){
        $expedientesCall = CallCenter::all();
        return view('services.call_centers.index', ['expedientes' => $expedientesCall]);
    }

    public  function show(CallCenter $expediente){
     //   $expedientesCall = CallCenter::all();
        return view('services.call_centers.show',compact('expediente'));
    }

    public function create()
    {
        $derivadas = Derivada::all();
        $coordinations = Coordination::all();

        return view('services.call_centers.create', compact('derivadas','coordinations'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'oficina_externo' => 'required|string|max:50',
            'primer_nombre' => 'required|string|max:50',
            'segundo_nombre' => 'nullable|string|max:100',
            'tercer_nombre' => 'nullable|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'apellido_casada' => 'nullable|string|max:100',
            'dpi' => 'nullable|string|max:13',
            'telefono' => 'nullable|string|max:15',
            'pueblo' => 'nullable|string|max:50',
            'comunidad_linguistica' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'discapacidad' => 'nullable|string|max:50',
            'info_demi' => 'required|string|max:50',
            'ref_ofireg' => 'required|string',
            'modalidades' => 'required|string|max:50',
            'asesoria' => 'required|boolean',
            'transferida_ofi' => 'required|string',
            'descripcion' => 'required|string',
            'derivadas' => 'nullable|array',        // Asegura que 'derivadas' sea un array
            'derivadas.*' => 'exists:derivadas,id',  // Cada elemento de 'derivadas' debe existir en la tabla 'derivadas'
            'coordinations' => 'nullable|array',        // Asegura que 'coordinations' sea un array
            'coordinations.*' => 'exists:coordinations,id'  // Cada elemento de 'coordination' debe existir en la tabla 'coordination'
        ]);

        $callCenter = new CallCenter();
        // Asignar valores a los campos del modelo
        $tipo_servicio = ServiceType::where('nombre_servicio', 'Centro De Llamadas')->first();
        $callCenter->tipo_servicio_id = $tipo_servicio->id;
        $callCenter->fecha = $validatedData['fecha'];
        $callCenter->hora = $validatedData['hora'];
        $callCenter->via_reporte = $validatedData['oficina_externo'];
        $callCenter->nombre = $validatedData['primer_nombre'];
        $callCenter->seg_nombre = $validatedData['segundo_nombre'] ?? null;
        $callCenter->ter_nombre = $validatedData['tercer_nombre'] ?? null;
        $callCenter->apellido = $validatedData['primer_apellido'];
        $callCenter->seg_apellido = $validatedData['segundo_apellido'] ?? null;
        $callCenter->dpi = $validatedData['dpi'] ?? null;
        $callCenter->apellido_cas = $validatedData['apellido_casada'] ?? null;
        $callCenter->telefono = $validatedData['telefono'] ?? null;
        $callCenter->pueblo = $validatedData['pueblo'] ?? null;
        $callCenter->comunidad_linguistica = $validatedData['comunidad_linguistica'] ?? null;
        $callCenter->direccion = $validatedData['direccion'] ?? null;
        $callCenter->discapacidad = $validatedData['discapacidad'] ?? null;
        $callCenter->inf_servdemi = $validatedData['info_demi'];
        $callCenter->modalidades = $validatedData['modalidades'];
        $callCenter->asesor_orienta = $validatedData['asesoria'];
        $callCenter->transfer_ofcentr = $validatedData['transferida_ofi'];
        $callCenter->descripcion = $validatedData['descripcion'];
        $callCenter->ref_ofreg = $validatedData['ref_ofireg'];

        $id_user = Auth::id();
        $callCenter->user_creator_id = $id_user;
        $callCenter->save();

        // Sincronizar las relaciones
        if (isset($validatedData['derivadas'])){
            $callCenter->derivadas()->sync($validatedData['derivadas']);
        }
        if (isset($validatedData['coordinations'])){
            $callCenter->derivadas()->sync($validatedData['coordinations']);
        }

        return redirect()->route('call_centers.index')->with('success', 'Expediente creado y guardado con éxito!');
    }

    public function edit($id)
    {
        $expediente = CallCenter::findOrFail($id);
        $derivadas = Derivada::all();
        $coordinations = Coordination::all();

        // Formatear la hora a H:i
        $expediente->hora = substr($expediente->hora, 0, 5);

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('services.call_centers.edit', compact('expediente','derivadas','coordinations'));
    }
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'oficina_externo' => 'required|string|max:50',
            'dpi' => 'nullable|string|max:13',
            'primer_nombre' => 'required|string|max:50',
            'segundo_nombre' => 'nullable|string|max:100',
            'tercer_nombre' => 'nullable|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',
            'apellido_casada' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'pueblo' => 'nullable|string|max:50',
            'comunidad_linguistica' => 'nullable|string|max:50',
            'direccion' => 'nullable|string',
            'discapacidad' => 'nullable|string|max:50',
            'info_demi' => 'required|string|max:50',
            'ref_ofireg' => 'required|string',
            'modalidades' => 'required|string|max:50',
            'asesoria' => 'required|boolean',
            'transferida_ofi' => 'required|string',
            'derivadas' => 'nullable|array',
            'derivadas.*' => 'exists:derivadas,id',
            'coordinations' => 'nullable|array',
            'coordinations.*' => 'exists:coordinations,id',
            'descripcion' => 'required|string'
        ]);

        $expediente = CallCenter::findOrFail($id);

        // Actualizar los campos del expediente
        $expediente->fecha = $validatedData['fecha'];
        $expediente->hora = $validatedData['hora'];
        $expediente->via_reporte = $validatedData['oficina_externo'];
        $expediente->nombre = $validatedData['primer_nombre'];
        $expediente->seg_nombre = $validatedData['segundo_nombre'] ?? null;
        $expediente->ter_nombre = $validatedData['tercer_nombre'] ?? null;
        $expediente->apellido = $validatedData['primer_apellido'];
        $expediente->seg_apellido = $validatedData['segundo_apellido'] ?? null;
        $expediente->apellido_cas = $validatedData['apellido_casada'] ?? null;
        $expediente->dpi = $validatedData['dpi'] ?? null;
        $expediente->telefono = $validatedData['telefono'] ?? null;
        $expediente->pueblo = $validatedData['pueblo'] ?? null;
        $expediente->comunidad_linguistica = $validatedData['comunidad_linguistica'] ?? null;
        $expediente->direccion = $validatedData['direccion'] ?? null;
        $expediente->discapacidad = $validatedData['discapacidad'];
        $expediente->inf_servdemi = $validatedData['info_demi'];
        $expediente->modalidades = $validatedData['modalidades'];
        $expediente->asesor_orienta = $validatedData['asesoria'];
        $expediente->transfer_ofcentr = $validatedData['transferida_ofi'];
        $expediente->descripcion = $validatedData['descripcion'];
        $expediente->ref_ofreg = $validatedData['ref_ofireg'];

        $expediente->save();

        // Sincronizar las relaciones
        if (!is_null($validatedData['derivadas'])){
            $expediente->derivadas()->sync($validatedData['derivadas']);
        }
        if (!is_null($validatedData['coordinations'])){
            $expediente->derivadas()->sync($validatedData['coordinations']);
        }

        return redirect()->route('call_centers.index')->with('success', 'Expediente actualizado con éxito!');
    }

    //DESACTIVAR EXPEDIENTE
    public function inactivar($id)
    {
        $expediente = CallCenter::findOrFail($id);
        $expediente->estado = false; // Asumiendo que tienes un campo 'activo' en tu modelo
        $expediente->save();

        return redirect()->route('call_centers.index')->with('success', 'Expediente desactivado con éxito');
    }


    //INDEX REPORTES EXP
    public function reportes(){
        $expedientesCall = CallCenter::all();
        return view('services.call_centers.reportes', ['expedientes' => $expedientesCall]);
    }

    //GENERAR PDF
    public function generarReporte(Request $request){

        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo_reporte' => 'required',
        ]);

        $data = CallCenter::whereBetween('fecha', [$validatedData['fecha_inicio'],
            $validatedData['fecha_fin']])->get();

        if ($validatedData['tipo_reporte'] == 'pdf') {
            // Generar reporte en PDF
            $expedientes = $data->toArray();
            $form_data = $validatedData;
            $pdf = Pdf::loadView('services.call_centers.pdf_report', compact('form_data','expedientes'));
            return $pdf->stream('DEMI-reporte_expediente.pdf');
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
                            'Hora' => $item->hora ?: 'N/A',
                            'Vía de Reporte' => $item->via_reporte ?: 'N/A',
                            'Primer Nombre' => $item->nombre ?: 'N/A',
                            'Segundo Nombre' => $item->seg_nombre ?: 'N/A',
                            'Tercer Nombre' => $item->ter_nombre ?: 'N/A',
                            'Primer Apellido' => $item->apellido ?: 'N/A',
                            'Segundo Apellido' => $item->seg_apellido ?: 'N/A',
                            'Apellido de Casada' => $item->apellido_cas ?: 'N/A',
                            'DPI' => $item->dpi ?: 'N/A',
                            'Teléfono' => $item->telefono ?: 'N/A',
                            'Pueblo' => $item->pueblo ?: 'N/A',
                            'Comunidad Lingüística' => $item->comunidad_linguistica ?: 'N/A',
                            'Dirección' => $item->direccion ?: 'N/A',
                            'Discapacidad' => $item->discapacidad ?: 'N/A',
                            'Información brindada' => $item->inf_servdemi ?: 'N/A',
                            'Tipo de caso atendido' => $item->modalidades ?: 'N/A',
                            'Asesoría/Orientación' => $item->asesor_orienta ? 'Sí' : 'No',
                            'Derivación interna' => $item->transfer_ofcentr ?: 'N/A',
                            'Descripción' => $item->descripcion ?: 'N/A',
                            'Derivación a Oficina Regional' => $item->ref_ofreg ?: 'N/A',
                        ];
                    });
                }

                public function headings(): array
                {
                    return [
                        'No',
                        'Fecha',
                        'Hora',
                        'Vía de Reporte',
                        'Primer Nombre',
                        'Segundo Nombre',
                        'Tercer Nombre',
                        'Primer Apellido',
                        'Segundo Apellido',
                        'Apellido de Casada',
                        'DPI',
                        'Teléfono',
                        'Pueblo',
                        'Comunidad Lingüística',
                        'Dirección',
                        'Discapacidad',
                        'Información brindada',
                        'Tipo de caso atendido',
                        'Asesoría/Orientación',
                        'Derivación interna',
                        'Descripción',
                        'Derivación a Oficina Regional',
                    ];
                }

                public function styles(Worksheet $sheet)
                {
                    $sheet->getStyle('A4:V4')->applyFromArray([
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

            return Excel::download($export, 'DEMI-reporte_expediente_'.
                $validatedData['fecha_inicio'].'_al_'.$validatedData['fecha_fin'].'.xlsx');
        }
    }
}
