<?php

declare(strict_types=1);

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Admin extends Component
{
    public function __construct(
        public ?string $title = null
    ) {}

    public function render(): View
    {
        return view('admin.layouts.admin');
    }
}
