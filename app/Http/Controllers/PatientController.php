<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatient;
use App\Http\Requests\UpdatePatient;
use App\patient;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $patients = Patient::all();

        return view('backend.patient.index',compact('patients'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.patient.create');
    }

    /**
     * @param StorePatient $request
     * @return mixed
     */
    public function store(StorePatient $request)
    {
        DB::transaction(function () use ($request)
        {
            $data = $request->data();

            $patient = Patient::create($data);

            // $this->uploadRequestImage($request, $patient);
        });

        return redirect()->route('patient.index')->withSuccess(trans('messages.create_success', ['entity' => 'Patient']));
    }

    /**
     * @return mixed
     */
    public function datatable()
    {
        $model = Patient::query();
 
        return DataTables::eloquent($model)
    
            ->addColumn('action', function($item){
                $html = '';
                $html = '<button class="btn btn-success" style="margin: 2px;" title="View Patient Details"><a href="'.url('/patient/detail/'.$item->id).'"> <i class="fa fa-eye" style="font-size: 15px;"></i> </a> </button>';
                $html .= '<button class="btn btn-primary-bright" style="margin: 2px;" title="Edit Patient"><a href="'.url('/patient/'.$item->id.'/edit').'" > <i class="fa fa-pencil-square-o" style="font-size: 15px;"></i> </a>';
                $html .= '</button><button data-url="'.url('/patient/'.$item->id.'/destroy').'" class="btn btn-danger item-delete" style="margin: 2px;" title="Delete Patient"> <i class="fa fa-trash" style="font-size: 15px;"></i> </button>';
                return $html;
            })
            ->escapeColumns([])
            ->rawColumns(['patient_name','action'])
            ->toJson();
        return Datatables::eloquent(Patient::query())->make(true);
    }

    /**
     * @param patient $patient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        if($patient){
            return view('backend.patient.edit',compact('patient'));
        }else{
            return abort(404);
        }
    }

    /**
     * @param patient $patient
     * @param UpdatePatient $request
     * @return mixed
     */
    public function update($id, UpdatePatient $request)
    {
        $patient = Patient::find($id);
        if($patient){
            DB::transaction(function () use ($request, $patient)
            {
                $data = $request->data();
    
                $patient->update($data);
    
                // $this->uploadRequestImage($request, $patient);
            });
        }else{
            return abort(404);
        }

        return redirect()->route('patient.index')->withSuccess(trans('messages.update_success', [ 'entity' => 'Patient' ]));
    }

    /**
     * @param patient $patient
     * @return mixed
     */
    public function destroy($id)
    {
        // dd($id);
        $patient = Patient::find($id);
        if($patient){
            $patient->delete();
        }else{
            return abort(404);
        }
        // $patient->delete();

        return redirect()->route('patient.index')->withSuccess(trans('message.delete_success', [ 'entity' => 'Patient' ]));
    }

    /*********** View Patient Detail ***********/
    public function patientDetail($id){
        // dd($id);
        $patient = Patient::with('prescriptions')->find($id);
        if($patient){
            return view('backend.patient.detail',compact('patient'));
        }else{
            return abort(404);
        }
        dd($patient);
    }
}