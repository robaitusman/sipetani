<?php

/**
 * print out url
 * @method string  print_link
 * @param string  path
 * @return void
 */


function getDashboardCards($periode_id)
{
    // Mapping bidang berdasarkan role_id
    $bidangMap = [
        5 => ['name' => 'Sekretariat', 'color' => 'secondary', 'icon' => 'fa-building'],
        2 => ['name' => 'Pertanian', 'color' => 'success', 'icon' => 'fa-leaf'],
        3 => ['name' => 'Peternakan', 'color' => 'warning', 'icon' => 'fa-cow'],
        4 => ['name' => 'Ketahanan Pangan', 'color' => 'info', 'icon' => 'fa-wheat'],
        6 => ['name' => 'Perikanan', 'color' => 'primary', 'icon' => 'fa-fish'],
    ];

    // Query total indikator per bidang
    $totalIndikator = DB::table('indikator_master')
        ->select('bidang', DB::raw('COUNT(*) as jumlah'))
        ->groupBy('bidang')
        ->pluck('jumlah', 'bidang')
        ->toArray();

    // Query evaluasi yang sudah diinput per bidang untuk periode tertentu
    $evaluasiTerisi = DB::table('evaluasi_indikator')
        ->join('aauth_users', 'evaluasi_indikator.input_by', '=', 'aauth_users.id')
        ->select('aauth_users.user_role_id as bidang', DB::raw('COUNT(evaluasi_indikator.periode_id) as jumlah'))
        ->where('evaluasi_indikator.periode_id', $periode_id)
        ->groupBy('aauth_users.user_role_id')
        ->pluck('jumlah', 'bidang')
        ->toArray();

    // Gabungkan data
    $cards = [];
    foreach ($bidangMap as $bidangId => $bidangInfo) {
        // Skip admin untuk card bidang
        if ($bidangId == 1) continue;

        $total = $totalIndikator[$bidangId] ?? 0;
        $terisi = $evaluasiTerisi[$bidangId] ?? 0;
        $progress = $total > 0 ? round(($terisi / $total) * 100, 1) : 0;

        $cards[] = [
            'bidang_id' => $bidangId,
            'bidang_name' => $bidangInfo['name'],
            'color' => $bidangInfo['color'],
            'icon' => $bidangInfo['icon'],
            'total_indikator' => $total,
            'terisi' => $terisi,
            'belum_terisi' => $total - $terisi,
            'progress' => $progress,
            'progress_color' => getProgressColor($progress)
        ];
    }

    return $cards;
}

/**
 * Get Progress Bar Color based on percentage
 * 
 * @param float $progress
 * @return string
 */
function getProgressColor($progress)
{
    if ($progress >= 80) return 'success';
    if ($progress >= 50) return 'info';
    if ($progress >= 30) return 'warning';
    return 'danger';
}

/**
 * Get Summary Dashboard
 * 
 * @param int $periode_id
 * @return array
 */
function getDashboardSummary($periode_id)
{
    $cards = getDashboardCards($periode_id);
    
    $totalIndikator = array_sum(array_column($cards, 'total_indikator'));
    $totalTerisi = array_sum(array_column($cards, 'terisi'));
    $progressKeseluruhan = $totalIndikator > 0 ? round(($totalTerisi / $totalIndikator) * 100, 1) : 0;

    return [
        'total_indikator' => $totalIndikator,
        'total_terisi' => $totalTerisi,
        'total_belum_terisi' => $totalIndikator - $totalTerisi,
        'progress_keseluruhan' => $progressKeseluruhan,
        'progress_color' => getProgressColor($progressKeseluruhan)
    ];
}






/**
 * Get Dashboard Cards Data Adata by Periode
 * 
 * @param int $periode_id
 * @return array
 */
function getDashboardCardsAdata($periode_id)
{
    // Mapping bidang berdasarkan role_id
    $bidangMap = [
        5 => ['name' => 'Sekretariat', 'color' => 'secondary', 'icon' => 'fa-building'],
        2 => ['name' => 'Pertanian', 'color' => 'success', 'icon' => 'fa-leaf'],
        3 => ['name' => 'Peternakan', 'color' => 'warning', 'icon' => 'fa-cow'],
        4 => ['name' => 'Ketahanan Pangan', 'color' => 'info', 'icon' => 'fa-wheat'],
        6 => ['name' => 'Perikanan', 'color' => 'primary', 'icon' => 'fa-fish'],
    ];

    // Query total indikator per bidang dari master_adata
    $totalIndikator = DB::table('master_adata')
        ->select('bidang', DB::raw('COUNT(*) as jumlah'))
        ->groupBy('bidang')
        ->pluck('jumlah', 'bidang')
        ->toArray();

    // Query evaluasi yang sudah diinput per bidang untuk periode tertentu dari evaluasi_adata
    $evaluasiTerisi = DB::table('evaluasi_adata')
        ->join('aauth_users', 'evaluasi_adata.input_by', '=', 'aauth_users.id')
        ->select('aauth_users.user_role_id as bidang', DB::raw('COUNT(evaluasi_adata.periode_id) as jumlah'))
        ->where('evaluasi_adata.periode_id', $periode_id)
        ->groupBy('aauth_users.user_role_id')
        ->pluck('jumlah', 'bidang')
        ->toArray();

    // Gabungkan data
    $cards = [];
    foreach ($bidangMap as $bidangId => $bidangInfo) {
        $total = $totalIndikator[$bidangId] ?? 0;
        $terisi = $evaluasiTerisi[$bidangId] ?? 0;
        $progress = $total > 0 ? round(($terisi / $total) * 100, 1) : 0;

        $cards[] = [
            'bidang_id' => $bidangId,
            'bidang_name' => $bidangInfo['name'],
            'color' => $bidangInfo['color'],
            'icon' => $bidangInfo['icon'],
            'total_indikator' => $total,
            'terisi' => $terisi,
            'belum_terisi' => $total - $terisi,
            'progress' => $progress,
            'progress_color' => getProgressColor($progress)
        ];
    }

    return $cards;
}

