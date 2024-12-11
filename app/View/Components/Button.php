<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function view;

class Button extends Component
{

	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $type = 'button',
		public ?string $leftIcon = null,
		public ?string $rightIcon = null,
	)
	{
		//
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render() : View|Closure|string
	{
		return view('components.button');
	}
}
