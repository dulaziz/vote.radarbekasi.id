<?php

namespace App\Http\Livewire;

use App\Models\VoteItem;
use App\Models\VoteProfile;
use Livewire\Component;

class EditProfileItems extends Component
{
    public $title = 'Edit More Profile';
    public $data_item;
    public $data_id;

    public $more_item_title;

    public function mount($id){
        // dd($id);
        $this->data_id = $id;
        $this->data_item = VoteItem::with(['voteProfile'])->find($id);
    }

    public function render()

    {
        $data_profile = VoteProfile::where('vote_item_id',$this->data_id)->get();
        // dd($this->data_item);
        return view('livewire.edit-profile-items',[
            'data_profile' => $data_profile
        ])
        ->extends('layouts.main')
        ->layoutData(['title' => 'Edit More Profile']);
    }
}
