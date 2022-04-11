<?php

use App\Models\AccountTransaction;
use App\Models\Admin\Admin;
use App\Models\Search;
use App\Models\Seller\Feature;
use App\Models\Seller\Product;
use App\Models\Seller\Seller;
use App\Models\Statistic;
use App\Models\Stock;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Models\WalletTransaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

/**
 * @param $element
 * @return string|void
 */
function datatableStatus($element)
{
    if ($element->status) {
        if ($element->status == 'active') {
            return '<label class="badge badge-success">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'approved') {
            return '<label class="badge badge-success">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'pending') {
            return '<label class="badge badge-warning">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'paused') {
            return '<label class="badge badge-secondary">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'expired') {
            return '<span class="text-danger font-weight-bolder">' . ucfirst($element->status) . '</span>';
        }
        if ($element->status == 'unapproved') {
            return '<label class="badge badge-danger">Unapproved</label>';
        }
        if ($element->status == 'inactive') {
            return '<label class="badge badge-secondary">Inactive</label>';
        }
        if ($element->status == 'cancelled') {
            return '<label class="badge badge-danger">Cancelled</label>';
        }
        if ($element->status == 'blocked') {
            return '<label class="badge badge-danger">Blocked</label>';
        }
        if ($element->status == 'declined') {
            return '<label class="badge badge-danger">Declined</label>';
        }
        if ($element->status == 'confirmed') {
            return '<label class="badge badge-success">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'processing') {
            return '<label class="badge badge-info">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'shipped') {
            return '<label class="badge badge-secondary">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'returned') {
            return '<label class="badge badge-dark">' . ucfirst($element->status) . '</label>';
        }
        if ($element->status == 'delivered') {
            return '<label class="badge badge-success">' . ucfirst($element->status) . '</label>';
        }

    } else {
        if ($element->description == 'Success') {
            return '<label class="badge badge-success">' . ucfirst($element->description) . '</label>';
        }
        if ($element->description == 'Failed') {
            return '<label class="badge badge-danger">' . ucfirst($element->description) . '</label>';
        }
    }

}


/**
 * @param $element
 * @return string|void
 */
function payemntStatus($element)
{
    if ($element->payment_status) {
        if ($element->payment_status == 'pending') {
            return '<label class="badge badge-warning">Pending</label>';
        }
        if ($element->payment_status == 'confirmed') {
            return '<label class="badge badge-primary">Confirmed</label>';
        }
        if ($element->payment_status == 'paid') {
            return '<label class="badge badge-success">Paid</label>';
        }
        if ($element->payment_status == 'cancelled') {
            return '<label class="badge badge-danger">Cancelled</label>';
        }
        if ($element->payment_status == 'processing') {
            return '<label class="badge badge-info">Processing</label>';
        }
    }

}

/**
 * @param $element
 * @return string
 */
function payemntType($element)
{
    if ($element->payment) {
        if ($element->payment->payment_type == 'cod') {
            return '<label class="badge badge-info">Cash on Delivery</label>';
        }
        if ($element->payment->payment_type == 'wallet') {
            return '<label class="badge badge-success">Paid via Wallet</label>';
        }
    }
    return '<label class="badge badge-dark">Not selected</label>';
}

/**
 * @param $element
 * @return string|void
 */
function bladeStatus($element)
{
    if ($element == 'active') {
        return 'badge badge-success';
    }
    if ($element == 'approved') {
        return 'badge badge-success';
    }
    if ($element == 'pending') {
        return 'badge badge-warning';
    }
    if ($element == 'paused') {
        return 'badge badge-secondary';
    }
    if ($element == 'expired') {
        return 'text-danger font-weight-bolder';
    }
    if ($element == 'unapproved') {
        return 'badge badge-danger';
    }

    if ($element == 'inactive') {
        return 'badge badge-danger';
    }

}

/**
 * @param $status
 * @param $list
 * @return mixed
 */
