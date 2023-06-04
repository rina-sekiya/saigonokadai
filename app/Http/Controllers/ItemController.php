<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item
            ::where('items.status', 'active')
            ->select()
            ->get();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }
    public function delete($id){
        Item::find($id)->delete();
        return redirect('/items')->with('message','削除しました。');
    }

    public function edit(Request $request)
    {
        $item=Item::find($request->id);
        return view('item.edit',[
            'item' =>$item,
        ]);
    }

    public function search(Request $request)
    {
         /* テーブルから全てのレコードを取得する */
           $query = Item::query();

        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行
            $query->where('name', 'LIKE', "%{$keyword}%")
            ->orwhere('detail', 'LIKE', "%{$keyword}%");
        }
        $items = $query->paginate(5);


        return view('item.index')->with('items',$items)->with('keyword',$keyword);
    }

}