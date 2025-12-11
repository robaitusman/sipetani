<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\IndikatorMaster;

$periodeId = getActivePeriod();
$userId = null;
$query = IndikatorMaster::query();
$query->leftJoin('roles','indikator_master.bidang','=','roles.role_id');
$query->leftJoin('evaluasi_indikator as evaluasi', function($join) use ($periodeId, $userId){
    $join->on('evaluasi.indikator_master_id','=','indikator_master.id')
        ->where('evaluasi.periode_id','=',$periodeId);
    if($userId){
        $join->where('evaluasi.input_by','=',$userId);
    }
});
$sql = $query->select(IndikatorMaster::laporanFields())->toSql();
var_dump($sql);