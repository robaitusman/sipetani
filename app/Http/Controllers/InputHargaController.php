<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputHargaAddRequest;
use App\Http\Requests\InputHargaEditRequest;
use App\Models\InputHarga;
use App\Models\Komoditas;
use App\Models\Komoditas_Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class InputHargaController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.inputharga.list";
		$query = InputHarga::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			InputHarga::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "input_harga.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, InputHarga::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = InputHarga::query();
		$record = $query->findOrFail($rec_id, InputHarga::viewFields());
		return $this->renderView("pages.inputharga.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		$komoditas = Komoditas::orderBy('nama')->get();
		return $this->renderView("pages.inputharga.add", compact('komoditas'));
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(InputHargaAddRequest $request){
		$validated = $request->validated();
		$modeldata = $this->normalizeFormData($validated);
		$hargaInput = $request->input('harga', []);
		$kebutuhanInput = $request->input('kebutuhan', []);
		$ketersediaanInput = $request->input('ketersediaan', []);
		$komoditasNames = Komoditas::pluck('nama', 'id');
		$record = null;
		DB::transaction(function () use (&$record, $modeldata, $hargaInput, $kebutuhanInput, $ketersediaanInput, $komoditasNames) {
			
			//save InputHarga record
			$record = InputHarga::create($modeldata);
			$rows = [];
			foreach($hargaInput as $komoditasId => $harga){
				if($harga === null || $harga === ''){
					continue;
				}
				$kebutuhan = $kebutuhanInput[$komoditasId] ?? null;
				$ketersediaan = $ketersediaanInput[$komoditasId] ?? null;
				$kebutuhan = ($kebutuhan === null || $kebutuhan === '') ? 0 : $kebutuhan;
				$ketersediaan = ($ketersediaan === null || $ketersediaan === '') ? 0 : $ketersediaan;
				$rows[] = [
					'id_komoditas' => $komoditasId,
					'tanggal' => $record->tanggal,
					'kebutuhan' => $kebutuhan,
					'ketersediaan' => $ketersediaan,
					'harga' => $harga,
					'id_trans' => $record->id
				];
			}
			if(!empty($rows)){
				Komoditas_Price::insert($rows);
			}
		});
		$rec_id = $record->id;
		return $this->redirect("inputharga", "Record added successfully");
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(InputHargaEditRequest $request, $rec_id = null){
		$query = InputHarga::query();
		$record = $query->findOrFail($rec_id, InputHarga::editFields());
		$komoditas = Komoditas::orderBy('nama')->get();
		$pricesByKomoditas = Komoditas_Price::where('id_trans', $rec_id)->get()->keyBy('id_komoditas');
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			DB::transaction(function () use ($request, $record, $modeldata, $rec_id, $pricesByKomoditas, $komoditas) {
				$record->update($modeldata);
				$hargaInput = $request->input('harga', []);
				$kebutuhanInput = $request->input('kebutuhan', []);
				$ketersediaanInput = $request->input('ketersediaan', []);
				$komoditasNames = $komoditas->pluck('nama', 'id');
				$processedIds = [];
				foreach($hargaInput as $komoditasId => $harga){
					if($harga === null || $harga === ''){
						continue;
					}
					$kebutuhan = $kebutuhanInput[$komoditasId] ?? null;
					$ketersediaan = $ketersediaanInput[$komoditasId] ?? null;
					$kebutuhan = ($kebutuhan === null || $kebutuhan === '') ? 0 : $kebutuhan;
					$ketersediaan = ($ketersediaan === null || $ketersediaan === '') ? 0 : $ketersediaan;
					$processedIds[] = $komoditasId;
					if($pricesByKomoditas->has($komoditasId)){
						$priceRecord = $pricesByKomoditas->get($komoditasId);
						$priceRecord->tanggal = $record->tanggal;
						$priceRecord->kebutuhan = $kebutuhan;
						$priceRecord->ketersediaan = $ketersediaan;
						$priceRecord->harga = $harga;
						$priceRecord->save();
					}
					else{
						Komoditas_Price::create([
							'id_komoditas' => $komoditasId,
							'tanggal' => $record->tanggal,
							'kebutuhan' => $kebutuhan,
							'ketersediaan' => $ketersediaan,
							'harga' => $harga,
							'id_trans' => $record->id
						]);
					}
				}
				$existingIds = $pricesByKomoditas->keys()->all();
				$deleteIds = array_diff($existingIds, $processedIds);
				if(!empty($deleteIds)){
					Komoditas_Price::where('id_trans', $rec_id)->whereIn('id_komoditas', $deleteIds)->delete();
				}
			});
			return $this->redirect("inputharga", "Record updated successfully");
		}
		return $this->renderView("pages.inputharga.edit", ["data" => $record, "rec_id" => $rec_id, "komoditas" => $komoditas, "pricesByKomoditas" => $pricesByKomoditas]);
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
		$query = InputHarga::query();
		$query->whereIn("id", $arr_id);
		Komoditas_Price::whereIn('id_trans', $arr_id)->delete();
		$query->delete();
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, "Record deleted successfully");
	}
}
