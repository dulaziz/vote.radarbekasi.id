<?php

namespace App\Http\Livewire;

use App\Models\VoteProfile;
use Livewire\Component;

class StoreGallery extends Component
{
    public $data_item;
    public $gallery=[];
    public $i;
    public $data;

    public function mount($data_item){

       $this->gallery[] = $data_item->voteProfile;

    }

    public function confirmDelete($data)
    {
        // dd($data);
        $data_gallery = VoteProfile::where('vote_item_id',11)->first();

        $data_arr = $data_gallery->gallery;

        $data_arr_decode = json_decode($data_gallery->gallery);

        $total_data_array = count($data_arr_decode);

        $result = array_splice($data_arr_decode,$data,$total_data_array,'test');

        dd($result);
        // $output = array_search($data, json_decode($this->gallery[0]->gallery));
        // dd($output);
    }

    public function kill()
    {
        // dd($g);
        // Country::destroy($id);
    }

    public function render()
    {
        // dd(json_decode($this->gallery[0]->gallery));
        return view('livewire.store-gallery');
    }
}
