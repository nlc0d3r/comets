<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserCard extends Component
{

    public $USER;
    public $TYPE;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct( $uid, $type )
    {
        $this->USER = app('App\Helper\Core')->userCard( $uid );
        $this->TYPE = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view( 'components.user-card' )
            ->with( 'USER', $this->USER )
            ->with( 'TYPE', $this->TYPE );
    }
}
