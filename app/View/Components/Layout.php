<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Layout extends Component
{
    public $userName, $pageName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userName = Auth::user()['name'];
        $this->pageName = Str::ucfirst(Route::current()->getName());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }
}
