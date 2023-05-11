<?php

namespace App\View\Components\Index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $title,$is_add,$is_delete,$add_permission,$delete_permission;

    public function __construct($title='Geetcom',$is_add=0,$is_delete=0,$add_permission=0,$delete_permission=0)
    {
        $title = $this->title ;
        $add_permission = $this->add_permission ;
        $delete_permission = $this->delete_permission ;
        $is_add = $this->is_add ;
        $is_delete = $this->is_delete ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index.card-header');
    }
}
