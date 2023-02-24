<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CnpjExample extends Component
{
    public string $cnpj = '';
    public function render()
    {
        return view('livewire.cnpj-example');
    }
}
