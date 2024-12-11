<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function view;

class Checkbox extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $name,
		public string $value = '0',
	)
	{
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render() : View|Closure|string
	{
		return view('components.checkbox');
	}
}
