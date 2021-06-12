<?php

namespace App\Http\Livewire\Admin\ManagementUsers;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{

    public $name_role, $dataRole;



    public function render()
    {
        $this->dataRole = Role::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.management-users.roles')->extends('layouts.app')->section('content');
    }

    public function saveRole()
    {
        $this->validate([
            'name_role' => 'required|unique:roles,name'
        ]);


        try {

            Role::create([
                'name' => $this->name_role,
                'guard_name' => 'web'
            ]);

            $this->alert('success', 'Succesfully create new role!', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
          ]);


        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        $this->alert('success', 'Succesfully delete role', [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
      ]);

    }



}
