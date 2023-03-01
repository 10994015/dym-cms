<?php

namespace App\Http\Livewire;

use App\Models\StorePointRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
class StorageValue extends Component
{
    use WithPagination;
    public $searchText = "";
    public $pageNumber;
    public function mount(){
        $this->pageNumber = 15;
    }
    public function render()
    {

        if(Auth::user()->highest_auth || Auth::user()->issub){
            $storePoint = StorePointRecord::where([['status', 1], ['store', 1],['username', 'like', "%$this->searchText%"]])->orderBy('created_at', 'DESC')->paginate($this->pageNumber);
        }else{
            $storePoint = StorePointRecord::where([['status', 1], ['store', 1],['proxy_id', Auth::id()],['username', 'like', "%$this->searchText%"]])->orderBy('created_at', 'DESC')->paginate($this->pageNumber);
        }
        return view('livewire.storage-value', ['storePoint'=>$storePoint])->layout('layouts.base');
    }
}