/**
 * Get Summary Dashboard Adata
 * 
 * @param int $periode_id
 * @return array
 */
function getDashboardSummaryAdata($periode_id)
{
    $cards = getDashboardCardsAdata($periode_id);
    
    $totalIndikator = array_sum(array_column($cards, 'total_indikator'));
    $totalTerisi = array_sum(array_column($cards, 'terisi'));
    $progressKeseluruhan = $totalIndikator > 0 ? round(($totalTerisi / $totalIndikator) * 100, 1) : 0;

    return [
        'total_indikator' => $totalIndikator,
        'total_terisi' => $totalTerisi,
        'total_belum_terisi' => $totalIndikator - $totalTerisi,
        'progress_keseluruhan' => $progressKeseluruhan,
        'progress_color' => getProgressColor($progressKeseluruhan)
    ];
}



if (! function_exists('getActivePeriod')) {
    function getActivePeriod()
    {
        return DB::table('periode_evaluasi')
            ->where('status_periode', 'active')
            ->value('id'); 
        // pakai value('id') agar langsung ambil 1 nilai kolom id
    }
}

if (! function_exists('getEvaluasi')) {
    function getEvaluasi($indikatorMasterId, $userId, $periodeId)
    {
        return DB::table('evaluasi_indikator')
            ->where('indikator_master_id', $indikatorMasterId)
            ->where('input_by', $userId)
            ->where('periode_id', $periodeId)
            ->first();
    }
}


if (! function_exists('getEvaluasiAdata')) {
    function getEvaluasiAdata($indikatorMasterId, $userId, $periodeId)
    {
        return DB::table('evaluasi_adata')
            ->where('master_adata_id', $indikatorMasterId)
            ->where('input_by', $userId)
            ->where('periode_id', $periodeId)
            ->first();
    }
}



    function getSummarySakip($id_user, $id_periode, $role_id)
    {
        try {
            // Hitung total kewajiban
            $total = DB::table('indikator_master')
                ->where('bidang', $role_id)
                ->count('id');

			
            // Hitung sudah input
            $sudah = DB::table('evaluasi_indikator')
                ->where('input_by', $id_user)
                ->where('periode_id', $id_periode)
                ->count();

            $belum = max($total - $sudah, 0);

            $persen = 0;
            if ($total > 0) {
                $persen = round(min(($sudah / $total) * 100, 100), 2);
            }
            return [
                'persen' => $persen,
                'sudah' => $sudah,
                'belum' => $belum,
                'total' => $total,
            ];
        } catch (Exception $e) {
            Log::error('Error in getSummaryInput: ' . $e->getMessage());
            return [
                'persen' => 0,
                'sudah' => 0,
                'belum' => 0,
                'total' => 0,
            ];
        }
    }


	 function getSummaryAdata($id_user, $id_periode, $role_id)
    {
        try {
            // Hitung total kewajiban
      $total = DB::table('master_adata')
            ->where('bidang', $role_id)
            ->where('is_input', 1)
            ->count('id');

			
            // Hitung sudah input
            $sudah = DB::table('evaluasi_adata')
                ->where('input_by', $id_user)
                ->where('periode_id', $id_periode)
                ->count();

            $belum = max($total - $sudah, 0);

            return [
                // Avoid division by zero when there is no kewajiban recorded
                'persen' => $total > 0 ? round(min(($sudah / $total) * 100, 100), 2) : 0,
                'sudah' => $sudah,
                'belum' => $belum,
                'total' => $total,
            ];
        } catch (Exception $e) {
            Log::error('Error in getSummaryInput: ' . $e->getMessage());
            return [
                'persen' => 0,
                'sudah' => 0,
                'belum' => 0,
                'total' => 0,
            ];
        }
    }







function preserveIndentation($text) {
    $text = htmlspecialchars($text);
    $lines = explode("\n", $text);
    
    foreach($lines as &$line) {
        // Hitung spasi di awal baris
        preg_match('/^(\s*)/', $line, $matches);
        if (!empty($matches[1])) {
            $spaces = str_repeat('&nbsp;', strlen($matches[1]));
            $line = $spaces . ltrim($line);
        }
    }
    
    return implode("<br>", $lines);
}



if (!function_exists('getPersenAdata')) {
    /**
     * Menghitung persentase input evaluasi indikator
     *
     * @param int $id_user ID user yang melakukan input
     * @param int $id_periode ID periode evaluasi
     * @param int $role_id Role ID untuk menentukan bidang
     * @return float Persentase completion (0-100)
     */
    function getPersenAdata($id_user, $id_periode, $role_id)
    {
        try {
            // Hitung kewajiban input berdasarkan role/bidang
            $kewajiban_input = DB::table('master_adata')
                ->where('bidang', $role_id)
                ->count('id');
            
            // Jika tidak ada kewajiban input, return 0
            if ($kewajiban_input == 0) {
                return 0;
            }
            
            // Hitung sudah input
            $sudah_input = DB::table('evaluasi_adata')
                ->where('input_by', $id_user)
                ->where('periode_id', $id_periode)
                ->count();
            
            // Hitung persentase
            $persen = ($sudah_input / $kewajiban_input) * 100;
            
            // Return dengan 2 digit decimal, max 100%
            return round(min($persen, 100), 2);
            
        } catch (Exception $e) {
            // Log error dan return 0 jika terjadi kesalahan
            Log::error('Error in getPersen function: ' . $e->getMessage());
            return 0;
        }
    }
}



function print_link($path = "", $appendCurrentQueryString=false)
{
	if($appendCurrentQueryString){
		$arrQs = request()->query();
		if(!empty($arrQs)){
			$path = $path . '?' . http_build_query($arrQs);
		}
	}
	echo url($path);
}

