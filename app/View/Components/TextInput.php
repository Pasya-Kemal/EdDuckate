<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function preg_replace;
use function str_replace;
use function ucwords;
use function view;

class TextInput extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $name = '',
		public ?string $placeholder = null,
		public string $value = '',
		public string $type = 'text',
		public bool $withError = false,
	)
	{
		if($this->placeholder === null) {
			$this->placeholder = $this->nameToPlaceholder($this->name);
		}
		if($this->name === 'password') {
			$this->type = 'password';
		}
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render() : View|Closure|string
	{
		return view('components.text-input');
	}

	private function nameToPlaceholder(string $string) : string{
		// Replace underscores with spaces
		$string = str_replace('_', ' ', $string);

		// Replace capital letters with a space and the capital letter
		$string = preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);

		// Convert the string to title case
		return ucwords($string);
	}
}
