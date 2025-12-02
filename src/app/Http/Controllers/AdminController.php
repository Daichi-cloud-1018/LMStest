<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = $this->filteredContacts($request);
        return view('admin', compact('contacts'));
    }

    public function search(Request $request)
    {
        $contacts = $this->filteredContacts($request);
        return view('admin', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.search')->with('status', '削除しました');
    }

    public function export(Request $request)
    {
        $contacts = $this->filteredContactsQuery($request)->get();

        return response()->streamDownload(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容', '作成日']);

            foreach ($contacts as $contact) {
                $gender = match ($contact->gender) {
                    1 => '男性',
                    2 => '女性',
                    default => 'その他',
                };

                fputcsv($handle, [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    optional($contact->category)->content ?? '',
                    $contact->detail,
                    optional($contact->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, 'contacts.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function filteredContacts(Request $request)
    {
        return $this->filteredContactsQuery($request)
            ->paginate(10)
            ->withQueryString();
    }

    private function filteredContactsQuery(Request $request)
    {
        $query = Contact::with('category')->latest();

        $request->whenFilled('keyword', function ($keyword) use ($query) {
            $query->where(function ($q) use ($keyword) {
                $q->where('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        });

        $request->whenFilled('gender', fn ($gender) => $query->where('gender', $gender));
        $request->whenFilled('category', fn ($category) => $query->where('category_id', $category));
        $request->whenFilled('date', fn ($date) => $query->whereDate('created_at', $date));

        return $query;
    }
}
