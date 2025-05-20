<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Condition;
use App\Models\Category;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab');

        if ($user && $tab === 'mylist') {
            $items = $user->item_likes()->paginate(6);
        } else {
            $items = Item::paginate(6);
        }
        return view('index', compact('items', 'tab'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab');

        $query = ($user && $tab === 'mylist') ? $user->item_likes() : Item::query();


        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%");
        }

        $items = $query->paginate(6)->withQueryString();

        return view('index', compact('items', 'tab', 'keyword'));
    }

    public function show($item_id)
    {
        $item = Item::with(['condition'])->find($item_id);
        $categories = $item->categories;
        return view('show', compact('item'));
    }

    public function getsell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $tab = $request->query('tab');
        if ($user && $tab === 'buy') {
            $items = $user->purchases()->paginate(6);
        } elseif ($user && $tab === 'sell') {
            $items = $user->sells()->paginate(6);
        } else {
            $items = Item::paginate(6);
        }
        return view('mypage', compact('user', 'profile', 'items'));
    }

    /**
     * 出品処理
     * @param ExhibitionRequest $request リクエスト
     * @return view ビュー
     */
    public function postsell(ExhibitionRequest $request)
    {
        $new_item = Item::create([
            'user_id' => Auth::id(),
            'name'         => $request->input('name'),                               // 名前
            'brandname'    => $request->input('brandname'),                          // ブランド名
            'description'  => $request->input('description'),                        // 商品説明
            'price'        => $request->input('price'),                              // 値段
            'image'        => $request->file('image')->store('products', 'public'),  // 商品画像
            'condition_id' => $request->input('condition_id'),                       // 商品の状態
        ]);
        $item_categories = $request->input('category', []);                          // 商品のカテゴリー
        $new_item->categories()->attach($item_categories);

        $items = Item::paginate(6);
        return view('mypage', compact('items'));
    }

    /**
     * 購入処理
     * @param integer $item_id アイテムID
     * @return view ビュー
     */
    public function purchase($item_id)
    {
        $item       = Item::with(['condition'])->find($item_id);
        $user       = Auth::user();
        $address    = Address::where('user_id', $user->id)->first();
        $profile    = Profile::where('user_id', $user->id)->first();

        return view('purchase', compact('item', 'user', 'address', 'profile'));
    }

    public function soldout(Purchaserequest $request, $item_id)
    {
        $user    = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $item    = Item::find($item_id);
        $item->purchase_user_id = Auth::id();                           // userID
        $item->purchase_method  = $request->input('purchase_method');   // 支払方法
        $item->save();

        $items = Item::paginate(6);
        return view('index', compact('items', 'profile'));
    }
}
