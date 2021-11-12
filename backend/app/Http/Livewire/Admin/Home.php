<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public function render()
    {
        return view('livewire.admin.home')->extends('layouts.app')->section('content');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
