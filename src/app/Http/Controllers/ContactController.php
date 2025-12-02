<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
        $inputs = $request->validated();
        $inputs['tel'] = $inputs['phone_1'] . '-' . $inputs['phone_2'] . '-' . $inputs['phone_3'];
        $inputs['category_id'] = Category::where('content', $inputs['content'])->value('id');
        return view('confirm', compact('inputs'));
    }
    public function back(Request $request)
    {
        return redirect()->route('contact.index')->withInput($request->all());
    }
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $data['tel'] = $data['phone_1'] . '-' . $data['phone_2'] . '-' . $data['phone_3'];
        $data['building'] = $data['building'] ?? '';
        // hiddenのcategory_idを優先し、無ければcontentから取得。見つからなければ「その他」を登録して使用。
        $data['category_id'] = $data['category_id']
            ?? Category::where('content', $data['content'])->value('id');

        if (empty($data['category_id'])) {
            $data['category_id'] = Category::firstOrCreate(['content' => $data['content']], ['content' => $data['content']])->id;
        }

        $contact = Contact::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'tel' => $data['tel'],
            'address' => $data['address'],
            'building' => $data['building'],
            'detail' => $data['detail'],
            'category_id' => $data['category_id'],
        ]);
        return view('thanks', compact('contact'));
    }
}
