<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateProxy extends Component
{
    public $account;
    public $name;
    public $phone;
    public $password;
    public $r_number;
    public function createProxy(){
        
    }
    public function render()
    {
        Log::info("dsf");
        return view('livewire.create-proxy')->layout('layouts.base');
    }
}
