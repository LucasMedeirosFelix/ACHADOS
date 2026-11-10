<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#292a40">
    <title>Mural de itens encontrados | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --white: #fff; --line: #e4e4eb; --pink: #f31656; --blue: #2879a7; --green: #e9f2e9; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        button, input, textarea { font: inherit; }
        a, button, input, textarea { -webkit-tap-highlight-color: transparent; }
        .topbar { min-height: 74px; display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 12px max(28px, calc((100vw - 1200px) / 2)); background: var(--ink); }
        .brand { display: flex; align-items: center; gap: 11px; color: white; text-decoration: none; }
        .brand-mark { width: 35px; height: 35px; display: grid; place-items: center; border-radius: 8px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 23px; }
        .brand-name { display: block; font-size: 15px; font-weight: 700; }
        .brand-caption { display: block; margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .admin-link { min-height: 38px; display: inline-flex; align-items: center; padding: 0 13px; border: 1px solid #77788a; border-radius: 3px; color: white; text-decoration: none; font-size: 12px; font-weight: 600; }
        .admin-link:hover { border-color: white; background: #ffffff12; }
        main { width: min(1200px, calc(100% - 56px)); margin: 0 auto; padding: 42px 0 64px; }
        .intro { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 27px; }
        .eyebrow { margin: 0 0 9px; color: #61458f; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1 { margin-bottom: 8px; font-family: 'DM Serif Display', Georgia, serif; font-size: 42px; font-weight: 400; line-height: 1.08; }
        .intro-copy { max-width: 560px; margin-bottom: 0; color: var(--muted); font-size: 14px; line-height: 1.65; }
        .total { flex: 0 0 auto; display: flex; align-items: baseline; gap: 9px; padding: 11px 15px; border: 1px solid #d7cce8; border-radius: 4px; background: #eeeaf5; }
        .total strong { color: #4e3677; font-family: 'DM Serif Display', Georgia, serif; font-size: 24px; font-weight: 400; }
        .total span { color: #5c526f; font-size: 12px; }
        .success { margin-bottom: 22px; padding: 12px 15px; border: 1px solid #b9d1c1; border-radius: 3px; background: var(--green); color: #275b40; font-size: 13px; }
        .section-head { display: flex; align-items: center; justify-content: space-between; gap: 18px; margin: 0 0 16px; }
        .section-head h2 { margin: 0; font-family: 'DM Serif Display', Georgia, serif; font-size: 26px; font-weight: 400; }
        .search-wrap { position: relative; width: min(100%, 290px); }
        .search-wrap span { position: absolute; top: 10px; left: 12px; color: #61458f; }
        input, textarea { width: 100%; min-height: 42px; padding: 10px 12px; border: 1px solid #dfe3dd; border-radius: 3px; outline: none; background: white; color: var(--ink); font-size: 13px; }
        input:focus, textarea:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        .search-wrap input { padding-left: 35px; }
        .items { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
        .item-card { min-width: 0; overflow: hidden; border: 1px solid var(--line); border-radius: 4px; background: white; animation: arrive .35s ease both; }
        .item-photo { width: 100%; height: 205px; display: block; object-fit: cover; background: #e7ebe4; }
        .item-content { padding: 15px 16px 16px; }
        .item-meta { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 8px; color: #718078; font-size: 10px; }
        .item-date::before { width: 6px; height: 6px; display: inline-block; margin-right: 6px; border-radius: 50%; background: var(--pink); content: ''; }
        .item-location { max-width: 50%; overflow: hidden; color: var(--blue); text-overflow: ellipsis; white-space: nowrap; }
        .item-card h3 { margin: 0 0 7px; overflow-wrap: anywhere; font-size: 16px; line-height: 1.35; }
        .item-card p { margin: 0; color: #687770; font-size: 12px; line-height: 1.6; overflow-wrap: anywhere; white-space: pre-line; }
        .request-details { margin-top: 15px; border-top: 1px solid var(--line); }
        .request-details summary { padding: 13px 0 2px; color: #a71143; cursor: pointer; font-size: 12px; font-weight: 700; }
        .request-form { display: grid; gap: 10px; padding-top: 12px; }
        .request-form label { display: block; margin-bottom: 5px; color: #37374d; font-size: 11px; font-weight: 700; }
        .request-form textarea { min-height: 78px; resize: vertical; }
        .submit { min-height: 42px; border: 0; border-radius: 3px; background: var(--pink); color: white; font-size: 12px; font-weight: 700; cursor: pointer; }
        .submit:hover { background: #cb1046; }
        .error { margin: 4px 0 0; color: #b44533; font-size: 11px; }
        .empty, .no-results { grid-column: 1 / -1; padding: 34px 20px; border: 1px dashed #d1c5e1; border-radius: 4px; background: #faf8fc; text-align: center; }
        .empty-mark { width: 48px; height: 48px; display: grid; place-items: center; margin: 0 auto 13px; border-radius: 50%; background: #eeeaf5; color: #61458f; font-family: 'DM Serif Display', serif; font-size: 26px; }
        .empty h3 { margin-bottom: 6px; font-family: 'DM Serif Display', Georgia, serif; font-size: 21px; font-weight: 400; }
        .empty p { max-width: 320px; margin: 0 auto; color: var(--muted); font-size: 12px; line-height: 1.55; }
        .no-results { display: none; color: var(--muted); font-size: 13px; }
        footer { padding: 19px 24px; border-top: 1px solid var(--line); color: #839087; text-align: center; font-size: 11px; }
        @keyframes arrive { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 900px) { .items { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 600px) { .topbar { min-height: 64px; padding: 10px 16px; } .brand-name { font-size: 13px; } .brand-caption { font-size: 10px; } .admin-link { padding: 0 9px; font-size: 11px; } main { width: calc(100% - 32px); padding: 28px 0 42px; } .intro { display: block; } h1 { font-size: 34px; } .intro-copy { font-size: 13px; } .total { width: fit-content; margin-top: 15px; } .section-head { align-items: start; flex-direction: column; } .search-wrap { width: 100%; max-width: none; } .items { grid-template-columns: 1fr; } .item-photo { height: 225px; } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('found-items.index') }}" aria-label="Achados, início">
            <span class="brand-mark" aria-hidden="true">A</span>
            <span><span class="brand-name">Achados e Perdidos Bradesco</span><span class="brand-caption">mural da comunidade</span></span>
        </a>
        <a class="admin-link" href="{{ route('admin.found-items.index') }}">Administração</a>
    </header>

    <main>
        <section class="intro" aria-labelledby="page-title">
            <div>
                <p class="eyebrow">Mural de achados</p>
                <h1 id="page-title">Perdeu alguma coisa?<br>Ela pode estar aqui.</h1>
                <p class="intro-copy">Confira os itens encontrados na escola. Se reconhecer algum, envie uma solicitação para a equipe responsável.</p>
            </div>
            <div class="total" aria-label="{{ $items->count() }} itens no mural">
                <strong>{{ str_pad((string) $items->count(), 2, '0', STR_PAD_LEFT) }}</strong>
                <span>{{ $items->count() === 1 ? 'item no mural' : 'itens no mural' }}</span>
            </div>
        </section>

        @if (session('success'))
            <div class="success" role="status">{{ session('success') }}</div>
        @endif

        <section aria-labelledby="items-title">
            <div class="section-head">
                <h2 id="items-title">Itens encontrados</h2>
                <label class="search-wrap" aria-label="Buscar itens">
                    <span aria-hidden="true">⌕</span>
                    <input id="itemSearch" type="search" placeholder="Buscar por nome ou local...">
                </label>
            </div>
            <div class="items" id="itemsList">
                @forelse ($items as $item)
                    <article class="item-card" data-search="{{ strtolower($item->name.' '.$item->description.' '.$item->location) }}">
                        <img class="item-photo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="Foto de {{ $item->name }}" loading="lazy">
                        <div class="item-content">
                            <div class="item-meta">
                                <time class="item-date" datetime="{{ $item->found_at->toDateString() }}">{{ $item->found_at->format('d/m/Y') }}</time>
                                @if ($item->location)<span class="item-location">{{ $item->location }}</span>@endif
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->description }}</p>
                            <details class="request-details">
                                <summary>Solicitar este item</summary>
                                <form class="request-form" action="{{ route('item-requests.store', $item) }}" method="post">
                                    @csrf
                                    <div>
                                        <label for="student_name_{{ $item->id }}">Seu nome</label>
                                        <input id="student_name_{{ $item->id }}" name="student_name" type="text" maxlength="120" value="{{ old('student_name') }}" autocomplete="name" required>
                                        @error('student_name')<p class="error">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="email_{{ $item->id }}">E-mail para contato</label>
                                        <input id="email_{{ $item->id }}" name="email" type="email" maxlength="255" value="{{ old('email') }}" autocomplete="email" required>
                                        @error('email')<p class="error">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label for="message_{{ $item->id }}">Como você reconheceu o item?</label>
                                        <textarea id="message_{{ $item->id }}" name="message" maxlength="1500" required>{{ old('message') }}</textarea>
                                        @error('message')<p class="error">{{ $message }}</p>@enderror
                                    </div>
                                    <button class="submit" type="submit">Enviar solicitação</button>
                                </form>
                            </details>
                        </div>
                    </article>
                @empty
                    <div class="empty" id="emptyState">
                        <div class="empty-mark" aria-hidden="true">?</div>
                        <h3>Nenhum item por aqui ainda</h3>
                        <p>Quando um item encontrado for cadastrado, ele aparecerá neste mural.</p>
                    </div>
                @endforelse
                <div class="no-results" id="noResults">Nenhum item corresponde a essa busca.</div>
            </div>
        </section>
    </main>

    <footer>Achados · pequenos gestos ajudam a encontrar o caminho de volta.</footer>
    <script>
        const itemSearch = document.querySelector('#itemSearch');
        const itemCards = [...document.querySelectorAll('.item-card')];
        const noResults = document.querySelector('#noResults');

        itemSearch.addEventListener('input', () => {
            const query = itemSearch.value.trim().toLocaleLowerCase('pt-BR');
            let visible = 0;

            itemCards.forEach((card) => {
                const matches = card.dataset.search.toLocaleLowerCase('pt-BR').includes(query);
                card.hidden = !matches;
                visible += matches ? 1 : 0;
            });

            noResults.style.display = itemCards.length > 0 && visible === 0 ? 'block' : 'none';
        });
    </script>
</body>
</html>