<?php

namespace App\Http\Livewire;

use App\Models\VoteItem;
use App\Models\VoteProfile;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreItems extends Component
{

    public $vote_unit_id;
    public $vote_items;
    public $vote_unit;

    public $id_item;
    public $vote_image;
    public $vote_name;
    public $vote_position;
    public $short_desc;

    use WithFileUploads;

    protected $listeners = ['itemAdded' => 'render'];


    protected $rules = [
        'vote_image' => 'required|image|max:1024',
        'vote_name' => 'required',
        'vote_position' => 'required',
        'short_desc' => 'required',

    ];



    private function resetInput(){
        $this->vote_image = null;
        $this->vote_name = null;
        $this->vote_position = null;
        $this->short_desc = null;
    }


    public function mount($id_unit){

          $this->vote_unit_id = $id_unit;

    }


    public function storeItems(){

        // dd($this->validate());

        VoteItem::create([
            'vote_unit_id' => $this->vote_unit_id,
            'vote_image' => $this->vote_image->store('vote-items'),
            'vote_name' => $this->vote_name,
            'vote_position' => $this->vote_position,
            'short_desc' => $this->short_desc,
        ]);


        $this->resetInput();

        $this->emit('itemAdded');

        return redirect(request()->header('Referer'))->with('success', 'Your data has been created!');

    }


    // Edit Item
    public function editItem($id){

    }


    // Delete Item
    public function deleteItem($id){

        VoteItem::where('id',$id)->delete();
        VoteProfile::where('vote_item_id',$id)->delete();


        return redirect(request()->header('Referer'))->with('success', 'Your data has been deleted!');

    }


    public function render()
    {
        // $data = DB::table('vote_items')->where('vote_unit_id',$this->vote_unit_id)->with(['profile'])->get();

        $data = VoteItem::with('voteProfile')->where('vote_unit_id', $this->vote_unit_id)->get();

        // dd($data);

        return view('livewire.store-items',[
            'data_items' => $data,
            'data_unit' => $this->vote_unit,
        ]);
    }
}
