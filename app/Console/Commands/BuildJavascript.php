<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use JShrink\Minifier;
use function base_path;
use function count;
use function in_array;
use function round;
use function strlen;
use const PHP_EOL;

class BuildJavascript extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'build:javascript';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Build javascript files';

	/**
	 * Execute the console command.
	 * @throws \Exception
	 */
	public function handle()
	{
		$minifiedJS = '';

		$totalUnminifiedLength = 0;
		$totalMinifiedLength = 0;
		$info = [];
		foreach(File::allFiles(base_path('resources/js/')) as $js) {
			if($js->getExtension() !== 'js') {
				continue;
			}
			if(in_array($relativePath = $js->getRelativePathname(), ['app.js', 'bootstrap.js'], true)) {
				$this->warn('Skipping ' . $relativePath . '...');
				continue;
			}
			$this->line('Compiling ' . $relativePath . '...');
			$content = $js->getContents();
			$contentLen = strlen($content);
			$minified = Minifier::minify($content);
			$minifiedLen = strlen($minified);
			$info[$relativePath] = [$contentLen, $minifiedLen];
			$minifiedJS .= $minified . PHP_EOL;

			$totalUnminifiedLength += $contentLen;
			$totalMinifiedLength += $minifiedLen;
		}

		foreach($info as $jsFile => [$before, $after]) {
			$this->info('Compiled from ' . $jsFile . ' : ' . $this->readableBytes($before) . ' -> ' . $this->readableBytes($after));
		}

		$this->info('Total : ' . $this->readableBytes($totalUnminifiedLength) . ' -> ' . $this->readableBytes($totalMinifiedLength));
		$savedBytes = $totalUnminifiedLength - $totalMinifiedLength;
		$this->info('Saved bytes : ' . $this->readableBytes($savedBytes) . ' (' . round(($savedBytes / $totalUnminifiedLength) * 100, 1) . '%)');

		File::put(base_path('public/js/edduckate.js'), $minifiedJS);
	}

	private function readableBytes(int $bytes) : string{
		$units = ['B', 'KB', 'MB', 'GB', 'TB'];

		for ($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++) {
			$bytes /= 1024;
		}

		return round($bytes, 2) . ' ' . $units[$i];
	}
}
