<?php

namespace App\Http\Livewire\Admin\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        Auth::logout();
        redirect()->route('login');
        return view('livewire.admin.components.header');
    }


}
