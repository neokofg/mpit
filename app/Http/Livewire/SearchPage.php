<?php

namespace App\Http\Livewire;

use App\Models\Tourbase;
use Livewire\Component;

class SearchPage extends Component
{

    public $searchInput = '';
    public $selectedClassifications = [];

    public function updateSearch($classification = null)
    {
        if ($classification) {
            if (($key = array_search($classification, $this->selectedClassifications)) !== false) {
                unset($this->selectedClassifications[$key]);
            } else {
                $this->selectedClassifications[] = $classification;
            }
        }
    }
    public function render()
    {
        $tourbases = Tourbase::query();

        if ($this->searchInput) {
            $tourbases->search($this->searchInput);
        }

        if (!empty($this->selectedClassifications)) {
            foreach ($this->selectedClassifications as $classification) {
                $classification = ',' . $classification . ','; // Добавляем запятые в начале и конце для точного сопоставления
                $tourbases->whereRaw("strpos(',' || classification || ',', ?) > 0", [$classification]);
            }
        }

        if ($this->searchInput || !empty($this->selectedClassifications)) {
            $result = $tourbases->get();

            if ($result->isEmpty()) {
                $result = 'nothing';
            }
        } else {
            $result = 'nothing';
        }

        return view('livewire.search-page', [
            'result' => $result,
            'tourbases' => $tourbases->paginate(10),
        ]);
    }

}
