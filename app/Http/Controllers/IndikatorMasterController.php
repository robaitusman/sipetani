<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndikatorMasterAddRequest;
use App\Http\Requests\IndikatorMasterEditRequest;
use App\Models\IndikatorMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class IndikatorMasterController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.indikatormaster.list";
		$query = IndikatorMaster::query();
		$limit = $request->limit ?? 40;
		if($request->search){
			$search = trim($request->search);
			IndikatorMaster::search($query, $search); // search table records
		}
		$query->rightJoin("roles", "indikator_master.bidang", "=", "roles.role_id");
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("indikator_master.id", "ASC");
			$query->orderBy("indikator_master.urutan", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->bidang){
			$val = $request->bidang;
			$query->where(DB::raw("indikator_master.bidang"), "=", $val);
		}
		$records = $query->paginate($limit, IndikatorMaster::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = IndikatorMaster::query();
		$query->rightJoin("roles", "indikator_master.bidang", "=", "roles.role_id");
		$record = $query->findOrFail($rec_id, IndikatorMaster::viewFields());
		return $this->renderView("pages.indikatormaster.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		$roles = DB::table('roles')
			->orderBy('role_name')
			->get(['role_id', 'role_name']);
		return $this->renderView("pages.indikatormaster.add", compact('roles'));
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(IndikatorMasterAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save IndikatorMaster record
		$record = IndikatorMaster::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("indikatormaster", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(IndikatorMasterEditRequest $request, $rec_id = null){
		$query = IndikatorMaster::query();
		$record = $query->findOrFail($rec_id, IndikatorMaster::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("indikatormaster", "Record updated successfully");
		}
		$roles = DB::table('roles')
			->orderBy('role_name')
			->get(['role_id', 'role_name']);
		return $this->renderView("pages.indikatormaster.edit", ["data" => $record, "rec_id" => $rec_id, "roles" => $roles]);
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
		$query = IndikatorMaster::query();
		$query->whereIn("id", $arr_id);
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function input(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.indikatormaster.input";
		$query = IndikatorMaster::query();
		$limit = $request->limit ?? 999;
		if($request->search){
			$search = trim($request->search);
			IndikatorMaster::search($query, $search); // search table records
		}
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("indikator_master.urutan", "ASC");
		}
		$userId = auth()->id();
		$periodeId = $request->get('period') ?? getActivePeriod();
		$query->where("bidang", "=" , auth()->user()->user_role_id);
		$query->leftJoin('evaluasi_indikator as evaluasi', function($join) use ($userId, $periodeId){
			$join->on('evaluasi.indikator_master_id', '=', 'indikator_master.id')
				->where('evaluasi.input_by', '=', $userId)
				->where('evaluasi.periode_id', '=', $periodeId);
		});
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, IndikatorMaster::inputFields());
		return $this->renderView($view, compact("records", "periodeId"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function laporan(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.indikatormaster.laporan";
		$query = IndikatorMaster::query();
		$limit = $request->limit ?? 1000;
		if($request->search){
			$search = trim($request->search);
			IndikatorMaster::search($query, $search); // search table records
		}
		$query->leftJoin("roles", "indikator_master.bidang", "=", "roles.role_id");
		$userId = $request->get('user_id');
		$periodeId = $request->get('period') ?? getActivePeriod();
		$query->leftJoin('evaluasi_indikator as evaluasi', function($join) use ($userId, $periodeId){
			$join->on('evaluasi.indikator_master_id', '=', 'indikator_master.id')
				->where('evaluasi.periode_id', '=', $periodeId);
			if($userId){
				$join->where('evaluasi.input_by', '=', $userId);
			}
		});
		if($request->orderby){
			$orderby = $request->orderby;
			$ordertype = ($request->ordertype ? $request->ordertype : "desc");
			$query->orderBy($orderby, $ordertype);
		}
		else{
			$query->orderBy("indikator_master.id", "ASC");
			$query->orderBy("indikator_master.urutan", "ASC");
		}
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, IndikatorMaster::laporanFields());
		$periodes = DB::table('periode_evaluasi')
			->orderBy('tanggal_mulai', 'desc')
			->orderBy('id', 'desc')
			->get(['id', 'nama_periode', 'tahun', 'status_periode']);
		$selectedPeriode = $periodes->firstWhere('id', $periodeId);
		$periodeLabel = $selectedPeriode
			? ($selectedPeriode->nama_periode ?? 'Periode ' . $selectedPeriode->tahun)
			: 'Periode';
		$cards = getDashboardCards($periodeId);
		$summary = getDashboardSummary($periodeId);
		return $this->renderView($view, compact("records", "periodeId", "userId", "periodes", "cards", "summary", "periodeLabel"));
	}
}
