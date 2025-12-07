<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Komoditas_TransAddRequest;
use App\Http\Requests\Komoditas_TransEditRequest;
use App\Models\Komoditas_Trans;
use Illuminate\Http\Request;
use Exception;
class Komoditas_TransController extends Controller
{
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Komoditas_Trans::query();
		$record = $query->findOrFail($rec_id, Komoditas_Trans::viewFields());
		return $this->renderView("pages.komoditas_trans.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.komoditas_trans.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Komoditas_TransAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Komoditas_Trans record
		$record = Komoditas_Trans::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("komoditas_trans", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Komoditas_TransEditRequest $request, $rec_id = null){
		$query = Komoditas_Trans::query();
		$record = $query->findOrFail($rec_id, Komoditas_Trans::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("komoditas_trans", "Record updated successfully");
		}
		return $this->renderView("pages.komoditas_trans.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Komoditas_Trans::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
