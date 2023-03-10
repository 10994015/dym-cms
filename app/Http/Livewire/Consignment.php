<?php

namespace App\Http\Livewire;

use App\Models\Certified;
use App\Models\CertifiedBook;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Subaccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
class Consignment extends Component
{
    use WithFileUploads;
    public $user_id;
    public $username;
    public $topline;
    public $topline_name;
    public $card_front;
    public $card_back;
    public $number_id;
    public $passbook_cover;
    public $bank;
    public $bank_branches;
    public $passbook_account_name;
    public $passbook_account;

    public $new_card_front;
    public $new_card_back;
    public $new_passbook_cover;
    public $dataAuth;
    public $openBank;
    public function mount($id){
        $this->user_id = $id;
        if(Auth::user()->issub === 1){
            $sub = Subaccount::where('user_id', Auth::id())->first();
            if($sub->member !== 1){
                return redirect('/notfound');
            }
        }
        $user = User::where([['id', $id], ['utype', 'USR']])->first() ?? NULL;
        if($user == NULL){
            return redirect('/notfound');
        }
        Log::info($user);
        if(Auth::user()->highest_auth === 1 || ($user->toponline == Auth::id())){
            $user = User::find($id);
            $this->username = $user->username;
            $this->topline = $user->toponline;
            $this->topline_name = User::find($this->topline)->username;
            if(Certified::where('user_id', $id)->orderBy('id', 'DESC')->count() > 0){
                $certified =  Certified::where('user_id', $id)->orderBy('id', 'DESC')->first();
                $this->card_front = $certified->card_front;
                $this->card_back = $certified->card_back;
                $this->number_id = $certified->number_id;
            }
            if(CertifiedBook::where('user_id', $id)->orderBy('id', 'DESC')->count() > 0){
                $certifiedPassbook =  CertifiedBook::where('user_id', $id)->orderBy('id', 'DESC')->first();
                $this->passbook_cover = $certifiedPassbook->passbook_cover;
                $this->bank = $certifiedPassbook->bank;
                $this->bank_branches = $certifiedPassbook->bank_branches;
                $this->passbook_account_name = $certifiedPassbook->passbook_account_name;
                $this->passbook_account = $certifiedPassbook->passbook_account;
            }

        }else{
            return redirect('/notfound');
        }
        $this->dataAuth = User::find($id)->data_auth;

        $this->openBank = [
            ["id"=>"004", "name"=>"????????????"],
            ["id"=>"005", "name"=>"????????????"],
            ["id"=>"006", "name"=>"????????????"],
            ["id"=>"007", "name"=>"????????????"],
            ["id"=>"008", "name"=>"????????????"],
            ["id"=>"009", "name"=>"????????????"],
            ["id"=>"011", "name"=>"????????????"],
            ["id"=>"012", "name"=>"??????????????????"],
            ["id"=>"013", "name"=>"??????????????????"],
            ["id"=>"016", "name"=>"????????????"],
            ["id"=>"017", "name"=>"????????????"],
            ["id"=>"018", "name"=>"????????????"],
            ["id"=>"021", "name"=>"????????????"],
            ["id"=>"022", "name"=>"????????????"],
            ["id"=>"025", "name"=>"????????????"],
            ["id"=>"048", "name"=>"????????????"],
            ["id"=>"050", "name"=>"????????????"],
            ["id"=>"052", "name"=>"????????????"],
            ["id"=>"053", "name"=>"????????????"],
            ["id"=>"054", "name"=>"????????????"],
            ["id"=>"075", "name"=>"????????????"],
            ["id"=>"081", "name"=>"????????????"],
            ["id"=>"082", "name"=>"??????????????????"],
            ["id"=>"101", "name"=>"????????????"],
            ["id"=>"102", "name"=>"????????????"],
            ["id"=>"103", "name"=>"????????????"],
            ["id"=>"104", "name"=>"????????????"],
            ["id"=>"108", "name"=>"????????????"],
            ["id"=>"700", "name"=>"????????????"],
            ["id"=>"803", "name"=>"????????????"],
            ["id"=>"805", "name"=>"????????????"],
            ["id"=>"806", "name"=>"??????????????????"],
            ["id"=>"808", "name"=>"????????????"],
            ["id"=>"809", "name"=>"????????????"],
            ["id"=>"810", "name"=>"????????????"],
            ["id"=>"812", "name"=>"????????????"],
            ["id"=>"815", "name"=>"????????????"],
            ["id"=>"816", "name"=>"????????????"],
            ["id"=>"822", "name"=>"????????????"],
            ["id"=>"823", "name"=>"????????????"],
            ["id"=>"824", "name"=>"??????????????????"],
            ["id"=>"826", "name"=>"????????????????????????"],
        ];
    }
    public function uploadFile(){
        $cardFrontRandom = rand(0,99999);
        $cardBackRandom = rand(0,99999);
        $passbookCoverRandom = rand(0,99999);
        $cretified = new Certified();
        $cretifiedBook = new CertifiedBook();
      
        if($this->new_card_front){
            $cardFrontName = Carbon::now()->timestamp. '.' . $cardFrontRandom . $this->new_card_front->extension();
            $this->new_card_front->storeAs('uploads/uploads/cretified', $cardFrontName);
        }else{
            $cardFrontName = $this->card_front;
        }
        if($this->new_card_back){
            $cardBackName = Carbon::now()->timestamp. '.' . $cardBackRandom . $this->new_card_back->extension();
            $this->new_card_back->storeAs('uploads/uploads/cretified', $cardBackName);
        }else{
            $cardBackName = $this->card_back;
        }
        if($this->new_passbook_cover){
            $passbookCoverName = Carbon::now()->timestamp. '.' . $passbookCoverRandom . $this->new_passbook_cover->extension();
            $this->new_passbook_cover->storeAs('uploads/uploads/cretified', $passbookCoverName);
        }else{
            $passbookCoverName = $this->passbook_cover;;
        }
      
        $cretified->card_front = $cardFrontName;
        $cretified->card_back = $cardBackName;
        $cretified->number_id = $this->number_id;
        $cretified->user_id = $this->user_id;

        $cretifiedBook->passbook_cover = $passbookCoverName;
        $cretifiedBook->bank = $this->bank;
        $cretifiedBook->bank_branches = $this->bank_branches;
        $cretifiedBook->passbook_account_name = $this->passbook_account_name;
        $cretifiedBook->passbook_account = $this->passbook_account;
        $cretifiedBook->user_id = $this->user_id;

        $member = User::find($this->user_id);
        $member->data_auth = $this->dataAuth;

        $cretified->save();
        $cretifiedBook->save();
        $member->save();

        session()->flash('card-success', '???????????????');
    }
    public function render()
    {
        return view('livewire.consignment')->layout('layouts.base');
    }
}
