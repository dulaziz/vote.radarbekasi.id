<?php

namespace App\Http\Livewire;

use App\Models\VoteItem;
use App\Models\VoteProfile;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreProfileItems extends Component
{
    // Rules Input
    public $icon_profile;
    public $title_profile;
    public $desc_profile;
    public $gallery=[];

    public $data_id;
    public $data_vote_unit_id;
    public $data_image;
    public $data_item;

    use WithFileUploads;

    protected $listeners = ['profileAdded' => 'render'];

    protected $rules = [
           'icon_profile' => 'required|image|max:1024',
           'title_profile' => 'required',
           'desc_profile' => 'required',
           'gallery.*' => 'required|image|max:1024',
           ];

    private function resetInput(){
        $this->icon_profile = null;
        $this->title_profile = null;
        $this->desc_profile = null;
        $this->gallery = null;
    }


    public function mount($data_item){
        $this->data_id = $data_item->id;
        $this->data_vote_unit_id = $data_item->vote_unit_id;
        $this->data_image = $data_item->vote_image;

    }

    public function storeProfile(){

        $this->validate();

        $this->icon_profile = $this->icon_profile->store('icon-items');

        foreach ($this->gallery as $key => $photo) {

            $this->gallery[$key] = $photo->store('gallery-items');

        }

        $this->gallery = json_encode($this->gallery);

        VoteProfile::create([
            'vote_item_id' => $this->data_id,
            'icon' => $this->icon_profile,
            'title' => $this->title_profile,
            'description' => $this->desc_profile,
            'gallery' => $this->gallery,
        ]);



        $this->resetInput();

        $this->emit('profileAdded');

        return redirect(request()->header('Referer'))->with('success', 'Images has been successfully Uploaded.');
    }


    public function render()
    {
        $data_profile = VoteProfile::where('vote_item_id',$this->data_id)->get();
        return view('livewire.store-profile-items',[
            'data_profile' => $data_profile
        ]);
    }

}
