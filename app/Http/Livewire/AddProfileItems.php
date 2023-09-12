<?php

namespace App\Http\Livewire;

use App\Models\VoteItem;
use Livewire\Component;

class AddProfileItems extends Component
{
    public $title = 'Add More Profile';
    public $data_item;

    public $more_item_title;

    public function mount($id){
        $this->data_item = VoteItem::find($id);
    }

    public function render()
    {
        return view('livewire.add-profile-items')
        ->extends('layouts.main')
        ->layoutData(['title' => 'More Profile']);
    }
}
