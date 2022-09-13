<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

use Symfony\Component\Intl\Countries;

class CountrySelect extends Component
{

    /**
     * The alert message.
     *
     * @var string
     */
    
    public $countries;

    public $selected;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($selected)
    {
        //
        $this->selected=$selected;
        $this->countries= Countries::getNames(App::currentLocale());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.country-select');
    }
}