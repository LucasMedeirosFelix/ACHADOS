<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#292a40">
    <title>Achados e Perdidos Bradesco | Central de itens encontrados</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --ink: #292a40;
            --muted: #76768a;
            --paper: #f5f5f8;
            --white: #ffffff;
            --line: #e4e4eb;
            --brand-purple: #61458f;
            --brand-purple-dark: #4e3677;
            --brand-pink: #f31656;
            --brand-blue: #338ec4;
            --lavender: #eeeaf5;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--paper);
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        button, input, textarea { font: inherit; }
        button, a, input, textarea { -webkit-tap-highlight-color: transparent; }
        .topbar { height: 74px; display: flex; align-items: center; justify-content: space-between; padding: 0 max(28px, calc((100vw - 1280px) / 2)); background: var(--ink); border-bottom: 1px solid #3b3c51; }
        .brand { display: flex; align-items: center; gap: 11px; color: #ffffff; text-decoration: none; }
        .brand-mark { width: 35px; height: 35px; display: grid; place-items: center; border-radius: 11px; background: var(--brand-pink); color: white; font-family: 'DM Serif Display', serif; font-size: 23px; line-height: 1; }
        .brand-name { font-size: 15px; font-weight: 700; letter-spacing: 0; }
        .brand-caption { margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .top-label { color: #d3d3de; font-size: 12px; }
        main { width: min(1280px, calc(100% - 56px)); margin: 0 auto; padding: 42px 0 64px; }
        .intro { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 28px; }
        .eyebrow { margin: 0 0 9px; color: var(--brand-purple); font-size: 11px; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; }
        h1, h2, p { margin-top: 0; }
        h1 { margin-bottom: 8px; font-family: 'DM Serif Display', Georgia, serif; font-size: 42px; font-weight: 400; line-height: 1.08; letter-spacing: 0; }
        .intro-copy { max-width: 570px; margin-bottom: 0; color: var(--muted); font-size: 14px; line-height: 1.65; }
        .total { flex: 0 0 auto; display: flex; align-items: baseline; gap: 9px; padding: 12px 16px; border: 1px solid #d7cce8; border-radius: 4px; background: var(--lavender); }
        .total strong { color: var(--brand-purple-dark); font-family: 'DM Serif Display', Georgia, serif; font-size: 24px; font-weight: 400; }
        .total span { color: #5c526f; font-size: 12px; }
        .layout { display: grid; grid-template-columns: minmax(290px, 370px) minmax(0, 1fr); align-items: start; gap: 30px; }
        .form-panel { position: sticky; top: 20px; overflow: hidden; border: 1px solid var(--line); border-radius: 5px; background: var(--white); }
        .form-heading { padding: 22px 23px 18px; border-bottom: 1px solid var(--line); }
        .form-heading h2 { margin: 0 0 5px; font-family: 'DM Serif Display', Georgia, serif; font-size: 23px; font-weight: 400; letter-spacing: 0; }
        .form-heading p { margin: 0; color: var(--muted); font-size: 12px; line-height: 1.5; }
        form { padding: 20px 23px 23px; }
        .field { margin-bottom: 17px; }
        label, .field-label { display: block; margin-bottom: 7px; color: #37374d; font-size: 12px; font-weight: 700; }
        .optional { color: #9aa39d; font-weight: 500; }
        input[type=text], input[type=date], textarea, input[type=search] { width: 100%; min-height: 43px; padding: 10px 12px; border: 1px solid #dfe3dd; border-radius: 3px; outline: none; background: #fff; color: var(--ink); font-size: 13px; transition: border-color .16s, box-shadow .16s; }
        textarea { min-height: 95px; resize: vertical; line-height: 1.5; }
        input:focus, textarea:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        input::placeholder, textarea::placeholder { color: #a4ada7; }
        .two-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .upload { position: relative; display: grid; min-height: 104px; place-items: center; overflow: hidden; border: 1px dashed #c1b4d6; border-radius: 3px; background: #faf8fd; cursor: pointer; }
        .upload:hover { border-color: var(--brand-purple); background: #f5f0fa; }
        .upload input { position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .upload-prompt { padding: 14px; text-align: center; pointer-events: none; }
        .upload-icon { width: 27px; height: 27px; display: grid; place-items: center; margin: 0 auto 7px; border-radius: 50%; background: #ffebf1; color: var(--brand-pink); font-size: 17px; }
        .upload-prompt strong { display: block; color: #493663; font-size: 12px; }
        .upload-prompt small { display: block; margin-top: 4px; color: #858294; font-size: 10px; }
        .upload-preview { display: none; width: 100%; height: 180px; object-fit: cover; }
        .upload.has-preview .upload-preview { display: block; }
        .upload.has-preview .upload-prompt { position: absolute; right: 8px; bottom: 8px; padding: 7px 10px; border-radius: 2px; background: #fffefaeb; }
        .upload.has-preview .upload-icon, .upload.has-preview .upload-prompt small { display: none; }
        .upload.has-preview .upload-prompt strong { font-size: 10px; }
        .error { margin: 5px 0 0; color: #b44533; font-size: 11px; }
        .success { margin-bottom: 22px; padding: 12px 15px; border: 1px solid #b9d1c1; border-radius: 3px; background: #e9f2e9; color: #275b40; font-size: 13px; }
        .submit { width: 100%; min-height: 46px; display: flex; align-items: center; justify-content: center; gap: 9px; border: 0; border-radius: 3px; background: var(--brand-pink); color: white; font-size: 13px; font-weight: 700; cursor: pointer; transition: background .16s, transform .16s; }
        .submit:hover { transform: translateY(-1px); background: #cb1046; }
        .submit:focus-visible { outline: 3px solid var(--brand-blue); outline-offset: 3px; }
        .list-head { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin: 2px 0 17px; }
        .list-head h2 { margin: 0; font-family: 'DM Serif Display', Georgia, serif; font-size: 26px; font-weight: 400; letter-spacing: 0; }
        .search { max-width: 250px; }
        .search input { min-height: 40px; padding-left: 35px; background: #fffefa; }
        .search-wrap { position: relative; width: min(100%, 250px); }
        .search-wrap span { position: absolute; top: 10px; left: 12px; color: var(--brand-purple); font-size: 15px; }
        .items { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .item-card { min-width: 0; overflow: hidden; border: 1px solid var(--line); border-radius: 4px; background: var(--white); animation: arrive .35s ease both; }
        .item-photo { width: 100%; height: 205px; display: block; object-fit: cover; background: #e7ebe4; }
        .item-content { padding: 15px 16px 17px; }
        .item-meta { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 8px; color: #718078; font-size: 10px; }
        .item-date { display: inline-flex; align-items: center; gap: 6px; }
        .item-date::before { width: 6px; height: 6px; border-radius: 50%; background: var(--brand-pink); content: ''; }
        .item-location { max-width: 50%; overflow: hidden; color: #2879a7; text-overflow: ellipsis; white-space: nowrap; }
        .item-card h3 { margin: 0 0 7px; overflow-wrap: anywhere; font-size: 16px; font-weight: 700; line-height: 1.35; letter-spacing: 0; }
        .item-card p { margin: 0; color: #687770; font-size: 12px; line-height: 1.6; overflow-wrap: anywhere; white-space: pre-line; }
        .delete-form { display: flex; justify-content: flex-end; margin-top: 14px; }
        .delete-button { min-height: 34px; display: inline-flex; align-items: center; gap: 6px; padding: 0 9px; border: 1px solid #f0bacb; border-radius: 3px; background: #ffffff; color: #b70d41; font-size: 11px; font-weight: 700; cursor: pointer; }
        .delete-button:hover { border-color: #df7192; background: #fff4f7; }
        .empty { grid-column: 1 / -1; min-height: 270px; display: grid; place-items: center; padding: 30px; border: 1px dashed #d1c5e1; border-radius: 4px; background: #faf8fc; text-align: center; }
        .empty-mark { width: 54px; height: 54px; display: grid; place-items: center; margin: 0 auto 14px; border-radius: 50%; background: var(--lavender); color: var(--brand-purple); font-family: 'DM Serif Display', serif; font-size: 29px; }
        .empty h3 { margin: 0 0 6px; font-family: 'DM Serif Display', Georgia, serif; font-size: 21px; font-weight: 400; }
        .empty p { max-width: 280px; margin: 0; color: var(--muted); font-size: 12px; line-height: 1.55; }
        .no-results { display: none; grid-column: 1 / -1; padding: 28px; color: var(--muted); text-align: center; font-size: 13px; }
        footer { padding: 19px 28px; border-top: 1px solid var(--line); color: #839087; text-align: center; font-size: 11px; }
        @keyframes arrive { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 850px) {
            main { width: min(100% - 36px, 720px); padding-top: 32px; }
            .layout { grid-template-columns: 1fr; gap: 32px; }
            .form-panel { position: static; }
            .intro { align-items: start; }
        }
        @media (max-width: 560px) {
            .topbar { height: 64px; padding: 0 18px; }
            .top-label { font-size: 10px; }
            main { width: calc(100% - 32px); padding: 27px 0 42px; }
            .intro { display: block; }
            h1 { font-size: 34px; }
            .intro-copy { font-size: 13px; }
            .total { width: fit-content; margin-top: 15px; }
            .form-heading, form { padding-right: 17px; padding-left: 17px; }
            .items { grid-template-columns: 1fr; }
            .item-photo { height: 225px; }
            .list-head { align-items: start; flex-direction: column; gap: 12px; }
            .search-wrap { width: 100%; max-width: none; }
            footer { padding-right: 16px; padding-left: 16px; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('found-items.index') }}" aria-label="Achados, início">
            <span class="brand-mark" aria-hidden="true">A</span>
            <span><span class="brand-name">Achados e Perdidos Bradesco</span><span class="brand-caption" style="display:block">central de itens encontrados</span></span>
        </a>
        <span class="top-label">Uma comunidade que cuida</span>
    </header>

    <main>
        <section class="intro" aria-labelledby="page-title">
            <div>
                <p class="eyebrow">Registro da comunidade</p>
                <h1 id="page-title">Encontrou algo?<br>Vamos devolver.</h1>
                <p class="intro-copy">Registre o item, conte onde ele apareceu e deixe as informações visíveis para quem está procurando.</p>
            </div>
            <div class="total" aria-label="{{ $items->count() }} itens cadastrados">
                <strong>{{ str_pad((string) $items->count(), 2, '0', STR_PAD_LEFT) }}</strong>
                <span>{{ $items->count() === 1 ? 'item registrado' : 'itens registrados' }}</span>
            </div>
        </section>

        @if (session('success'))
            <div class="success" role="status">{{ session('success') }}</div>
        @endif

        <div class="layout">
            <section class="form-panel" aria-labelledby="form-title">
                <div class="form-heading">
                    <h2 id="form-title">Novo item encontrado</h2>
                    <p>Preencha os detalhes para ajudar a pessoa certa a reconhecê-lo.</p>
                </div>
                <form action="{{ route('found-items.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="field">
                        <label for="name">O que foi encontrado?</label>
                        <input id="name" name="name" type="text" maxlength="120" value="{{ old('name') }}" placeholder="Ex.: chaveiro azul com duas chaves" required>
                        @error('name')<p class="error">{{ $message }}</p>@enderror
                    </div>
                    <div class="field">
                        <label for="description">Como o item foi encontrado?</label>
                        <textarea id="description" name="description" maxlength="2000" placeholder="Conte o que pode ajudar a identificar o item..." required>{{ old('description') }}</textarea>
                        @error('description')<p class="error">{{ $message }}</p>@enderror
                    </div>
                    <div class="two-fields">
                        <div class="field">
                            <label for="found_at">Dia em que encontrou</label>
                            <input id="found_at" name="found_at" type="date" max="{{ now()->toDateString() }}" value="{{ old('found_at', now()->toDateString()) }}" required>
                            @error('found_at')<p class="error">{{ $message }}</p>@enderror
                        </div>
                        <div class="field">
                            <label for="location">Onde? <span class="optional">(opcional)</span></label>
                            <input id="location" name="location" type="text" maxlength="160" value="{{ old('location') }}" placeholder="Ex.: biblioteca">
                            @error('location')<p class="error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="field">
                        <span class="field-label">Foto do item</span>
                        <label class="upload" id="uploadBox" for="photo">
                            <img class="upload-preview" id="photoPreview" alt="Prévia da foto selecionada">
                            <span class="upload-prompt">
                                <span class="upload-icon" aria-hidden="true">+</span>
                                <strong id="uploadLabel">Tirar foto ou escolher imagem</strong>
                                <small>JPG, PNG ou WEBP · até 5 MB</small>
                            </span>
                            <input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" capture="environment" required>
                        </label>
                        @error('photo')<p class="error">{{ $message }}</p>@enderror
                    </div>
                    <button class="submit" type="submit"><span aria-hidden="true">+</span> Cadastrar item</button>
                </form>
            </section>

            <section aria-labelledby="items-title">
                <div class="list-head">
                    <h2 id="items-title">Itens recentes</h2>
                    <label class="search-wrap" aria-label="Buscar itens">
                        <span aria-hidden="true">⌕</span>
                        <input class="search" id="itemSearch" type="search" placeholder="Buscar por nome ou local...">
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
                                <form class="delete-form" action="{{ route('found-items.destroy', $item) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-button" type="submit"><span aria-hidden="true">×</span> Excluir item</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="empty" id="emptyState">
                            <div>
                                <div class="empty-mark" aria-hidden="true">?</div>
                                <h3>Nenhum item por aqui ainda</h3>
                                <p>Quando alguém registrar um item encontrado, ele aparecerá nesta lista.</p>
                            </div>
                        </div>
                    @endforelse
                    <div class="no-results" id="noResults">Nenhum item corresponde a essa busca.</div>
                </div>
            </section>
        </div>
    </main>

    <footer>Achados · pequenos gestos ajudam a encontrar o caminho de volta.</footer>
    <script>
        const photoInput = document.querySelector('#photo');
        const photoPreview = document.querySelector('#photoPreview');
        const uploadBox = document.querySelector('#uploadBox');
        const uploadLabel = document.querySelector('#uploadLabel');
        const itemSearch = document.querySelector('#itemSearch');
        const itemCards = [...document.querySelectorAll('.item-card')];
        const noResults = document.querySelector('#noResults');

        photoInput.addEventListener('change', () => {
            const [file] = photoInput.files;
            if (!file) return;

            photoPreview.src = URL.createObjectURL(file);
            uploadBox.classList.add('has-preview');
            uploadLabel.textContent = file.name;
        });

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