<?php

namespace App\Http\Livewire;

use App\Models\Tourbase;
use Livewire\Component;

class SearchTourbases extends Component
{
    public $search;
    protected $queryString = ['search'];
    public function render()
    {
        $tourbases = [];
        if($this->search){
            $result = Tourbase::search($this->search)->get();
        }else{
            $result = 'nothingall';

        }
        if($result == '[]'){
            $result = 'nothing';
        }
        return view('livewire.search-tourbases',compact('result'));
    }
}