function statusCount($status, $list)
{
    if ($status == 'active') {
        return $list->where('status', 'active')->latest();
    }
    if ($status == 'approved') {
        return $list->where('status', 'approved')->latest();
    }
    if ($status == 'pending') {
        return $list->where('status', 'pending')->latest();
    }
    if ($status == 'blocked') {
        return $list->where('status', 'blocked')->latest();
    }
    if ($status == 'cancelled') {
        return $list->where('status', 'cancelled')->latest();
    }
    if ($status == 'delivered') {
        return $list->where('status', 'delivered')->latest();
    }
    if ($status == 'confirmed') {
        return $list->where('status', 'confirmed')->latest();
    }
    if ($status == 'unapproved') {
        return $list->where('status', 'unapproved')->latest();
    }
    if ($status == 'inactive') {
        return $list->where('status', 'inactive')->latest();
    } elseif ($status == 'paused') {
        return $list->where('status', 'paused')->latest();
    }
    if ($status == 'expired') {
        return $list->where('status', 'expired')->latest();
    } else {
        return $list->latest();
    }
}

/**
 * @param $employment_status
 * @param $list
 * @return mixed
 */
function jobCount($employment_status, $list)
{
    if ($employment_status == 'full_time') {
        return $list->where('employment_status', 'full_time')->latest();
    }
    if ($employment_status == 'part_time') {
        return $list->where('employment_status', 'part_time')->latest();
    }
    if ($employment_status == 'freelance') {
        return $list->where('employment_status', 'freelance')->latest();
    }
    if ($employment_status == 'internship') {
        return $list->where('employment_status', 'internship')->latest();
    }
    if ($employment_status == 'contract') {
        return $list->where('employment_status', 'contract')->latest();
    }else {
        return $list->latest();
    }
}




/**
 * @param $element
 * @return string|void
 */
function datatableFeatureSponsorShow($element)
{
    if ($element) {
        if ($element->status == 'approved') return '<p class="text-success"> <sup>' . $element->result . '</sup>&frasl;<sub>' . $element->quantity . '</sub> ' . ucfirst($element->feature_type) . '</p>';
        if ($element->status == 'pending') return '<div class="badge badge-warning" title="' . $element->quantity . ' ' . $element->feature_type . '">' . $element->quantity . ' ' . $element->feature_type . ' </div>';
        if ($element->status == 'unapproved') return '<p class="text-danger"> <sup>' . $element->result . '</sup>&frasl;<sub>' . $element->quantity . '</sub> ' . ucfirst($element->feature_type) . '</p>';
        if ($element->status == 'expired') return '<i class="fas fa-times"></i>';
    } else {
        return '<i class="fas fa-times"></i>';
    }
}

/**
 * @param $name
 * @param $image
 * @param $imagePath
 * @param $defaultImagePath
 * @param $route
 * @param bool $is_user
 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
 */
function nameWithImage($name, $image, $imagePath, $defaultImagePath = '', $route, bool $is_user = false)
{
    return view('components.nameWithImage', ['name' => $name, 'image' => $image ? asset(config($imagePath)) . $image : asset($defaultImagePath), 'route' => $route, 'is_user' => $is_user]);
}

/**
 * @param $icon
 * @return string|null
 */
function icon($icon = '')
{
    if ($icon == 'delete') {
        return 'far fa-trash-alt';
    }
    return null;
}

/**
 * increment click/view/inquiry/response/comment for organization/product/service/buy request/
 *
 */
function incrementStatistics($element, $elementClass, $clickOrInquiryOrView)
{
    $elementStatistics = Statistic::where(['reportable_id' => $element->id, 'reportable_type' => $elementClass])->first();
    $data = is_array($clickOrInquiryOrView) ? $clickOrInquiryOrView : array($clickOrInquiryOrView);

    foreach ($data as $column) {
        if (!$elementStatistics) {
            Statistic::create(['reportable_id' => $element->id, 'reportable_type' => $elementClass, $column => 1]);
        } else {
            $elementStatistics->increment($column);
        }
    }
}

/**
 * @param $sponsorRequest
 * @param $element
 * @param $elementClass
 * @param $clickOrInquiryOrView
 * @param $featuredOrSponsored
 * @return void
 */
