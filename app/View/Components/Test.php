<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Test extends Component
{

    
   
    /**
     * Create a new component instance.
     *
     * @return void
     */
   
      /**
     * The alert message.
     *
     * @var string
     */


    public $test;

    public function __construct($apple)
    {
        //

       
        $this->test =$apple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.test');
    }
}
