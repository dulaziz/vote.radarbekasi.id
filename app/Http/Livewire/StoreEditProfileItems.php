<?php

namespace App\Http\Livewire;

use App\Models\VoteItem;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreEditProfileItems extends Component
{
    public $data_item;
    public $data_profile;

    public $data_id;
    public $vote_unit_id;
    public $vote_image;
    public $vote_image_old;
    public $vote_name;
    public $vote_position;
    public $short_desc;

    // Property Input
    public $vote_image_input_old;
    public $vote_name_input_old;
    public $vote_position_input_old;
    public $short_desc_input_old;


    use WithFileUploads;

    protected $listeners = ['itemUpdated' => 'render'];

    private function resetInput(){
        $this->vote_image = null;
        $this->vote_name = null;
        $this->vote_position = null;
        $this->short_desc = null;
    }


    public function mount($data_item){

        $this->vote_unit_id = $data_item->vote_unit_id;
        $this->vote_image_input_old = $data_item->vote_image;
        $this->vote_name = $data_item->vote_name;
        $this->vote_position = $data_item->vote_position;
        $this->short_desc = $data_item->short_desc;

        $this->data_id = $this->data_item->id;

    }


    public function update(){

        // $this->validate();

        if($this->vote_image){
           $data_image =  $this->vote_image->store('vote-items');
        }

        if(!$this->vote_image){
            $data_image = $this->vote_image_input_old;
        }

        if($this->vote_name){
            $this->vote_name;
        }else{
            $this->vote_name = $this->vote_name_input_old;
        }
        if($this->vote_position){
            $this->vote_position = $this->vote_position;
        }else{
            $this->vote_position = $this->vote_position_input_old;
        }
        if($this->short_desc){
            $this->short_desc;
        }else{
            $this->short_desc = $this->short_desc_input_old;
        }

        VoteItem::where('id',$this->data_id)->update([
            'vote_image' => $data_image,
            'vote_name' => $this->vote_name,
            'vote_position' => $this->vote_position,
            'short_desc' => $this->short_desc,
        ]);

        $this->resetInput();

        $this->emit('itemUpdated');

        return redirect(request()->header('Referer'))->with('success', 'Your data has been updated!');


    }

    public function render()
    {
        // dd($this->vote_image);
        return view('livewire.store-edit-profile-items',['data_item' => $this->data_item]);
    }
}
