<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administração | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --line: #e4e4eb; --pink: #f31656; --blue: #2879a7; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        a, button, input, textarea { font: inherit; -webkit-tap-highlight-color: transparent; }
        .topbar { min-height: 70px; display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 12px max(28px, calc((100vw - 1240px) / 2)); background: var(--ink); color: white; }
        .brand { display: flex; align-items: center; gap: 11px; color: white; text-decoration: none; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 8px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 22px; }
        .brand-name { display: block; font-size: 14px; font-weight: 700; }
        .brand-caption { display: block; margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .board-link { min-height: 38px; display: inline-flex; align-items: center; padding: 0 12px; border: 1px solid #77788a; border-radius: 3px; color: white; text-decoration: none; font-size: 12px; font-weight: 600; }
        main { width: min(1240px, calc(100% - 56px)); margin: 0 auto; padding: 36px 0 60px; }
        .page-head { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin-bottom: 24px; }
        .eyebrow { margin: 0 0 7px; color: #61458f; font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1 { margin-bottom: 5px; font-family: 'DM Serif Display', Georgia, serif; font-size: 36px; font-weight: 400; }
        .subtitle { margin: 0; color: var(--muted); font-size: 13px; }
        .metrics { display: flex; gap: 10px; }
        .metric { min-width: 122px; padding: 10px 13px; border: 1px solid #dedee7; border-radius: 4px; background: white; }
        .metric strong { display: block; font-family: 'DM Serif Display', Georgia, serif; font-size: 22px; font-weight: 400; }
        .metric span { color: var(--muted); font-size: 10px; }
        .success { margin-bottom: 18px; padding: 11px 14px; border: 1px solid #b9d1c1; border-radius: 3px; background: #e9f2e9; color: #275b40; font-size: 13px; }
        .errors { margin-bottom: 18px; padding: 11px 14px; border: 1px solid #e8bec7; border-radius: 3px; background: #fff1f4; color: #9c2145; font-size: 12px; }
        .workspace { display: grid; grid-template-columns: minmax(275px, 340px) minmax(0, 1fr); align-items: start; gap: 24px; }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 4px; background: white; }
        .panel-head { padding: 18px 19px 15px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { margin: 0 0 4px; font-family: 'DM Serif Display', Georgia, serif; font-size: 22px; font-weight: 400; }
        .panel-head p { margin: 0; color: var(--muted); font-size: 11px; line-height: 1.5; }
        .item-form { display: grid; gap: 14px; padding: 17px 19px 20px; }
        .field { min-width: 0; }
        label { display: block; margin-bottom: 6px; color: #37374d; font-size: 11px; font-weight: 700; }
        .optional, .field small { color: #8c909b; font-size: 10px; font-weight: 400; }
        input, textarea { width: 100%; min-height: 40px; padding: 9px 10px; border: 1px solid #dfe3dd; border-radius: 3px; outline: none; background: white; color: var(--ink); font-size: 12px; }
        input:focus, textarea:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        textarea { min-height: 88px; resize: vertical; line-height: 1.5; }
        input[type=file] { min-height: 44px; padding: 8px; }
        .field small { display: block; margin-top: 5px; }
        .two-fields { display: grid; grid-template-columns: 1fr; gap: 12px; }
        .error { margin: 4px 0 0; color: #b44533; font-size: 10px; }
        .primary-button { min-height: 43px; border: 0; border-radius: 3px; background: var(--pink); color: white; font-size: 12px; font-weight: 700; cursor: pointer; }
        .primary-button:hover { background: #cb1046; }
        .items-head { display: flex; align-items: end; justify-content: space-between; gap: 16px; margin: 0 0 13px; }
        .items-head h2 { margin: 0; font-family: 'DM Serif Display', Georgia, serif; font-size: 25px; font-weight: 400; }
        .items-head span { color: var(--muted); font-size: 11px; }
        .item-list { display: grid; gap: 12px; }
        .item-row { display: grid; grid-template-columns: 112px minmax(0, 1fr); overflow: hidden; border: 1px solid var(--line); border-radius: 4px; background: white; }
        .item-photo { width: 112px; height: 100%; min-height: 150px; object-fit: cover; background: #e7ebe4; }
        .item-main { min-width: 0; padding: 13px 15px; }
        .item-topline { display: flex; align-items: start; justify-content: space-between; gap: 12px; }
        .item-topline h3 { margin: 0 0 4px; overflow-wrap: anywhere; font-size: 14px; }
        .item-main p { margin: 0 0 8px; color: #687770; font-size: 11px; line-height: 1.5; white-space: pre-line; }
        .item-meta { margin-bottom: 8px !important; color: var(--blue) !important; font-size: 10px !important; }
        .actions { display: flex; flex: 0 0 auto; gap: 7px; }
        .edit-link, .delete-button { min-height: 31px; display: inline-flex; align-items: center; justify-content: center; padding: 0 9px; border: 1px solid #d9d9e2; border-radius: 3px; background: white; color: var(--ink); text-decoration: none; font-size: 10px; font-weight: 700; cursor: pointer; }
        .edit-link:hover { border-color: #61458f; color: #61458f; }
        .delete-button { border-color: #f0bacb; color: #b70d41; }
        .delete-button:hover { background: #fff4f7; }
        .request-list { margin-top: 11px; border-top: 1px solid var(--line); }
        .request-list summary { padding: 10px 0 0; color: #4e3677; cursor: pointer; font-size: 11px; font-weight: 700; }
        .request-entry { margin-top: 9px; padding: 9px 10px; border-left: 2px solid #338ec4; background: #f6f9fa; }
        .request-entry strong { display: block; font-size: 11px; }
        .request-entry a { color: #2879a7; font-size: 10px; }
        .request-entry p { margin: 5px 0 0; color: #5b6270; overflow-wrap: anywhere; }
        .request-entry time { display: block; margin-top: 5px; color: #8b8c96; font-size: 9px; }
        .no-requests { padding: 10px 0 0; color: var(--muted) !important; font-size: 10px !important; }
        .empty { padding: 34px 18px; border: 1px dashed #d1c5e1; border-radius: 4px; background: #faf8fc; text-align: center; }
        .empty h3 { margin-bottom: 6px; font-family: 'DM Serif Display', Georgia, serif; font-size: 20px; font-weight: 400; }
        .empty p { margin: 0; color: var(--muted); font-size: 11px; }
        .pagination { margin-top: 16px; }
        .pagination nav { display: flex; justify-content: center; }
        footer { padding: 18px; border-top: 1px solid var(--line); color: #839087; text-align: center; font-size: 10px; }
        @media (min-width: 980px) { .two-fields { grid-template-columns: 1fr 1fr; } .form-panel { position: sticky; top: 16px; } }
        @media (max-width: 720px) { .topbar { padding: 11px 16px; } main { width: calc(100% - 32px); padding-top: 26px; } .page-head { align-items: start; flex-direction: column; } .metrics { width: 100%; } .metric { flex: 1; } .workspace { grid-template-columns: 1fr; } .form-panel { position: static; } }
        @media (max-width: 480px) { .item-row { grid-template-columns: 82px minmax(0, 1fr); } .item-photo { width: 82px; min-height: 130px; } .item-topline { flex-direction: column; } .actions { width: 100%; } .edit-link, .delete-button { flex: 1; } h1 { font-size: 31px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('admin.found-items.index') }}">
            <span class="brand-mark" aria-hidden="true">A</span>
            <span><span class="brand-name">Achados e Perdidos Bradesco</span><span class="brand-caption">painel de administração</span></span>
        </a>
        <a class="board-link" href="{{ route('found-items.index') }}">Ver mural dos alunos</a>
    </header>

    <main>
        <section class="page-head">
            <div>
                <p class="eyebrow">Gestão dos achados</p>
                <h1>Administração</h1>
                <p class="subtitle">Cadastre itens encontrados e acompanhe as solicitações dos alunos.</p>
            </div>
            <div class="metrics" aria-label="Resumo do mural">
                <div class="metric"><strong>{{ $items->total() }}</strong><span>itens cadastrados</span></div>
                <div class="metric"><strong>{{ $requestCount }}</strong><span>solicitações recebidas</span></div>
            </div>
        </section>

        @if (session('success'))
            <div class="success" role="status">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="errors" role="alert">Revise os campos destacados no formulário.</div>
        @endif

        <div class="workspace">
            <section class="panel form-panel" aria-labelledby="form-title">
                <div class="panel-head">
                    <h2 id="form-title">Adicionar item</h2>
                    <p>Inclua uma foto e os detalhes que ajudam o aluno a reconhecer o objeto.</p>
                </div>
                @include('found-items.admin._form', ['item' => null])
            </section>

            <section aria-labelledby="items-title">
                <div class="items-head">
                    <h2 id="items-title">Itens cadastrados</h2>
                    <span>{{ $items->count() }} nesta página</span>
                </div>
                <div class="item-list">
                    @forelse ($items as $item)
                        <article class="item-row">
                            <img class="item-photo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}" alt="Foto de {{ $item->name }}" loading="lazy">
                            <div class="item-main">
                                <div class="item-topline">
                                    <div>
                                        <h3>{{ $item->name }}</h3>
                                        <p class="item-meta">{{ $item->found_at->format('d/m/Y') }}@if ($item->location) · {{ $item->location }}@endif</p>
                                    </div>
                                    <div class="actions">
                                        <a class="edit-link" href="{{ route('admin.found-items.edit', $item) }}">Editar</a>
                                        <form action="{{ route('admin.found-items.destroy', $item) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir este item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-button" type="submit">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                                <p>{{ $item->description }}</p>
                                <details class="request-list">
                                    <summary>{{ $item->itemRequests->count() }} solicitações</summary>
                                    @forelse ($item->itemRequests as $itemRequest)
                                        <div class="request-entry">
                                            <strong>{{ $itemRequest->student_name }}</strong>
                                            <a href="mailto:{{ $itemRequest->email }}">{{ $itemRequest->email }}</a>
                                            <p>{{ $itemRequest->message }}</p>
                                            <time datetime="{{ $itemRequest->created_at->toDateString() }}">Recebida em {{ $itemRequest->created_at->format('d/m/Y H:i') }}</time>
                                        </div>
                                    @empty
                                        <p class="no-requests">Ainda não há solicitações para este item.</p>
                                    @endforelse
                                </details>
                            </div>
                        </article>
                    @empty
                        <div class="empty">
                            <h3>Nenhum item cadastrado</h3>
                            <p>Use o formulário para publicar o primeiro achado no mural.</p>
                        </div>
                    @endforelse
                </div>
                @if ($items->hasPages())
                    <div class="pagination">{{ $items->links() }}</div>
                @endif
            </section>
        </div>
    </main>
    <footer>Área de administração · Achados e Perdidos</footer>
</body>
</html>