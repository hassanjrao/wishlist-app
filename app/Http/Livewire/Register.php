<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{

    use WithFileUploads;

    public $step = 1;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $income;
    public $income_certificate;

    public $childrens=[];


    public function nextStep()
    {

        if($this->step == 1){
            // $this->validate([
            //     'name' => 'required|string|min:6',
            //     'email' => 'required|email|unique:users',
            //     'password' => 'required|min:6',
            //     'password_confirmation' => 'required|same:password',
            //     'income' => 'required|numeric|min:0',
            //     'income_certificate' => 'required|file',
            // ]);

        }


        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function render()
    {
        return view('livewire.register');
    }
}
