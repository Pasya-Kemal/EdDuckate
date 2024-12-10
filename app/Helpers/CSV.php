<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Path;
use function fclose;
use function file_get_contents;
use function fopen;
use function fputcsv;
use function sys_get_temp_dir;
use function unlink;

class CSV{

	public static function create(array $data) : string{
		$path = Path::join(sys_get_temp_dir(), Str::random(32)) . '.csv';
		$f = fopen($path, 'w');
		foreach($data as $x) {
			fputcsv($f, $x);
		}
		@fclose($f);
		$ret = file_get_contents($path);
		@unlink($path);
		return $ret;
	}
}
