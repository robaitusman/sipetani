<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * Check if value already exist in Aauth_Users table
	 * @param string $value
     * @return bool
     */
	function aauth_users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('aauth_users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Aauth_Users table
	 * @param string $value
     * @return bool
     */
	function aauth_users_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('aauth_users')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * user_role_id_option_list Model Action
     * @return array
     */
	function user_role_id_option_list(){
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_wilayah_option_list Model Action
     * @return array
     */
	function id_wilayah_option_list(){
		$sqltext = "SELECT  DISTINCT id_wilayah AS value,kelurahan AS label FROM wilayah ORDER BY id_wilayah";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * status_option_list Model Action
     * @return array
     */
	function status_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nama AS label FROM status";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * category_option_list Model Action
     * @return array
     */
	function category_option_list(){
		$sqltext = "SELECT  DISTINCT category_id AS value,category_name AS label FROM blog_category";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * indikator_master_id_option_list Model Action
     * @return array
     */
	function indikator_master_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,indikator_kinerja AS label, satuan FROM indikator_master";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_jenis_ikan_option_list Model Action
     * @return array
     */
	function id_jenis_ikan_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nama AS label FROM jenis_ikan ORDER BY id";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_jenis_option_list Model Action
     * @return array
     */
	function id_jenis_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nama_surat AS label FROM jenis_surat ORDER BY id";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * id_jenis_hewan_option_list Model Action
     * @return array
     */
	function id_jenis_hewan_option_list(){
		$sqltext = "SELECT  DISTINCT id_jenis_hewan AS value,nama_jenis AS label FROM jenis_hewan";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * profil_id_jenis_option_list Model Action
     * @return array
     */
	function profil_id_jenis_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,nama AS label FROM jenis_profil";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * bidang_option_list Model Action
     * @return array
     */
	function bidang_option_list(){
		$sqltext = "SELECT  DISTINCT role_id AS value,role_name AS label FROM roles";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
     * getcount_kiosdaging Model Action
     * @return int
     */
	function getcount_kiosdaging(){
		$sqltext = "SELECT COUNT(*) AS num FROM kios_daging";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * id_wilayah_option_list_2 Model Action
     * @return array
     */
	function id_wilayah_option_list_2(){
		$sqltext = "SELECT  DISTINCT id_wilayah AS value,kelurahan AS label FROM wilayah";
		$query_params = [];
		$arr = DB::select($sqltext, $query_params);
		return $arr;
	}
	

	/**
	* barchart_newchart3 Model Action
	* @return array
	*/
	function barchart_newchart3(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT
    COUNT(kios_daging.id_kios) AS total, 
    wilayah.kelurahan
FROM
    kios_daging
    INNER JOIN
    wilayah
    ON 
        kios_daging.id_wilayah = wilayah.id_wilayah
GROUP BY
    wilayah.kelurahan";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'kelurahan');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'total'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
     * getcount_peternak Model Action
     * @return int
     */
	function getcount_peternak(){
		$sqltext = "SELECT COUNT(*) AS num FROM peternak";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
     * getcount_totalproduksi Model Action
     * @return int
     */
	function getcount_totalproduksi(){
		$sqltext = "SELECT SUM(produksi) AS num FROM peternak ";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
	* barchart_jumlahpeternakberdasarjenis Model Action
	* @return array
	*/
	function barchart_jumlahpeternakberdasarjenis(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT
    COUNT(peternak.id), 
    jenis_hewan.nama_jenis
FROM
    peternak
    INNER JOIN
    jenis_hewan
    ON 
        peternak.id_jenis_hewan = jenis_hewan.id_jenis_hewan
GROUP BY
    peternak.id_jenis_hewan";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'nama_jenis');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'COUNT(peternak.id)'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
	* barchart_jumlahpeternakberdasarkelurahan Model Action
	* @return array
	*/
	function barchart_jumlahpeternakberdasarkelurahan(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT
    COUNT(peternak.id), 
    wilayah.kelurahan
FROM
    peternak
    INNER JOIN
    wilayah
    ON 
        peternak.id_wilayah = wilayah.id_wilayah
GROUP BY
    peternak.id_wilayah";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'kelurahan');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'COUNT(peternak.id)'),
			'label' => "",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '2',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
	

	/**
     * getcount_jumlahdatapoultry Model Action
     * @return int
     */
	function getcount_jumlahdatapoultry(){
		$sqltext = "SELECT COUNT(*) AS num FROM poultry";
		$query_params = [];
		$val = DB::selectOne($sqltext, $query_params);
		return $val->num;
	}
	

	/**
	* barchart_jumlahperkelurahan Model Action
	* @return array
	*/
	function barchart_jumlahperkelurahan(){
		$request = request();
		$chart_data  = [];
		$sqltext = "SELECT
    COUNT(poultry.id_poultry) AS total, 
    wilayah.kelurahan
FROM
    poultry
    INNER JOIN
    wilayah
    ON 
        poultry.id_wilayah = wilayah.id_wilayah
GROUP BY
    wilayah.kelurahan";
		$query_params = [];
		$records = DB::select($sqltext, $query_params);
		$chart_labels = array_column($records, 'kelurahan');
		$datasets = [];
		$dataset1 = [
			'data' =>  array_column($records, 'total'),
			'label' => "Total Per Kelurahan",
	'backgroundColor' =>  random_color(), 
	'borderColor' =>  random_color(), 
	'borderWidth' => '0',
		];
		$datasets[] = $dataset1;
		$chart_data['datasets'] = $datasets;
		$chart_data['labels'] = $chart_labels;
		return $chart_data;
	}
}
