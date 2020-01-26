<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [[
		'icon' => 'fas fa-th-large',
		'title' => 'Dashboard',
		'url' => '/dashboard'
	],[
		'icon' => 'fas fa-info-circle',
		'title' => 'Bantuan Hukum',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/praperadilan',
			'title' => 'Pra Peradilan'
		],[
			'url' => '/pidana',
			'title' => 'Pidana'
		],[
			'url' => '/perdata',
			'title' => 'Perdata'
		],[
			'url' => '/agama',
			'title' => 'Agama'
		],[
			'url' => '/ptun',
			'title' => 'PTUN'
		]]
	],[
		'icon' => 'fas fa-comments',
		'title' => 'Konsultasi Hukum',
		'url' => '/konsultasihukum'
	],[
		'icon' => 'fas fa-gavel',
		'title' => 'Pendapat & Saran Hukum',
		'url' => '/pendapatsaranhukum'
	],[
		'icon' => 'fas fa-rss',
		'title' => 'Data Lensa Kegiatan',
		'url' => '/datalensakegiatan'
	],[
		'icon' => 'fas fa-file-pdf',
		'title' => 'Peraturan',
		'url' => 'javascript:;',
		'caret' => true,
		'sub_menu' => [[
			'url' => '/jenisperaturan',
			'title' => 'Jenis Peraturan'
		],[
			'url' => '/dataperaturan',
			'title' => 'Data Peraturan'
		]]
	],[
		'icon' => 'fas fa-users',
		'title' => 'Pengguna',
		'url' => '/pengguna'
	]]
];
