<?php

namespace App\Http\Controllers;

use App\Models\VoteItem;
use App\Models\VoteProfile;
use App\Models\VoteUnit;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class pollingController extends Controller
{
    //

    public function index(){

        $data_pollings = VoteUnit::with('votings')
            ->orderBy('id', 'DESC')
            ->get();


        return view('home', [
            "title" => "Home",
            "data_polling" => $data_pollings,
        ]);

    }



    public function create(){

        // Ambil semua data vote unit dan validasi jumlah data vote unit
        $query_vote_unit = VoteUnit::all();

        if(count($query_vote_unit)){

            $vote_unit_id_latest = DB::table('vote_units')
                            ->select('id')
                            ->latest()->first();

            $data = $vote_unit_id_latest->id;

        }else{

            $vote_unit_id_latest = [
               'id'=> 0,
            ];

            $data = $vote_unit_id_latest['id'];
        }


        return view('addPolling', [
            "title" => "Add Polling Unit",
            'vote_unit_id_latest' => $data
        ]);
    }


    public function create_unit(Request $request){

        // dd($request->all());

        // Buat rule validasi form input unit
        $validated = $request->validate([
            'thumbnail' => 'required|image|file',
            'title' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'subtitle' => 'required',
            // Rule validasi form items
            // 'vote_unit_id' => 'required',
            // 'vote_image' => 'required|mimes:jpg,bmp,png',
            // 'vote_name' => 'required',
            // 'short_desc' => 'required',
        ]);

        // dd($validated);

        // Cek jika ada gambar yang di inputkan dan simpan kedalam folder storage
        if($request->hasfile('thumbnail')){
            $validated['thumbnail'] = $request->file('thumbnail')->store('unit-items');
        }

        // Cek jika ada gambar yang di inputkan dan simpan kedalam folder storage
        if($request->hasfile('vote_image')){
            $validated['vote_image'] = $request->file('vote_image')->store('vote-items');
        }


        // Ubah date normal time ke date epoch
        $epoch_start = $request->date_start;
        $dt = new DateTime("$epoch_start");  // convert UNIX timestamp to PHP DateTime
        $date_start = $dt->format('U');

        $epoch_end = $request->date_end;
         $dt = new DateTime("$epoch_end");  // convert UNIX timestamp to PHP DateTime
         $date_end = $dt->format('U');


        // Validate form vote unit
         $validated['description'] = $request->description;
         $validated['date_start'] = $date_start;
         $validated['date_end'] = $date_end;



        // Validate form vote unit
        $validated['vote_unit_id'] = $request->vote_unit_id + 1;

        // VoteItem::create($validated);

        $save = VoteUnit::create($validated);

        if($save){

            return redirect('admin')->with('success', 'Your data has been created!');

        }else{

            return back()->with('error', 'Your data failed created!')->withInput();
        }


    }


    public function create_items(Request $request){

        // dd($request->all());

        $validated = $request->validate([
            'vote_unit_id' => 'required',
            'vote_image' => 'required|mimes:jpg,bmp,png',
            'vote_name' => 'required',
            'vote_position' => 'required',
            'short_desc' => 'required',
        ]);

         // Cek jika ada gambar yang di inputkan dan simpan kedalam folder storage
        if($request->hasfile('vote_image')){
            $validated['vote-image'] = $request->file('vote_image')->store('vote-items');
        }

        $save = VoteItem::create($validated);

        if($save){

            return redirect('admin')->with('success', 'Your data has been created!');

        }else{

            return back()->with('error', 'Your data failed created!')->withInput();
        }

    }


    public function show_profile($id){

        $data_item = VoteItem::with('voteProfiles')->where('vote_unit_id', $id)->first();

        // Fitur tambah element array di akhir.
        // $data_array = json_decode($data_item->voteProfiles[0]->gallery);
        // $data_gambar_baru = "gallery-items\/m6LS4xMuUl89qF8RHkNeua7wUgNDBNCu9TRIw6JG.png";
        // Tambah element di akhir array
        // $debug = array_push($data_array,$data_gambar_baru);

        // cari element sesuai element dan ganti dengan element
        // $debug_search_filter = array_filter($data_array, fn($element) => $element = $data_gambar_baru);

        // cari element sesuai element
        // $debug_search = array_search($data_gambar_baru, $data_array);

        // rubah element array
        // $debug_replace = $data_array.seac($data_gambar_baru);
        // Akhir fitur


        // Looping data_array
        // foreach($data_array as $key => $value){
        //     echo "".$key." ".$value. "<br>";
        // }

        // die;

        // dd($data_item);
        // dd($data_array);
        // dd($data_gambar_baru);
        // dd($debug_search_filter);
        // dd($debug_search);
        // dd($debug_replace);

        return view('viewProfileItems', [
            "title" => "View Profile Items",
            // 'data_unit' => $data_unit,
            'data_item' => $data_item
        ]);

    }

    public function show_profile_item($id){
        // dd(decrypt($id));

        // $data_unit = VoteUnit::find($id);
        $data_item = VoteItem::with('voteProfiles')->where('id', decrypt($id))->first();
        // $data = with('voteProfile')->first();

        // dd($data_item);

        return view('profile', [
            "title" => "View Profile Items",
            // 'data_unit' => $data_unit,
            'data_item' => $data_item
        ]);

    }

    public function show_bar($id){

        $polling_unit = DB::table('vote_units')
                            ->where('id',decrypt($id))
                            ->first();

        $polling_item = DB::table('vote_items')
                            ->where('vote_unit_id',decrypt($id))
                            ->get();

        $total_votings = DB::table('votings')
                            ->where('vote_item_id',decrypt($id))
                            ->first();


        // $total_votings = Voting::with(['voteItem'])
        //                         ->where('vote_unit_id',$id->id)
        //                         ->get();

        //                         dd($total_votings);

        // $total_user_vote = DB::table('votings')->count('*');

        $total_user_vote = DB::table('votings')
                                ->where('vote_unit_id',decrypt($id))
                                ->count('*');

        // $total_vote = $total_votings->response / $total_user_vote * 100;

        // return view('viewPollUnit', [
             // "total_vote" => $total_vote
        // ]);

        return view('pollingUnitBar', [
            "title" => "Polling Unit Bar",
            "polling_unit_with_items" => $polling_unit,
            "polling_item" => $polling_item,
            "total_user_vote" => $total_user_vote,
        ]);

    }

    // Controller Fitur Polling Unit
    public function show_unit($id){

// dd(decrypt($id));

        // $polling_unit = DB::table('vote_units')
        //                     ->where('id',$id->id)
        //                     ->first();


        // $polling_item = VoteItem::with('votings')
        //                             ->where('vote_unit_id',$id->id)
        //                             ->get();

        //                             dd($polling_item);

        // $total_vote =  DB::table('votings')
        //                     ->select(DB::raw('count(*) as total_vote'))
        //                     ->first();


        $total_user_vote = DB::table('votings')
                                ->where('vote_unit_id',decrypt($id))
                                ->count('*');

        // $data_polling_unit = DB::select(
        //    'SELECT *
        //    FROM `vote_units`
        //    JOIN `votings`
        //    ON	`votings`.`vote_unit_id` = `vote_units`.`id`
        //    WHERE`votings`.`vote_unit_id` = '.$id->id.''
        // );

        // $data_polling_item = DB::select(
        //     'SELECT * FROM `vote_items` JOIN `votings` ON `votings`.`vote_unit_id` = `vote_items`.`vote_unit_id` WHERE `vote_items`.`vote_unit_id` ='.$id->id.' AND `votings`.`user_vote` = '. Auth::user()->id .''
        // );

        // dd($data_polling_item);

        // $data_polling_unit = DB::table('vote_units')
        //                     ->crossJoin('vote_items','vote_items.vote_unit_id','vote_units.id')
        //                     // ->crossJoin('votings','votings.vote_unit_id','vote_units.id')
        //                     // ->orderBy('','ASC')
        //                     ->get();


        // dd($data_polling_unit);


        // $data_votings = VoteUnit::with('votings')->where('user_vote', Auth::user()->id)->get();

        //                         dd($data_votings);



        $data_polling_unit_with_items = VoteUnit::with(['vote_items','votings'])->where('id',decrypt($id))->first();

        // dd($data_polling_unit_with_items);

        // dd($total_user_vote);

        $data_user_vote = Voting::where('user_vote', Auth::user()->id);

        // dd($data_user_vote);

        return view('pollingUnit', [
            "title" => "Polling Unit Bar",
            // "polling_unit" => $polling_unit,
            "polling_unit_with_items" => $data_polling_unit_with_items,
            "total_user_vote" => $total_user_vote,
            "data_user_vote" => $data_user_vote,

        ]);

    }

    public function polling_survey(VoteUnit $id){

        $polling_unit = DB::table('vote_units')
                        ->where('id',$id->id)
                        ->first();

        $polling_item = DB::table('vote_items')
                        ->where('vote_unit_id',$id->id)
                        ->get();

        $total_vote =  DB::table('votings')
                        ->select(DB::raw('count(*) as total_vote'))
                        ->where('vote_item_id', '=', 2)
                        ->first();

        $total_user_vote = DB::table('votings')->count('*');

        $user_vote = DB::table('votings')
                    ->select('user_vote')
                    ->get();

                // dd($total_user_vote);

        return view('pollSurvey', [
            "title" => "Poll Survey",
            "polling_unit" => $polling_unit,
            "polling_item" => $polling_item,
            "total_user_vote" => $total_user_vote,
            "total_vote" => $total_vote,
            "user_vote" => $user_vote,
        ]);
    }


    public function set_polling_survey(Request $request){

        // dd($request->all());

        $validatedData = $request->validate([
            'response' => 'required',
            'user_vote' => 'required',
            'vote_unit_id' => 'required',
            'vote_item_id' => 'required',
        ]);

         VoteItem::where('id', $validatedData['vote_item_id'])
                ->update(['response' => $validatedData['response']]);

         $save = Voting::create($validatedData);

        if($save){

            return back()->with('success', 'Your vote has been saved!');

        }else{

            return back()->with('error', 'Your vote failed saved!')->withInput();
        }



    }

    public function result(VoteUnit $vote_unit){

        // Ambil semua data total vote item yang vote unit id nya sesuai dengan vote unit id dan berelasi dengan tabel voting
        $total_votings = VoteItem::with(['votings'])
                                ->where('vote_unit_id',$vote_unit->id)
                                ->get();

                                // dd($total_votings);

        // Ambil data vote unit yang id nya sesuai dengan vote unit id
        $vote_unit = DB::table('vote_units')
                        ->where('id',$vote_unit->id)
                        ->first();

        // Hitung jumlah total user yang melakukan voting
        $total_user_vote = DB::table('votings')
                                ->where('vote_unit_id',$vote_unit->id)
                                ->count('*');

                            // dd($total_user_vote);

        // Hitung semua jumlah data yang ada di vote item yang vote unit id nya sama dengan id vote unit
        $total_vote_item = DB::table('vote_items')
                                ->where('vote_unit_id',$vote_unit->id)
                                ->count('*');

                                // dd($total_vote_item);

        return view('result', [
            "title" => "Polling Result",
            "total_votings" => $total_votings,
            "vote_unit" => $vote_unit,
            "total_user_vote" => $total_user_vote,
            "total_vote_item" => $total_vote_item
        ]);

    }

    public function get_polling_json(){

        $data_vote_unit_json = DB::table('vote_items')->get();

        return json_decode($data_vote_unit_json);

    }

    public function edit(VoteUnit $id){
        // $vote_unit_with_items = VoteUnit::with(['vote_items'])
        //                 ->where('id',$id->id)
        //                 ->first();

        // dd($id);

                        // dd($vote_unit_with_items);
        return view('editPolling', [
            "title" => "Edit Polling Unit",
            "vote_unit" => $id
        ]);

    }

    public function edit_items(VoteUnit $id){
        $vote_unit = VoteUnit::with(['vote_items'])
                        ->where('id',$id->id)
                        ->first();

                        // dd($vote_unit);
        // $vote_unit_id = $vote_unit->id;

        return view('addItems', [
            "title" => "Edit Polling Unit",
            "vote_unit" => $vote_unit,
            // "vo" => $vote_unit_id,
        ]);

    }

    public function update(Request $request){
        // dd($request->all());

        $validatedData = $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
        ]);


        // cek validasi jika ada thumbnail yang di kirim
        if($request->file('thumbnail')){
            // insert data thumbnail baru
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('unit-items');
            // hapus data thumbnail sebelumnya
            Storage::delete($request->thumbnail_old);
        }else{
            $validatedData['thumbnail'] = $request->thumbnail_old;
        }

        // cek validasi date start
        if($request->date_start){

               // Ubah date normal time ke date epoch
                $epoch_start = $request->date_start;
                $dt = new DateTime("$epoch_start");  // convert UNIX timestamp to PHP DateTime
                $date_start = $dt->format('U');


                // insert data date start baru
                $validatedData['date_start'] = $date_start;
        }else{

                // Ubah date normal time ke date epoch
                $epoch_start = $request->date_start_old;
                $dt = new DateTime("$epoch_start");  // convert UNIX timestamp to PHP DateTime
                $date_start_old = $dt->format('U');

            // insert data date start dengan data date start sebelumnya
            $validatedData['date_start'] = $date_start_old;
        }

        // cek validasi date start
        if($request->date_end){

                // Ubah date normal time ke date epoch
                $epoch_end = $request->date_end;
                $dt = new DateTime("$epoch_end");  // convert UNIX timestamp to PHP DateTime
                $date_end = $dt->format('U');

            // insert data date start baru
            $validatedData['date_end'] = $date_end;
        }else{

                // Ubah date normal time ke date epoch
                $epoch_end = $request->date_end_old;
                $dt = new DateTime("$epoch_end");  // convert UNIX timestamp to PHP DateTime
                $date_end_old = $dt->format('U');

            // insert data date start dengan data date start sebelumnya
            $validatedData['date_end'] = $date_end_old;
        }

        $validatedData['description'] = $request->description;

        // simpan validasi kedalam database vote unit
        $save = VoteUnit::where('id',$request->id)->update($validatedData);

        if($save){

            return back()->with('success', 'Your data has been created!');

        }else{

            return back()->with('error', 'Your data failed created!')->withInput();
        }

    }

    public function close_polling(Request $request){
         // Request Validate Id Item
         $validatedData = $request->validate([
            'id' => 'required',
            'date_end' => 'required',
        ]);

        // Ubah date normal time ke date epoch
        $epoch_start = $request->date_end;
        $dt = new DateTime("$epoch_start");  // convert UNIX timestamp to PHP DateTime
        $date_end = $dt->format('U');

        $validatedData['date_end'] = $date_end;

        $closed = VoteUnit::where('id', $request->id)->update($validatedData);

        if($closed){

            return back()->with('message', 'Your data has been closed!');

        }else{

            return back()->with('message', 'Your data failed closed!');
        }

    }

    public function delete(Request $request){
        // Request Validate Id Item
        $request->validate([
            'id' => 'required'
        ]);

        // Delete Vote Item By Vote Unit Id
        VoteItem::where('vote_unit_id', $request->id)->delete();
        // Delete Vote Profile By Vote Item Id
        VoteProfile::where('vote_item_id', $request->id)->delete();
        // Delete Vote Unit By Vote Unit Id
        $delete = VoteUnit::where('id', $request->id)->delete();

        if($delete){
            return back()->with('message', 'Your data has been deleted!');

        }else{

            return back()->with('message', 'Your data failed deleted!')->withInput();
        }

    }

    public function updateMoreProfileItem(Request $request){
        $profileId = $request->profileId;
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        VoteProfile::where('id', $profileId)->update($validatedData);

        return redirect(request()->header('Referer'))->with('success', 'Your data has been updated!');
    }

    public function deleteMoreProfileItem(Request $request){
        $profileId = $request->profile_id;
        $VoteProfile = VoteProfile::where('id', $profileId)->first();

        Storage::delete($VoteProfile->icon);
        VoteProfile::where('id', $profileId)->delete();

        return redirect(request()->header('Referer'))->with('success', 'Your data has been deleted!');
    }

}
