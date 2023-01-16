<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListPost extends Component
{
    public $posts;
    
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-post');
    }
}
