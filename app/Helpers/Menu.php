
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => "Home", 
			'icon' => '<i class="icon  dripicons-home"></i>'
		],
		
		[
			'path' => 'web/perikanan',
			'label' => "Dashboard", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'web/peternakan',
			'label' => "Dashboard", 
			'icon' => '<i class="icon  dripicons-graph-bar"></i>'
		],
		
		[
			'path' => 'web/pertanian',
			'label' => "Dashboard", 
			'icon' => '<i class="icon  dripicons-graph-bar"></i>'
		],
		
		[
			'path' => 'web/ketahananpangan',
			'label' => "Dashboard", 
			'icon' => '<i class="icon  dripicons-graph-bar"></i>'
		],
		
		[
			'path' => 'periodeevaluasi',
			'label' => "Evaluasi", 
			'icon' => '<i class="icon  dripicons-checklist"></i>','submenu' => [
		[
			'path' => 'masteradata',
			'label' => "Master Adata", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'evaluasiadata',
			'label' => "Evaluasi Adata", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'periodeevaluasi',
			'label' => "Periode Evaluasi", 
			'icon' => '<i class="icon  dripicons-alarm"></i>'
		],
		
		[
			'path' => 'indikatormaster',
			'label' => "Indikator Master", 
			'icon' => '<i class="icon  dripicons-archive"></i>'
		]
	]
		],
		
		[
			'path' => 'aauth_users',
			'label' => "User", 
			'icon' => '<i class="icon  dripicons-user-group"></i>','submenu' => [
		[
			'path' => 'aauth_users',
			'label' => "Data User", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'permissions',
			'label' => "Permissions", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'roles',
			'label' => "Roles", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'blog',
			'label' => "Konten", 
			'icon' => '<i class="icon  dripicons-article"></i>','submenu' => [
		[
			'path' => 'agenda',
			'label' => "Agenda", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'blog',
			'label' => "Blog", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'blog_category',
			'label' => "Blog Category", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'page',
			'label' => "Page", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'slider',
			'label' => "Slider", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'gudang_telur',
			'label' => "Bidang Peternakan", 
			'icon' => '<i class="icon  dripicons-bell"></i>','submenu' => [
		[
			'path' => 'peternak',
			'label' => "Peternak", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'poultry',
			'label' => "Poultry", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'kios_daging',
			'label' => "Kios Daging", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'pelaku_usaha_peternakan',
			'label' => "Pengusaha Ternak", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'gudang_telur',
			'label' => "Gudang Telur", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'harga_ternak',
			'label' => "Harga Ternak", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'profil',
			'label' => "Profil", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'jenis_profil',
			'label' => "Jenis Profil", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'data_vaksinasi',
			'label' => "Data Vaksinasi", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'penyakit',
			'label' => "Penyakit", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'petugas_vaksin',
			'label' => "Petugas Vaksin", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'penjual_ayam_potong',
			'label' => "Penjual Ayam", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'kel_tani',
			'label' => "Bidang Pertanian", 
			'icon' => '<i class="icon  dripicons-brightness-max"></i>','submenu' => [
		[
			'path' => 'kios_pupuk',
			'label' => "Kios Pupuk", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'pelaku_usaha_tani',
			'label' => "Pengusaha Tani", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'pupo',
			'label' => "Pupo", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'toko_tani',
			'label' => "Toko Tani", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'p4s',
			'label' => "P4s", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'kel_tani',
			'label' => "Kel Tani", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'komoditas',
			'label' => "Ketahanan Pangan", 
			'icon' => '<i class="icon  dripicons-basket"></i>','submenu' => [
		[
			'path' => 'inputharga',
			'label' => "Input Harga", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'komoditas',
			'label' => "Master Komoditas", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'tpi',
			'label' => "Bidang Perikanan", 
			'icon' => '<i class="icon  dripicons-disc"></i>','submenu' => [
		[
			'path' => 'bbi',
			'label' => "Bbi", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'jenis_ikan',
			'label' => "Jenis Ikan", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'kelompok_ikan',
			'label' => "Kelompok Ikan", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'kelompok_ikan_hias',
			'label' => "Kelompok Ikan Hias", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'kelompok_pemasar_ikan',
			'label' => "Kelompok Pemasar Ikan", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'tpi',
			'label' => "Tpi", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'konsul',
			'label' => "Layanan", 
			'icon' => '<i class="icon  dripicons-browser-upload"></i>','submenu' => [
		[
			'path' => 'konsul',
			'label' => "Konsul", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'konsultasi',
			'label' => "Konsultasi", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'konsultasi_jawaban',
			'label' => "Konsultasi Jawaban", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'jenis_surat',
			'label' => "Jenis Surat", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'permohonan_surat',
			'label' => "Permohonan Surat", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'status_surat',
			'label' => "Status Surat", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'master_bidang',
			'label' => "Data Master ", 
			'icon' => '<i class="icon  dripicons-archive"></i>','submenu' => [
		[
			'path' => 'wilayah',
			'label' => "Wilayah", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'jenis_map',
			'label' => "Jenis Map", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'permissions',
			'label' => "Permissions", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'roles',
			'label' => "Roles", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'profile',
			'label' => "Profile", 
			'icon' => '<i class="icon dripicons-help"></i>'
		],
		
		[
			'path' => 'status',
			'label' => "Status", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	]
		],
		
		[
			'path' => 'periodeevaluasi/evaluasi',
			'label' => "Evaluasi Kinerja", 
			'icon' => '<i class="icon  dripicons-battery-full"></i>'
		],
		
		[
			'path' => 'indikatormaster/laporan',
			'label' => "Laporan Sakip", 
			'icon' => '<i class="icon  dripicons-hourglass"></i>'
		],
		
		[
			'path' => 'masteradata/laporan',
			'label' => "Laporan Adata", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	] ;
	}
	
	public static function navbartopleft(){
		return [
		[
			'path' => '/',
			'label' => "Beranda", 
			'icon' => '<i class="icon  dripicons-web"></i>'
		],
		
		[
			'path' => 'web/pertanian',
			'label' => "Pertanian", 
			'icon' => '<i class="icon  dripicons-brightness-max"></i>'
		],
		
		[
			'path' => 'web/peternakan',
			'label' => "Peternakan", 
			'icon' => '<i class="icon  dripicons-basket"></i>'
		],
		
		[
			'path' => 'web/perikanan',
			'label' => "Perikanan", 
			'icon' => '<i class="icon  dripicons-flag"></i>'
		],
		
		[
			'path' => 'web/ketahananpangan',
			'label' => "Ketahanan Pangan", 
			'icon' => '<i class="icon  dripicons-cutlery"></i>'
		],
		
		[
			'path' => 'blog/list_front',
			'label' => "Artikel", 
			'icon' => '<i class="icon  dripicons-document"></i>'
		],
		
		[
			'path' => 'inputharga',
			'label' => "Input Harga", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	] ;
	}
	
	public static function navbartopright(){
		return [
		[
			'path' => 'inputharga',
			'label' => "Input Harga", 
			'icon' => '<i class="icon dripicons-help"></i>'
		]
	] ;
	}
	
		
	public static function status(){
		return [
		[
			'value' => 'yes', 
			'label' => "yes", 
		],
		[
			'value' => 'no', 
			'label' => "no", 
		],] ;
	}
	
	public static function bidang(){
		return [
		[
			'value' => 'SEKRETARIAT', 
			'label' => "SEKRETARIAT", 
		],
		[
			'value' => 'KP_IKAN', 
			'label' => "KP_IKAN", 
		],
		[
			'value' => 'PETERNAKAN', 
			'label' => "PETERNAKAN", 
		],
		[
			'value' => 'TPHP', 
			'label' => "TPHP", 
		],] ;
	}
	
	public static function statusPeriode(){
		return [
		[
			'value' => 'draft', 
			'label' => "draft", 
		],
		[
			'value' => 'active', 
			'label' => "active", 
		],
		[
			'value' => 'closed', 
			'label' => "closed", 
		],] ;
	}
	
	}
