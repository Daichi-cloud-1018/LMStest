<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-weekday:nth-child(1) {
            color: #e05555;
        }

        .flatpickr-weekday:nth-child(7) {
            color: #4c7ee0;
        }

        .flatpickr-footer {
            display: flex;
            justify-content: flex-end;
            padding: 6px 8px;
        }

        .fp-today-btn {
            border: none;
            background: transparent;
            color: #3d8be3;
            cursor: pointer;
            font-size: 13px;
        }

        .fp-today-btn:hover {
            text-decoration: underline;
        }
    </style>
    <title>FashionablyLate - Admin</title>
</head>

<body>
    <header class="header">
        <div class="header-inner">
            <h1 class="header-title">FashionablyLate</h1>
            @include('components.logout-button')
        </div>
    </header>

    <main>
        <div class="page-title">
            <h2>Admin</h2>
        </div>

        <section class="admin-section">
            <form class="filter-form" action="{{ route('admin.search') }}" method="get">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="category">
                    <option value="">お問い合わせの種類</option>
                    <option value="1" {{ request('category') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="2" {{ request('category') == '2' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="3" {{ request('category') == '3' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="4" {{ request('category') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="5" {{ request('category') == '5' ? 'selected' : '' }}>その他</option>
                </select>

                <input type="date" id="filter-date" name="date" value="{{ request('date') }}" placeholder="年/月/日">

                <button type="submit" class="btn-search">検索</button>
                <button type="button" class="btn-reset" id="reset-button" data-reset-url="{{ route('admin') }}">リセット</button>
            </form>

            <div class="toolbar">
                <a class="btn-export" href="{{ route('admin.export', request()->query()) }}">エクスポート</a>
            </div>

            <div class="table-wrapper">
                <table class="contact-table">
                    <thead>
                        <tr>
                            <th>お名前</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>お問い合わせ内容</th>
                            <th>お問い合わせの種類</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                            <td>
                                @if ($contact->gender == 1)
                                男性
                                @elseif ($contact->gender == 2)
                                女性
                                @else
                                その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td class="detail-cell">{{ Str::limit($contact->detail, 80) }}</td>
                            <td>{{ optional($contact->category)->content ?? '未設定' }}</td>
                            <td>
                                <button type="button"
                                    class="btn-detail"
                                    data-last-name="{{ e($contact->last_name) }}"
                                    data-first-name="{{ e($contact->first_name) }}"
                                    data-gender="{{ e($contact->gender) }}"
                                    data-email="{{ e($contact->email) }}"
                                    data-tel="{{ e($contact->tel) }}"
                                    data-address="{{ e($contact->address) }}"
                                    data-building="{{ e($contact->building) }}"
                                    data-category="{{ e(optional($contact->category)->content ?? '未設定') }}"
                                    data-detail="{{ e($contact->detail) }}"
                                    data-id="{{ $contact->id }}"
                                >詳細</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">お問い合わせがありません</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $contacts->links() }}
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            flatpickr('#filter-date', {
                dateFormat: 'Y-m-d',
                locale: flatpickr.l10ns.ja,
                allowInput: true,
                maxDate: 'today',
                firstDayOfWeek: 0,
                onOpen: (_selectedDates, _dateStr, fp) => {
                    if (fp.calendarContainer.querySelector('.fp-today-btn')) return;
                    const footer = fp.calendarContainer.querySelector('.flatpickr-footer') ||
                        fp.calendarContainer.appendChild(document.createElement('div'));
                    footer.classList.add('flatpickr-footer');
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = '今日';
                    btn.className = 'fp-today-btn';
                    btn.addEventListener('click', () => {
                        fp.setDate(new Date(), true);
                        fp.close();
                    });
                    footer.appendChild(btn);
                },
            });

            const resetBtn = document.getElementById('reset-button');
            if (resetBtn && resetBtn.dataset.resetUrl) {
                resetBtn.addEventListener('click', () => {
                    window.location.href = resetBtn.dataset.resetUrl;
                });
            }
        });
    </script>

    <div class="modal" id="contact-modal" aria-hidden="true">
        <div class="modal-overlay" data-modal-close></div>
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <button class="modal-close" type="button" data-modal-close aria-label="閉じる">×</button>
            <h3 id="modal-title" class="modal-title">お問い合わせ詳細</h3>
            <dl class="modal-list">
                <div class="modal-row">
                    <dt>お名前</dt>
                    <dd id="modal-name"></dd>
                </div>
                <div class="modal-row">
                    <dt>性別</dt>
                    <dd id="modal-gender"></dd>
                </div>
                <div class="modal-row">
                    <dt>メールアドレス</dt>
                    <dd id="modal-email"></dd>
                </div>
                <div class="modal-row">
                    <dt>電話番号</dt>
                    <dd id="modal-tel"></dd>
                </div>
                <div class="modal-row">
                    <dt>住所</dt>
                    <dd id="modal-address"></dd>
                </div>
                <div class="modal-row">
                    <dt>建物名</dt>
                    <dd id="modal-building"></dd>
                </div>
                <div class="modal-row">
                    <dt>お問い合わせの種類</dt>
                    <dd id="modal-category"></dd>
                </div>
                <div class="modal-row">
                    <dt>お問い合わせ内容</dt>
                    <dd id="modal-detail"></dd>
                </div>
            </dl>
            <div class="modal-actions">
                <form id="delete-form" method="POST" class="modal-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">削除</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('contact-modal');
            if (!modal) return;

            const nameEl = document.getElementById('modal-name');
            const genderEl = document.getElementById('modal-gender');
            const emailEl = document.getElementById('modal-email');
            const telEl = document.getElementById('modal-tel');
            const addressEl = document.getElementById('modal-address');
            const buildingEl = document.getElementById('modal-building');
            const categoryEl = document.getElementById('modal-category');
            const detailEl = document.getElementById('modal-detail');
            const deleteForm = document.getElementById('delete-form');

            const openModal = (btn) => {
                const genderMap = { '1': '男性', '2': '女性', '3': 'その他' };
                nameEl.textContent = `${btn.dataset.lastName}　${btn.dataset.firstName}`;
                genderEl.textContent = genderMap[btn.dataset.gender] ?? '';
                emailEl.textContent = btn.dataset.email || '';
                telEl.textContent = btn.dataset.tel || '';
                addressEl.textContent = btn.dataset.address || '';
                buildingEl.textContent = btn.dataset.building || '';
                categoryEl.textContent = btn.dataset.category || '';
                detailEl.textContent = btn.dataset.detail || '';
                if (deleteForm && btn.dataset.id) {
                    deleteForm.action = `/admin/${btn.dataset.id}`;
                }

                modal.setAttribute('aria-hidden', 'false');
                modal.classList.add('is-open');
            };

            const closeModal = () => {
                modal.setAttribute('aria-hidden', 'true');
                modal.classList.remove('is-open');
            };

            document.querySelectorAll('.btn-detail').forEach(btn => {
                btn.addEventListener('click', () => openModal(btn));
            });

            modal.querySelectorAll('[data-modal-close]').forEach(el => {
                el.addEventListener('click', closeModal);
            });
        });
    </script>
</body>

</html>