function sponsorFeatureClickIncrement($sponsorRequest, $element, $elementClass, $clickOrInquiryOrView, $featuredOrSponsored)
{
    if ($sponsorRequest) {
        $sponsored = Feature::where(['type' => $featuredOrSponsored, 'featurable_id' => $element->id, 'featurable_type' => $elementClass, 'status' => 'approved'])->latest()->first();
        if ($sponsored) {
            if ($sponsored->feature_type == $clickOrInquiryOrView) {
                if ($sponsored->result < $sponsored->quantity) {
                    $sponsorStatistics = $sponsored->report();
                    $sponsorStatistics->increment($clickOrInquiryOrView);
                    $sponsored->increment('result');
                    if ($sponsored->result == $sponsored->quantity) {
                        $sponsored->update(['status' => 'expired']);
                    }
                }
            } else {
                $sponsorStatistics = $sponsored->report();
                $sponsorStatistics->increment($clickOrInquiryOrView);
            }
        }
    }
}

/**
 * @param $request
 * @param $sector
 * @param $keyword
 * @return void
 */
function insertSearchData($request, $sector, $keyword)
{
    $search = new Search();
    $search->ip_address = $request->ip();
    $search->user_id = auth('sanctum')->user() ? auth('sanctum')->user()->id : null;
    $search->user_agent = $request->userAgent();
    $search->sector = $sector;
    $search->keyword = $keyword;
    $search->save();
}

/**
 * @param $request
 * @param $encryptedId
 * @param $InOrOut
 * @return \Illuminate\Http\RedirectResponse|void
 */
function stockManage($request, $encryptedId, $InOrOut)
{
    $request->validate([
        'stock' => 'nullable|integer|min:1',
        'purchaseDate' => 'nullable|date',
        'cost' => 'nullable|integer|min:1',
        'supplier' => 'nullable|string|max:30',
        'stockOut' => 'nullable|integer|min:1',
        'reason' => 'nullable|string|max:500',
        'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf|max:1024'
    ]);
    $product = Product::findOrFail(decrypt($encryptedId));
    $stock = new Stock();
    $stock->stockable_id = decrypt($encryptedId);
    $stock->stockable_type = Product::class;
    if ($InOrOut == 'in') {
        $stock->stock_in = $request->stock;
        $stock->purchase_date = $request->purchaseDate;
        $stock->cost = $request->cost;
        $stock->supplier = $request->supplier;
    } elseif ($InOrOut == 'out') {
        if ($request->stockOut > $product->current_stock) {
            Toastr::error('You current stock is ' . '<strong style="color:red">' . $product->current_stock . '</strong>' . '' . '<br> you cannot out stoke more then ' . $product->current_stock, 'Error');
            return back();
        }
        $stock->stock_out = $request->stockOut;
        $stock->reason = $request->reason;
    }
    if ($request->has('attachment')) {
        $fileName = $product->slug . '.' . time() . '.' . $request->attachment->getClientOriginalExtension();
        $request->attachment->storeAs('Attachment', $fileName, 'attachment');
        $stock->attachment = $fileName;
    }
    $stock->save();
    if ($InOrOut == 'in') {
        $product->current_stock = $product->current_stock + $stock->stock_in;
    } elseif ($InOrOut == 'out') {
        $product->current_stock = $product->current_stock - $stock->stock_out;
    }
    $product->update();
    Toastr::success('Your Stock added Successfully', 'Success');
}

/**
 * @param $elements
 * @param $elementClass
 * @param string|null $featuredOrSponsored
 * @return void
 */
