<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePrescription;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdatePrescription;

class PrescriptionController extends Controller
{
        /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $prescriptions = Prescription::all();

        return view('backend.prescription.index',compact('prescriptions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $selected_patient = null;
        if(isset($request->id)){
            $selected_patient = Patient::find($request->id);
            $selected_patient = $selected_patient->id;
        }
        $patients = Patient::orderBy('name','ASC')->get();
        return view('backend.prescription.create',compact('patients','selected_patient'));
    }

    /**
     * @param StorePrescription $request
     * @return mixed
     */
    public function store(StorePrescription $request)
    {
        $patient_id = 0;
        DB::transaction(function () use ($request, &$patient_id)
        {
            $data = $request->data();

            $prescription = Prescription::create($data);
            $patient_id = $prescription->patient_id; 
            return compact('patient_id');
        });

        return redirect('/patient/detail/'.$patient_id);

        // return redirect()->route('prescription.index')->withSuccess(trans('messages.create_success', ['entity' => 'Prescription']));
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        $model = Prescription::query();
 
    return DataTables::eloquent($model)
        ->addColumn('patient_name', function($item){
            return $item->patient ? $item->patient->name : 'N.A';
        })

        ->addColumn('description', function($item){
            $html = '';
            if($item)
            {
                $html = '<div class="prescription-details">'.$item->description.'</div>';
            }
            return $html;
        })
        ->addColumn('date',function($item){
            return date_format(new \DateTime($item->date),"dS-M-Y");
        })
        ->addColumn('action', function($item){
            $html = '';
            if($item)
            {
                $html = '<div class="actions">
                <button class="btn btn-primary-bright" title="Edit Prescription"><a href="'.url('/prescription/'.$item->id.'/edit').'"> <i class="fa fa-pencil-square-o" style="font-size: 15px;"></i> </a> </button>
                <button data-url="'.url('/prescription/'.$item->id.'/destroy').'" title="Delete Prescription" class="btn btn-danger item-delete"> <i class="fa fa-trash" style="font-size: 15px;"></i> </button> </div>';
            }
            return $html;
        })
        ->escapeColumns([])
        ->rawColumns(['patient_name','action','description','date'])
        ->toJson();
    }

    /**
     * @param Prescription $prescription
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // dd($id);
        $prescription = Prescription::find($id);
        if($prescription){
            $patients = Patient::orderBy('name','ASC')->get();
            return view('backend.prescription.edit',compact('patients','prescription'));
        }else{
            return abort(404);
        }
    }

    /**
     * @param Prescription $prescription
     * @param UpdatePrescription $request
     * @return mixed
     */
    public function update($id, UpdatePrescription $request)
    {
        $prescription = Prescription::find($id);
        if($prescription){
            // dd('Testing');
            DB::transaction(function () use ($request, $prescription)
            {
                $data = $request->data();
    
                $prescription->update($data);
            });
        }else{
            return abort(404);
        }

        return redirect()->route('prescription.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Prescription' ]));
    }

    /**
     * @param Prescription $prescription
     * @return mixed
     */
    public function destroy($id)
    {
        $prescription = Prescription::find($id);
        if($prescription){
            $prescription->delete();
        }else{
            return abort(404);
        }
        // $patient->delete();

        return redirect()->route('prescription.index')->withSuccess(trans('message.delete_success', [ 'entity' => 'Prescription' ]));
    }
}