/**
 * print out url
 * @method string  print_link
 * @param string  path
 * @return void
 */
function getImgSizePath($src, $size="medium")
{
	if($src){
		//currently Radsystems does not save different sizes of images in s3 bucket
		//rough implementation of detecting s3 bucket file
		$isawsS3File = stripos($src, ".amazonaws.com") > 5; 
		if($size &&  !$isawsS3File){
			$paths = explode("/", $src);
			$lastpath = count($paths) - 1;
			array_splice($paths, $lastpath, 0, $size);
			$src = implode("/", $paths);
		}
	}
	else{
		$src = "images/no-image-available.png";
	}
	return url($src);
}



/**
 * Return the GET value from the request or a default value
 * @method string  get_value
 * @param string  $fieldname
 * @param string  $default
 * @return string
 */
function get_value($fieldname, $default = "")
{
	return request()->get($fieldname, $default);
}

/**
 * replace non alphabetical letters with hyphen and convert to lower case
 * @method string slugify
 * @param string $text
 * @return string
 */
function slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);
	return $text;
}

/**
 * Generates RFC 4122 compliant Version 4 UUIDs.
 * @param  string $data
 * @return string
 */
function guidv4($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

/**
 * Convert a multi-dimensional, associative array to CSV data
 * @param  array $data the array of data
 * @return string
 */
function arr_to_csv($data)
{
	# Generate CSV data from array
	$fh = fopen('php://temp', 'rw'); # don't create a file, attempt # to use memory instead
	# write out the headers
	fputcsv($fh, array_keys(current($data)));
	# write out the data
	foreach ($data as $row) {
		fputcsv($fh, $row);
	}
	rewind($fh);
	$csv = stream_get_contents($fh);
	fclose($fh);
	return $csv;
}

/**
 * Recursively implodes an array with optional key inclusion
 * 
 * Example of $include_keys output: key, value, key, value, key, value
 * 
 * @access  public
 * @param   array   $array         multi-dimensional array to recursively implode
 * @param   string  $glue          value that glues elements together	
 * @param   bool    $include_keys  include keys before their values
 * @param   bool    $trim_all      trim ALL whitespace from string
 * @return  string  imploded array
 */
function recursive_implode(array $array, $glue = ',', $include_keys = false, $trim_all = false)
{
	$glued_string = '';
	// Recursively iterates array and adds key/value to glued string
	array_walk_recursive($array, function ($value, $key) use ($glue, $include_keys, &$glued_string) {
		$include_keys and $glued_string .= $key . $glue;
		$glued_string .= $value . $glue;
	});
	// Removes last $glue from string
	strlen($glue) > 0 and $glued_string = substr($glued_string, 0, -strlen($glue));
	// Trim ALL whitespace
	$trim_all and $glued_string = preg_replace("/(\s)/ixsm", '', $glued_string);
	return (string) $glued_string;
}


/**
 * Convert laravel validation error message bag to string
 * @access  public
 * @param   array   $errArray
 * @return  string  imploded array
 */
function validationErrorsToString($errArray)
{
	$valArr = array();
	foreach ($errArray->toArray() as $key => $value) {
		$errStr = $key . ' ' . $value[0];
		array_push($valArr, $errStr);
	}
	if (!empty($valArr)) {
		$errStrFinal = implode(',', $valArr);
	}
	return $errStrFinal;
}

/**
 * Build new url with additional query params
 * @param array $params
 * @example URL before:
 * https://example.com/orders/123?order=ABC009
 *
 * 1. add_query_params(['status' => 'shipped'])
 * 2. add_query_params(['status' => 'shipped', 'coupon' => 'CCC2019'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009&status=shipped
 * 2. https://example.com/orders/123?order=ABC009&status=shipped&coupon=CCC2019
 * 
 * @return string
 */
function add_query_params(array $params = [])
{
	$query = array_merge(
		request()->query(),
		$params
	); // merge the existing query parameters with the ones we want to add

	return url()->current() . '?' . http_build_query($query); // rebuild the URL with the new parameters array
}

/**
 * Build new url by removing specified query params
 * @param array $params
 * @example URL before:
 * https://example.com/orders/123?order=ABC009&status=shipped
 *
 * 1. remove_query_params(['status'])
 * 2. remove_query_params(['status', 'order'])
 *
 * URL after:
 * 1. https://example.com/orders/123?order=ABC009
 * 2. https://example.com/orders/123
 * 
 * @return string
 */
function remove_query_params(array $params = [])
{
	$url = url()->current(); // get the base URL - everything to the left of the "?"
	$query = request()->query(); // get the query parameters (what follows the "?")

	foreach ($params as $param) {
		unset($query[$param]); // loop through the array of parameters we wish to remove and unset the parameter from the query array
	}
	return $query ? $url . '?' . http_build_query($query) : $url; // rebuild the URL with the remaining parameters, don't append the "?" if there aren't any query parameters left
}


/**
 * Parse csv file into multidimensional array
 * @param string $file_path
 * @param array $options
 * @return array
 */
function parse_csv_file($file_path, $options)
{
	$arr_data = array();
	if (($csv_handle = fopen($file_path, "r")) === FALSE)
		throw new Exception('Cannot open CSV file');

	extract($options);

	if (empty($fields)) {
		$columns = array_map(function ($field) {
			return strtolower(preg_replace("/[^a-zA-Z0-9_]/i", '', $field));
		}, fgetcsv($csv_handle, 0, $delimiter, $quote));
	} else {
		$columns = (is_array($fields) ? $fields : explode(",", $fields));
	}

	if (empty($delimiter))
		$delimiter = ',';

	if (empty($quote))
		$quote = '"';

	while (($row = fgetcsv($csv_handle, 0, $delimiter, $quote)) !== FALSE) {
		$arr_data[] = array_combine($columns, $row);
	}
	return $arr_data;
}


/**
 * Sometimes REMOTE_ADDR does not returns the correct IP address of the user. 
 * The reason behind this is to use Proxy. In that situation, use the following code to get real IP address of user in PHP.
 * @return string
 */
function get_user_ip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//ip pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

/**
 * encode data to json and convert special characters to unicode 
 * for display in HTMl attribute
 * @param string $data
 * @return  string
 */
function json_encode_quote($data)
{
	return json_encode($data, JSON_HEX_APOS | JSON_HEX_QUOT);
}

/**
 * Merge array of paths to a url
 * 
 * @method string saveFile
 * @param array $arr_paths
 * @param string $separator
 * @return string
 */
function path_combine($arr_paths, $separator = "/")
{
	$paths = [];
	foreach ($arr_paths as $path) {
		$path = str_replace('/', $separator, $path);
		$path = str_replace('\\', $separator, $path);
		$paths[] = trim($path, $separator);
	}
	$paths = array_filter($paths);
	return join($separator, $paths);
}



/**
 * will return current DateTime in Mysql Default Date Time Format
 * @return  string
 */
function datetime_now()
{
	return date("Y-m-d H:i:s");
}

/**
 * will return current Time in Mysql Default Date Time Format
 * @return  string
 */
function time_now()
{
	return date("H:i:s");
}

/**
 * will return current Date in Mysql Default Date Time Format
 * @return  string
 */
function date_now()
{
	return date("Y-m-d");
}

/**
 * will return a date in specified format
 * @param string $date_str
 * @param string $format
 * @return  string
 */
function format_date($date_str, $format = 'Y-m-d H:i:s')
{
	if (!empty($date_str)) {
		return date($format, strtotime($date_str));
	}
	return date($format);
}

/**
 * @param int file size in bytes (eg. 25907)
 * @param int $precision [optional] Number of digits after the decimal point (eg. 1)
 * @return string Value converted with unit (eg. 25.3KB)
 */
function format_size($bytes, $precision = 0) {
    $unit = ["B", "KB", "MB", "GB"];
    $exp = floor(log($bytes, 1024)) | 0;
    return round($bytes / (pow(1024, $exp)), $precision)." ".$unit[$exp];
}

/**
 * Parse Date Or Timestamp Object into Relative Time (e.g. 2 days Ago, 2 days from now)
 * @param string $date
 * @return  string
 */
function relative_date($date)
{
	if (empty($date)) {
		return "";
	}

	$periods = array("sec", "min", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

	$now = time();

	//check if supplied Date is in unix date form
	if (is_numeric($date)) {
		$unix_date        = $date;
	} else {
		$unix_date         = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}

	// is it future date or past date
	if ($now > $unix_date) {
		$difference     = $now - $unix_date;
		$tense         = "ago";
	} else {
		$difference     = $unix_date - $now;
		$tense         = "from now";
	}

	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if ($difference != 1) {
		$periods[$j] .= "s";
	}

	return "$difference $periods[$j] {$tense}";
}


/**
 * Parse Date Or Timestamp Object into Human Readable Date (e.g. 26th of March 2016)
 * @param string $date
 * @return  string
 */
function human_date($date)
{
    if (empty($date)) {
        return "Null date";
    }

    if (is_numeric($date)) {
        $unix_date = $date;
    } else {
        $unix_date = strtotime($date);
    }

    // check validity of date
    if (empty($unix_date)) {
        return "Bad date";
    }

    // daftar nama bulan Indonesia
    $bulan = [
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    $tgl   = date("j", $unix_date);
    $bln   = $bulan[(int)date("n", $unix_date)];
    $thn   = date("Y", $unix_date);

    return $tgl . " " . $bln . " " . $thn;
}


/**
 * Parse Date Or Timestamp Object into Human Readable time (e.g. 04:30 PM)
 * @param string $date
 * @return  string
 */
function human_time($date)
{
	if (empty($date)) {
		return "Null date";
	}
	if (is_numeric($date)) {
		$unix_date        = $date;
	} else {
		$unix_date         = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}
	return date("h:i:s", $unix_date);
}

/**
 * Parse Date Or Timestamp Object into Human Readable Date (e.g. 26th of March, 2016 02:30)
 * @param string $date
 * @return  string
 */
function human_datetime($date)
{
	if (empty($date)) {
		return "Null date";
	}
	if (is_numeric($date)) {
		$unix_date = $date;
	} else {
		$unix_date = strtotime($date);
	}
	// check validity of date
	if (empty($unix_date)) {
		return "Bad date";
	}
	return date("jS F, Y h:i", $unix_date);
}

/**
 * Approximate to nearest decimal points
 * @param string $val
 * @param int $decimal_points
 * @return  int|float
 */
function approximate($val, $decimal_points = 2)
{
	return number_format($val, $decimal_points);
}

/**
 * Return String formatted in currency mode
 * @param string $val
 * @param string $lang
 * @return  string
 */
function to_currency($val, $lang = 'en-US')
{
	$f = new NumberFormatter($lang, \NumberFormatter::CURRENCY);
	return $f->format($val);
}

/**
 * return a numerical representation of the string in a readable format
 * @param string $val
 * @param string $lang
 * @return  string
 */
function to_number($val, $lang = 'en')
{
	$f = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
	return $f->format($val);
}

/**
 * Trucate string
 * @return  string
 */
function str_truncate($string, $length = 50, $ellipse = '...')
{
	if (strlen($string) > $length) {
		$string = substr($string, 0, $length) . $ellipse;
	}
	return $string;
}

/**
 * Convert Number to words
 * @param string $val
 * @param string $lang
 * @return  string
 */
function number_to_words($val, $lang = "en")
{
	$f = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
	return $f->format($val);
}

function array_change_key_name($array, $newkey, $oldkey)
{
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$array[$key] = array_change_key_name($value, $newkey, $oldkey);
		} else {
			$array[$newkey] =  $array[$oldkey];
		}
	}
	unset($array[$oldkey]);
	return $array;
}
/**
 * Generate a random string and characters from set of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_chars($limit = 12, $context = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*_+-=')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random String From Set Of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_str($limit = 12, $context = 'abcdefghijklmnopqrstuvwxyz1234567890')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random String From Set Of supplied data context
 * @param int $limit
 * @param string $context
 * @return  string
 */
function random_num($limit = 10, $context = '1234567890')
{
	$l = ($limit <= strlen($context) ? $limit : strlen($context));
	return substr(str_shuffle($context), 0, $l);
}

/**
 * Generate a Random color String 
 * @param int $alpha
 * @return  string
 */
function random_color($alpha = 1)
{
	$red = rand(0, 255);
	$green = rand(0, 255);
	$blue = rand(0, 255);
	return "rgba($red,$blue,$green,$alpha)";
}

/**
 * Generate array Random color 
 * @param int $num
 * @param float $alpha
 * @return  array
 */
function arr_random_color($num, $alpha = 1)
{
	$colors = [];
	for($i=0; $i<$num; $i++){
		$colors[] = random_color($alpha);
	}
	return $colors;
}

/**
 * return active if current GET request contains field value
 * @param string $field
 * @param string $value
 * @return  string
 */
function is_active_link($field, $value)
{
	$get =  filter_input_array(INPUT_GET);
	if (!empty($get[$field]) && $get[$field] == $value) {
		return "active";
	}
	return null;
}

/**
 * Get number of files in a directory
 * @param string $dirpath
 * @return  int
 */
function get_dir_file_count($dirpath)
{
	$filecount = 0;
	$files = glob($dirpath . "*");
	if ($files) {
		$filecount = count($files);
	}
	return $filecount;
}

/**
 * Format text by removing non letters characters with space.
 * @param string $string
 * @return  string
 */
function make_readable($string = '')
{
	if (!empty($string)) {
		$string = preg_replace("/[^a-zA-Z0-9]/", ' ', $string);
		$string = trim($string);
		$string = ucwords($string);
		$string = preg_replace('/\s+/', ' ', $string);
	}
	return $string;
}


if (!function_exists('getPertanianData')) {
    function getPertanianData()
    {
        $data = [];
        
        // Card counts (tanpa filter status)
        $data['cards'] = [
            'kios_pupuk' => DB::table('kios_pupuk')->count(),
            'pelaku_usaha_tani' => DB::table('pelaku_usaha_tani')->count(),
            'pupo' => DB::table('pupo')->count(),
            'toko_tani' => DB::table('toko_tani')->count(),
            'p4s' => DB::table('p4s')->count(),
            'kel_tani' => DB::table('kel_tani')->count(),
        ];
        
        // Grafik per jenis kelompok tani (tanpa filter status)
        $data['chart_jenis'] = DB::table('kel_tani')
            ->select('jenis', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis')
            ->get();
            
        // Grafik per kelurahan (gabungan semua tabel pertanian, tanpa filter status)
        $kelurahan_data = collect();
        
        $tables = ['kios_pupuk', 'pelaku_usaha_tani', 'pupo', 'toko_tani', 'p4s', 'kel_tani'];
        foreach ($tables as $table) {
            $temp = DB::table($table . ' as t')
                ->join('wilayah as w', 't.id_wilayah', '=', 'w.id_wilayah')
                ->select('w.kelurahan')
                ->get();
            $kelurahan_data = $kelurahan_data->merge($temp);
        }
        
        $data['chart_kelurahan'] = $kelurahan_data->groupBy('kelurahan')
            ->map(function ($items, $kelurahan) {
                return (object)['kelurahan' => $kelurahan, 'jumlah' => $items->count()];
            })->values();
            
        // Data untuk map - PERBAIKAN: gunakan individual queries dengan jenis_nama
        $mapData = collect();
        
        // 1. Kios Pupuk (id_jenis_map = 12)
        $kiosPupuk = DB::table('kios_pupuk as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kiosPupuk);
        
        // 2. Pelaku Usaha Tani (id_jenis_map = 10)
        $pelakuUsahaTani = DB::table('pelaku_usaha_tani as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($pelakuUsahaTani);
        
        // 3. PUPO (id_jenis_map = 11)
        $pupo = DB::table('pupo as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($pupo);
        
        // 4. Toko Tani (id_jenis_map = 8)
        $tokoTani = DB::table('toko_tani as t')
            ->join('map as m', 't.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 't.id_wilayah', '=', 'w.id_wilayah')
            ->select('t.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($tokoTani);
        
        // 5. P4S (id_jenis_map = 2)
        $p4s = DB::table('p4s as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($p4s);
        
        // 6. Kelompok Tani (id_jenis_map = 14)
        $kelTani = DB::table('kel_tani as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kelTani);
        
        $data['map_data'] = $mapData;
            
        return $data;
    }
}

// Fixed Perikanan function dengan jenis_nama
if (!function_exists('getPerikananData')) {
    function getPerikananData()
    {
        $data = [];
        
        // Card counts (tanpa filter status)
        $data['cards'] = [
            'bbi' => DB::table('bbi')->count(),
            'kelompok_ikan' => DB::table('kelompok_ikan')->count(),
            'kelompok_ikan_hias' => DB::table('kelompok_ikan_hias')->count(),
            'kelompok_pemasar_ikan' => DB::table('kelompok_pemasar_ikan')->count(),
            'tpi' => DB::table('tpi')->count(),
        ];
        
        // Grafik per jenis ikan (tanpa filter status)
        $data['chart_jenis'] = DB::table('kelompok_ikan as ki')
            ->join('jenis_ikan as ji', 'ki.id_jenis_ikan', '=', 'ji.id')
            ->select('ji.Nama as nama_jenis', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('ji.Nama')
            ->get();
            
        // Grafik per kelurahan (gabungan semua tabel perikanan, tanpa filter status)
        $kelurahan_data = collect();
        
        $tables = ['bbi', 'kelompok_ikan', 'kelompok_ikan_hias', 'kelompok_pemasar_ikan', 'tpi'];
        foreach ($tables as $table) {
            $temp = DB::table($table . ' as t')
                ->join('wilayah as w', 't.id_wilayah', '=', 'w.id_wilayah')
                ->select('w.kelurahan')
                ->get();
            $kelurahan_data = $kelurahan_data->merge($temp);
        }
        
        $data['chart_kelurahan'] = $kelurahan_data->groupBy('kelurahan')
            ->map(function ($items, $kelurahan) {
                return (object)['kelurahan' => $kelurahan, 'jumlah' => $items->count()];
            })->values();
            
        // Data untuk map - PERBAIKAN: gunakan individual queries dengan jenis_nama
        $mapData = collect();
        
        // 1. BBI (id_jenis_map = 7)
        $bbi = DB::table('bbi as b')
            ->join('map as m', 'b.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'b.id_wilayah', '=', 'w.id_wilayah')
            ->select('b.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($bbi);
        
        // 2. Kelompok Ikan (id_jenis_map = 3)
        $kelompokIkan = DB::table('kelompok_ikan as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kelompokIkan);
        
        // 3. Kelompok Ikan Hias (id_jenis_map = 5)
        $kelompokIkanHias = DB::table('kelompok_ikan_hias as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kelompokIkanHias);
        
        // 4. Kelompok Pemasar Ikan (id_jenis_map = 4)
        $kelompokPemasarIkan = DB::table('kelompok_pemasar_ikan as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kelompokPemasarIkan);
        
        // 5. TPI (id_jenis_map = 6)
        $tpi = DB::table('tpi as t')
            ->join('map as m', 't.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 't.id_wilayah', '=', 'w.id_wilayah')
            ->select('t.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($tpi);
        
        $data['map_data'] = $mapData;
            
        return $data;
    }
}


if (!function_exists('getKetahananPanganData')) {
    function getKetahananPanganData()
    {
        $data = [];
        
        // Ambil tanggal transaksi terakhir
        $latestTransDate = DB::table('komoditas_trans')->max('tanggal');
        
        // Card counts
        $data['cards'] = [
            'komoditas' => DB::table('komoditas')->count(),
            'transaksi_terakhir' => DB::table('komoditas_trans')->whereDate('tanggal', $latestTransDate)->count(),
            'total_transaksi' => DB::table('komoditas_trans')->count(),
        ];
        
        // Total kebutuhan dan ketersediaan dari data terbaru
        $latest_data = DB::table('komoditas_price as kp')
            ->join('komoditas_trans as kt', 'kp.id_trans', '=', 'kt.id')
            ->where('kt.tanggal', $latestTransDate)
            ->select(
                DB::raw('SUM(kp.kebutuhan) as total_kebutuhan'),
                DB::raw('SUM(kp.ketersediaan) as total_ketersediaan')
            )
            ->first();
            
        $data['total_kebutuhan'] = $latest_data->total_kebutuhan ?? 0;
        $data['total_ketersediaan'] = $latest_data->total_ketersediaan ?? 0;
        $data['tanggal_terakhir'] = $latestTransDate;
        
        // PERBAIKAN: Grafik per komoditas (harga dari transaksi terbaru)
        $data['chart_jenis'] = DB::table('komoditas_price as kp')
            ->join('komoditas as k', 'kp.id_komoditas', '=', 'k.id')
            ->join('komoditas_trans as kt', 'kp.id_trans', '=', 'kt.id')
            ->select('k.nama', 'kp.harga', 'kp.kebutuhan', 'kp.ketersediaan', 'kt.tanggal')
            ->where('kt.tanggal', $latestTransDate) // Ambil dari transaksi terbaru
            ->orderBy('kp.harga', 'desc')
            ->get();
            
        // Chart trend harga beberapa hari terakhir (jika ada data historis)
        $data['chart_trend'] = DB::table('komoditas_price as kp')
            ->join('komoditas as k', 'kp.id_komoditas', '=', 'k.id')
            ->join('komoditas_trans as kt', 'kp.id_trans', '=', 'kt.id')
            ->select('k.nama', 'kp.harga', 'kt.tanggal')
            ->where('kt.tanggal', '>=', now()->subDays(30)) // 30 hari terakhir
            ->orderBy('kt.tanggal', 'desc')
            ->orderBy('k.nama')
            ->get();
            
        // Alternative: Jika ingin harga terbaru per komoditas dari berbagai tanggal
        $data['chart_jenis_alternative'] = DB::table('komoditas_price as kp')
            ->join('komoditas as k', 'kp.id_komoditas', '=', 'k.id')
            ->join('komoditas_trans as kt', 'kp.id_trans', '=', 'kt.id')
            ->select('k.nama', 'kp.harga', 'kp.kebutuhan', 'kp.ketersediaan', 'kt.tanggal')
            ->whereIn('kp.id', function($query) {
                $query->select(DB::raw('MAX(kp2.id)'))
                      ->from('komoditas_price as kp2')
                      ->join('komoditas_trans as kt2', 'kp2.id_trans', '=', 'kt2.id')
                      ->groupBy('kp2.id_komoditas');
            })
            ->orderBy('kp.harga', 'desc')
            ->get();
            
        return $data;
    }
}

// Helper function untuk chart dengan format yang tepat
if (!function_exists('formatKetahananPanganChart')) {
    function formatKetahananPanganChart($chartData)
    {
        return $chartData->map(function($item) {
            return (object)[
                'nama' => $item->nama,
                'jumlah' => $item->harga // untuk menggunakan generateChartScript yang ada
            ];
        });
    }
}


// Fixed Peternakan function - ambil semua data peternakan
if (!function_exists('getPeternakanData')) {
    function getPeternakanData()
    {
        $data = [];
        
        // Card counts
        $data['cards'] = [
            'peternak' => DB::table('peternak')->count(),
            'pelaku_usaha_peternakan' => DB::table('pelaku_usaha_peternakan')->count(),
            'poultry' => DB::table('poultry')->count(),
            'kios_daging' => DB::table('kios_daging')->count(),
            'gudang_telur' => DB::table('gudang_telur')->count(),
        ];
        
        // Total produksi
        $data['total_produksi'] = DB::table('peternak')->sum('produksi');
        
        // Grafik per jenis hewan
        $data['chart_jenis'] = DB::table('peternak as p')
            ->join('jenis_hewan as jh', 'p.id_jenis_hewan', '=', 'jh.id_jenis_hewan')
            ->select('jh.nama_jenis', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jh.nama_jenis')
            ->get();
            
        // Grafik per kelurahan
        $data['chart_kelurahan'] = DB::table('peternak as p')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('w.kelurahan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('w.kelurahan')
            ->get();
            
        // Data untuk map dengan multiple tables - PERBAIKAN DI SINI
        $mapData = collect();
        
        // 1. Peternak (id_jenis_map = 1)
        $peternak = DB::table('peternak as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($peternak);
        
        // 2. Pelaku Usaha Peternakan (id_jenis_map = 20)
        $pelakuUsaha = DB::table('pelaku_usaha_peternakan as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($pelakuUsaha);
        
        // 3. Poultry (id_jenis_map = 9)
        $poultry = DB::table('poultry as p')
            ->join('map as m', 'p.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'p.id_wilayah', '=', 'w.id_wilayah')
            ->select('p.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($poultry);
        
        // 4. Kios Daging (id_jenis_map = 13)
        $kiosDaging = DB::table('kios_daging as k')
            ->join('map as m', 'k.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'k.id_wilayah', '=', 'w.id_wilayah')
            ->select('k.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($kiosDaging);
        
        // 5. Gudang Telur (id_jenis_map = 19)
        $gudangTelur = DB::table('gudang_telur as g')
            ->join('map as m', 'g.id_map', '=', 'm.id')
            ->join('jenis_map as jm', 'm.id_jenis_map', '=', 'jm.id')
            ->join('wilayah as w', 'g.id_wilayah', '=', 'w.id_wilayah')
            ->select('g.*', 'm.latitude', 'm.longitude', 'm.address', 'jm.url_icon', 'jm.nama as jenis_nama', 'w.kelurahan', 'w.kecamatan')
            ->get();
        $mapData = $mapData->merge($gudangTelur);
        
        $data['map_data'] = $mapData;
            
        return $data;
    }
}

// Updated Map Script menggunakan jenis_nama dari tabel jenis_map
if (!function_exists('generateMapScript')) {
    function generateMapScript($mapData, $mapId = 'map', $centerLat = -8.0947823, $centerLng = 112.1446563, $zoom = 13)
    {
        // Collect unique data types for legend berdasarkan jenis_nama
        $dataTypes = [];
        $typeColorMap = [];
        $colorIndex = 0;
        
        if (!empty($mapData) && count($mapData) > 0) {
            foreach ($mapData as $item) {
                $dataType = isset($item->jenis_nama) ? $item->jenis_nama : 'Data';
                
                if (!in_array($dataType, $dataTypes)) {
                    $dataTypes[] = $dataType;
                    $typeColorMap[$dataType] = $colorIndex % 18;
                    $colorIndex++;
                }
            }
        }
        
        $script = "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing map with jenis_map names: $mapId');
            
            // Initialize map
            var map = L.map('$mapId').setView([$centerLat, $centerLng], $zoom);
            
            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            var markers = [];
            
            // Data types and their colors
            var dataTypeColors = " . json_encode($typeColorMap) . ";
            
            // Function to get marker color based on index
            function getMarkerColor(index) {
                var colors = [
                    '#3388ff', // blue
                    '#ff3333', // red
                    '#33ff33', // green
                    '#ff8833', // orange
                    '#ffff33', // yellow
                    '#8833ff', // violet
                    '#888888', // grey
                    '#333333', // black
                    '#ff6699', // pink
                    '#66ffff', // cyan
                    '#ffcc33', // gold
                    '#cc33ff', // purple
                    '#33ccff', // light blue
                    '#ff6633', // red orange
                    '#ccff33', // lime
                    '#ff33cc', // magenta
                    '#33ff99', // mint
                    '#9933ff'  // blue violet
                ];
                return colors[index % colors.length];
            }
        ";
        
        if (!empty($mapData) && count($mapData) > 0) {
            foreach ($mapData as $item) {
                if (!empty($item->latitude) && !empty($item->longitude)) {
                    $popupContent = isset($item->nama) ? addslashes($item->nama) : (isset($item->nama_usaha) ? addslashes($item->nama_usaha) : 'Data');
                    $address = isset($item->address) ? addslashes($item->address) : 'Alamat tidak tersedia';
                    $kelurahan = isset($item->kelurahan) ? addslashes($item->kelurahan) : '-';
                    $kecamatan = isset($item->kecamatan) ? addslashes($item->kecamatan) : '-';
                    
                    // Gunakan jenis_nama dari tabel jenis_map
                    $dataType = isset($item->jenis_nama) ? addslashes($item->jenis_nama) : 'Data';
                    $colorIdx = isset($typeColorMap[$item->jenis_nama]) ? $typeColorMap[$item->jenis_nama] : 0;
                    
                    // Additional info based on available fields
                    $additionalInfo = '';
                    if (isset($item->jumlah_populasi) && $item->jumlah_populasi > 0) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Populasi:</strong> " . number_format($item->jumlah_populasi) . " ekor</p>";
                    }
                    if (isset($item->produksi) && $item->produksi > 0) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Produksi:</strong> " . number_format($item->produksi) . "</p>";
                    }
                    if (isset($item->kapasitas) && !empty($item->kapasitas)) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Kapasitas:</strong> " . addslashes($item->kapasitas) . "</p>";
                    }
                    if (isset($item->jumlah_anggota) && $item->jumlah_anggota > 0) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Anggota:</strong> " . number_format($item->jumlah_anggota) . " orang</p>";
                    }
                    if (isset($item->nama_ketua) && !empty($item->nama_ketua)) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Ketua:</strong> " . addslashes($item->nama_ketua) . "</p>";
                    }
                    if (isset($item->nama_pemilik) && !empty($item->nama_pemilik)) {
                        $additionalInfo .= "<p style='margin: 5px 0;'><strong>Pemilik:</strong> " . addslashes($item->nama_pemilik) . "</p>";
                    }
                    
                    $script .= "
                    try {
                        var circleMarker = L.circleMarker([{$item->latitude}, {$item->longitude}], {
                            radius: 8,
                            fillColor: getMarkerColor($colorIdx),
                            color: '#000',
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        }).addTo(map);
                        
                        var headerColor = getMarkerColor($colorIdx);
                        circleMarker.bindPopup(`
                            <div style='min-width: 220px;'>
                                <div style='background: \${headerColor}; color: white; padding: 5px; margin: -5px -5px 10px -5px; border-radius: 3px; text-align: center;'>
                                    <strong>$dataType</strong>
                                </div>
                                <h6 style='color: #333; margin-bottom: 10px;'>{$popupContent}</h6>
                                <p style='margin: 5px 0;'><strong>Alamat:</strong> {$address}</p>
                                <p style='margin: 5px 0;'><strong>Kelurahan:</strong> {$kelurahan}</p>
                                <p style='margin: 5px 0;'><strong>Kecamatan:</strong> {$kecamatan}</p>
                                $additionalInfo
                            </div>
                        `);
                        
                        markers.push(circleMarker);
                        console.log('Added $dataType marker at: {$item->latitude}, {$item->longitude}');
                    } catch(e) {
                        console.error('Error adding marker:', e);
                    }
                    ";
                }
            }
        } else {
            $script .= "
            console.log('No map data available for $mapId');
            L.popup()
                .setLatLng([$centerLat, $centerLng])
                .setContent('<div><h6>Info</h6><p>Tidak ada data lokasi tersedia</p></div>')
                .openOn(map);
            ";
        }
        
        $script .= "
            console.log('Total markers added to $mapId:', markers.length);
            
            // Fit map to markers bounds if markers exist (auto zoom)
            if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            }
            
            // Add Legend Control
            var legend = L.control({position: 'bottomright'});
            
            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'info legend');
                div.style.background = 'white';
                div.style.padding = '10px';
                div.style.border = '2px solid #ccc';
                div.style.borderRadius = '5px';
                div.style.fontSize = '12px';
                div.style.lineHeight = '18px';
                div.style.maxWidth = '200px';
                div.style.boxShadow = '0 0 15px rgba(0,0,0,0.2)';
                
                var legendContent = '<h6 style=\"margin: 0 0 10px 0; font-weight: bold; color: #333;\">Legenda</h6>';
                
                // Add legend items for each data type
                Object.keys(dataTypeColors).forEach(function(dataType) {
                    var colorIndex = dataTypeColors[dataType];
                    var color = getMarkerColor(colorIndex);
                    legendContent += '<div style=\"margin: 5px 0; display: flex; align-items: center;\">' +
                        '<span style=\"display: inline-block; width: 15px; height: 15px; background-color: ' + color + 
                        '; border: 1px solid #000; border-radius: 50%; margin-right: 8px; flex-shrink: 0;\"></span>' +
                        '<span style=\"font-size: 11px;\">' + dataType + '</span>' +
                        '</div>';
                });
                
                if (Object.keys(dataTypeColors).length === 0) {
                    legendContent += '<p style=\"margin: 0; color: #666; font-style: italic;\">Tidak ada data</p>';
                }
                
                div.innerHTML = legendContent;
                return div;
            };
            
            legend.addTo(map);
            
            console.log('Legend added to $mapId with', Object.keys(dataTypeColors).length, 'data types');
        });
        </script>
        ";
        
        return $script;
    }
}

// Helper function untuk menambahkan jenis data ke map data sebelum passing ke map
if (!function_exists('addDataTypeToMapData')) {
    function addDataTypeToMapData($mapData, $dataType) {
        return $mapData->map(function($item) use ($dataType) {
            $item->table_type = $dataType;
            return $item;
        });
    }
}
if (!function_exists('generateChartScript')) {
    function generateChartScript($chartData, $chartId, $chartType = 'bar', $title = '', $maxHeight = 400)
    {
        $labels = json_encode($chartData->pluck(array_keys((array) $chartData->first())[0])->toArray());
        $data = json_encode($chartData->pluck('jumlah')->toArray());
        
        $script = "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('$chartId').getContext('2d');
            var chart = new Chart(ctx, {
                type: '$chartType',
                data: {
                    labels: $labels,
                    datasets: [{
                        label: 'Jumlah',
                        data: $data,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 205, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: " . (!empty($title) ? 'true' : 'false') . ",
                            text: '$title'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            
            // Set max height for canvas
            var canvas = document.getElementById('$chartId');
            if (canvas) {
                canvas.style.maxHeight = '{$maxHeight}px';
                canvas.parentElement.style.height = '{$maxHeight}px';
            }
        });
        </script>
        ";
        
        return $script;
    }
}