function multipleViewIncrement($elements, $elementClass, string $featuredOrSponsored = null)
{
    $elementId = $elements->pluck('id')->toArray();     //get elements id
    $statisticId = Statistic::where('reportable_type', $elementClass)->pluck('reportable_id')->toArray();   //find statistic data of those element
    $rests = array_diff($elementId, $statisticId); // check which element not present in statistic table
//   return $rests= array_merge(array_diff($id,$sId),array_diff($sId,$id));
    if (($rests)) {
        $allintests = [];   //empty array to insert data at once.
        foreach ($rests as $rest) {     //using loop to add them into one array
            $intestcat = new Statistic();
            $intestcat->reportable_id = $rest;
            $intestcat->reportable_type = $elementClass;
//            Statistic::create(['reportable_id' => $rest, 'reportable_type' => $elementClass, 'view' => 0]);
            $allintests[] = $intestcat->attributesToArray();
        }
        Statistic::insert($allintests);     //insert all element which is not present
    }
    Statistic::where('reportable_type', $elementClass)->whereIn('reportable_id', $elementId)->increment('view'); //increment element view

    if ($featuredOrSponsored) { //if element is featured or sponsored
        //check the element if this is approved or not
        $featureData = Feature::where(['type' => $featuredOrSponsored, 'featurable_type' => $elementClass, 'status' => 'approved'])->whereIn('featurable_id', $elementId)->latest()->get();
        $data1 = Feature::whereIn('id', $featureData->pluck('id')->toArray());
        //check if result is greater then quantity, if so , then expired
        $data1->where('feature_type', '=', 'view')->whereColumn('result', '>=', 'quantity')->update(['status' => 'expired']);
        $data2 = Feature::whereIn('id', $featureData->pluck('id')->toArray());
        // if not, increment result
        $data2->where('feature_type', '=', 'view')->whereColumn('result', '<', 'quantity')->increment('result');
        // as well as increment views in result table
        Statistic::where('reportable_type', '=', Feature::class)->whereIn('reportable_id', $featureData->pluck('id'))->increment('view');
    }
}

/**
 * @param $request
 * @param $feature
 * @return void
 */
function walletTransaction($request, $feature)
{
    $wallet = new WalletHistory();
    $wallet->organization_id = auth('seller')->user()->organization_id;
    $wallet->coin = $request->hiddenPrice;
    $wallet->txn_type = 'out';
    $wallet->t_id = $feature->id;
    $wallet->t_type = Feature::class;
    $wallet->save();
}

/**
 * @param $feature
 * @return void
 */
function walletTransactionPaid($feature)
{
    $walletHistory = WalletHistory::where(['t_id' => $feature->id, 't_type' => Feature::class])->first();
    if ($walletHistory) {
        $walletHistory->update(['payment_status' => 'paid']);
        $wallet = Wallet::where('organization_id', $walletHistory->organization_id)->first();
        $wallet->update(['coin' => $wallet->coin - $walletHistory->coin]);
    }
}

/**
 * @param $invoice
 * @return string|null
 */
function cancelStatus($invoice)
{
    return $invoice->cancel_status ? (json_decode($invoice->cancel_status, true)['user_type'] == Seller::class ? '<b>Seller</b>' : '<b>Buyer</b>') : null;
}

/**
 * @param $Model
 * @param $id
 * @param $amount
 * @param $is_other
 * @return Wallet
 */
function addToWallet($Model, $id, $amount, $is_other = false)
{
    $wallet = Wallet::where(['walletable_type' => $Model, 'walletable_id' => $id])->first();
    if ($wallet) {
        if ($is_other) {
            $wallet->increment('other_balance', $amount);
        } else {
            $wallet->increment('balance', $amount);
        }
    } else {
        $wallet = new Wallet();
        $wallet->walletable_type = $Model;
        $wallet->walletable_id = $id;
        $wallet->other_balance = 0;
        $wallet->balance = 0;
        if ($is_other) {
            $wallet->other_balance = $amount;
        } else {
            $wallet->balance = $amount;
        }
        $wallet->save();
    }
    return $wallet;
}

/**
 * @param array $data
 * @param bool $isAdmin
 * @return mixed
 */
function creditOrDebitTransaction(array $data, bool $isAdmin = true)
{
    return WalletTransaction::create([
        'wallet_id' => $data['wallet_id'],
        'transaction_type' => $data['transaction_type'],
        'account_transaction_id' => $data['account_transaction_id'] ?? null,
        'amount' => $data['amount'],
        'purpose' => $data['purpose'],
        'description' => $data['description'] ?? null,
        'transaction_for_type' => $data['transaction_for_type'] ?? null,
        'transaction_for_id' => $data['transaction_for_id'] ?? null,
        'status' => $isAdmin ? 'approved' : 'pending',
        'wallet_type' => $data['wallet_type'] ?? 'normal',
    ]);
}

