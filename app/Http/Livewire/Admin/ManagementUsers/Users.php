<?php

namespace App\Http\Livewire\Admin\ManagementUsers;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Users extends Component
{

    public $data_user, $data_role, $userId;
    public $formCreateUser;

    public $name, $email, $password, $confirm_password, $role;


    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        $this->data_user = User::orderBy('created_at', 'DESC')->get();
        $this->data_role = Role::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.management-users.users')->extends('layouts.app')->section('content');
    }


    public function openFormCreateUser()
    {
        $this->formCreateUser = true;
    }
    public function closeFormCreateUser()
    {
        $this->formCreateUser = false;
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => bcrypt($this->password)
            ]);
            $user->assignRole($this->role);

            $this->alert('success', 'Succesfully create new user', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->formCreateUser = false;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $this->triggerConfirm();
        $this->userId = $user->id;
    }


    public function triggerConfirm()
    {
        $this->confirm('Are you sure you want to delete this data?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function confirmed()
    {

        User::findOrFail($this->userId)->delete();

        $this->alert('success', 'Succesfully delete user', [
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
