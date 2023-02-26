<?php

namespace App\Http\Livewire;

use App\Models\Certified;
use App\Models\CertifiedBook;
use App\Models\User;
use Carbon\Carbon;
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
            ["id"=>"004", "name"=>"台灣銀行"],
            ["id"=>"005", "name"=>"土地銀行"],
            ["id"=>"006", "name"=>"合作金庫"],
            ["id"=>"007", "name"=>"第一銀行"],
            ["id"=>"008", "name"=>"華南銀行"],
            ["id"=>"009", "name"=>"彰化銀行"],
            ["id"=>"011", "name"=>"上海商銀"],
            ["id"=>"012", "name"=>"台北富邦銀行"],
            ["id"=>"013", "name"=>"國泰世華銀行"],
            ["id"=>"016", "name"=>"高雄銀行"],
            ["id"=>"017", "name"=>"兆豐銀行"],
            ["id"=>"018", "name"=>"農業金庫"],
            ["id"=>"021", "name"=>"花旗銀行"],
            ["id"=>"022", "name"=>"美國銀行"],
            ["id"=>"025", "name"=>"首都銀行"],
            ["id"=>"048", "name"=>"王道銀行"],
            ["id"=>"050", "name"=>"台灣企銀"],
            ["id"=>"052", "name"=>"渣打商銀"],
            ["id"=>"053", "name"=>"台中商銀"],
            ["id"=>"054", "name"=>"京城銀行"],
            ["id"=>"075", "name"=>"東亞銀行"],
            ["id"=>"081", "name"=>"匯豐銀行"],
            ["id"=>"082", "name"=>"法國巴黎銀行"],
            ["id"=>"101", "name"=>"瑞興銀行"],
            ["id"=>"102", "name"=>"華泰商銀"],
            ["id"=>"103", "name"=>"台灣新光"],
            ["id"=>"104", "name"=>"台北五信"],
            ["id"=>"108", "name"=>"陽信銀行"],
            ["id"=>"700", "name"=>"中華郵政"],
            ["id"=>"803", "name"=>"聯邦銀行"],
            ["id"=>"805", "name"=>"遠東銀行"],
            ["id"=>"806", "name"=>"元大商業銀行"],
            ["id"=>"808", "name"=>"玉山銀行"],
            ["id"=>"809", "name"=>"凱基銀行"],
            ["id"=>"810", "name"=>"星展銀行"],
            ["id"=>"812", "name"=>"台新銀行"],
            ["id"=>"815", "name"=>"日盛銀行"],
            ["id"=>"816", "name"=>"安泰銀行"],
            ["id"=>"822", "name"=>"中國信託"],
            ["id"=>"823", "name"=>"將來銀行"],
            ["id"=>"824", "name"=>"連線商業銀行"],
            ["id"=>"826", "name"=>"樂天國際商業銀行"],
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

        session()->flash('card-success', '上傳成功！');
    }
    public function render()
    {
        return view('livewire.consignment')->layout('layouts.base');
    }
}