/**
 * @param $data
 * @param bool $isAdmin
 * @return mixed
 */
function transactionToAccount($data, bool $isAdmin = true)
{
    return AccountTransaction::create([
        'account_id' => $data['account_id'] ?? null,
        'transaction_id' => $data['transaction_id'] ?? null,
        'amount' => $data['amount'],
        'status' => $isAdmin ? 'paid' : 'pending',
        'sender_account_id' => $data['sender_account_id'] ?? null,
        'options' => $data['options'] ?? null,
        'sender_type' => $data['sender_type'] ?? null,
        'sender_id' => $data['sender_id'] ?? null,
    ]);
}

/**
 * @return Wallet
 */
function FindOrCreateAdminWallet()
{
    $adminWallet = Wallet::where('walletable_type', Admin::class)->first();
    if (!$adminWallet) {
        $adminWallet = new Wallet();
        $adminWallet->walletable_type = Admin::class;
        $adminWallet->walletable_id = Admin::first()->id;
        $adminWallet->other_balance = 0;
        $adminWallet->balance = 0;
        $adminWallet->save();
    }
    return $adminWallet;
}

function affiliateViewCount(){
    if (\request()->ref_code){
        $user = DB::connection('affiliate')->table('users')->where('referral_code','=',(\request()->ref_code))->first();
        $program =  DB::connection('affiliate')->table('aff_sub_programs')->where('code','=',(\request()->program))->first();
        DB::connection('affiliate')->table('aff_sub_programs')->where('id','=',$program->id)->limit(1)->update([
            'view_count'=>$program->view_count+1
        ]);
        $existingData = DB::connection('affiliate')->table('user_programs')->where(['user_id'=>$user->id,'sub_program_id'=> $program->id])->first();
        if (!$existingData){
            DB::connection('affiliate')->table('user_programs')->insert([
                'user_id'=>$user->id,
                'sub_program_id'=>$program->id,
                'view_count' => 1
            ]);
        }else{
            DB::connection('affiliate')->table('user_programs')->where(['user_id'=>$user->id,'sub_program_id'=> $program->id])->limit(1)->update([
                'view_count'=>$existingData->view_count+1
            ]);
        }
    }
}
function affiliateSaleCount(){
    if (\request()->ref_code){
        $user = DB::connection('affiliate')->table('users')->where('referral_code','=',(\request()->ref_code))->first();
        $program =  DB::connection('affiliate')->table('aff_sub_programs')->where('code','=',(\request()->program))->first();
        DB::connection('affiliate')->table('aff_sub_programs')->where('id','=',$program->id)->limit(1)->update([
            'sale_count'=>$program->sale_count+1
        ]);
        $existingData = DB::connection('affiliate')->table('user_programs')->where(['user_id'=>$user->id,'sub_program_id'=> $program->id])->first();
        if (!$existingData){
            DB::connection('affiliate')->table('user_programs')->insert([
                'user_id'=>$user->id,
                'sub_program_id'=>$program->id,
                'sale_count' => 1
            ]);
        }else{
            DB::connection('affiliate')->table('user_programs')->where(['user_id'=>$user->id,'sub_program_id'=> $program->id])->limit(1)->update([
                'sale_count'=>$existingData->sale_count+1
            ]);
        }
    }
}
function adminDeleteNotificationFunction($request, $type)
{
    if ($request->check=='Delete All'){
        auth()->user()->notifications()->delete();
    } else{
        if ($request->id) {
            if ($type == 'admin'){
                $allId = array_keys($request->id);
            } else {
                $allId = $request->id;
            }

            foreach ($allId as $id) {
                auth()->user()->notifications()->where('id', $id)->first()->delete();
            }
        }
    }
}

function sellerDeleteNotificationFunction($request, $type)
{
    if ($request->check=='Delete All'){
        auth()->user()->notifications()->delete();
    } else{
        if ($request->id) {
            if ($type == 'seller'){
                $allId = array_keys($request->id);
            } else {
                $allId = $request->id;
            }

            foreach ($allId as $id) {
                auth()->user()->notifications()->where('id', $id)->first()->delete();
            }
        }
    }
}
