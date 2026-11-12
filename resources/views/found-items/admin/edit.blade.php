<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar item | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --line: #e4e4eb; --pink: #f31656; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; background: var(--paper); }
        a, button, input, textarea { font: inherit; -webkit-tap-highlight-color: transparent; }
        .topbar { min-height: 70px; display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 12px max(24px, calc((100vw - 940px) / 2)); background: var(--ink); color: white; }
        .brand { display: flex; align-items: center; gap: 11px; color: white; text-decoration: none; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 8px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 22px; }
        .brand-caption { display: block; margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .back-link { color: white; font-size: 12px; text-decoration: none; }
        .topbar-actions { display: flex; align-items: center; gap: 14px; }
        .account-link, .logout-button { min-height: 36px; display: inline-flex; align-items: center; padding: 0 10px; border: 1px solid #77788a; border-radius: 3px; background: transparent; color: white; text-decoration: none; font-size: 11px; font-weight: 600; cursor: pointer; }
        .logout-button:hover, .account-link:hover { border-color: white; background: #ffffff12; }
        main { width: min(760px, calc(100% - 36px)); margin: 0 auto; padding: 36px 0 56px; }
        .eyebrow { margin-bottom: 7px; color: #61458f; font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1 { margin: 0 0 5px; font-family: 'DM Serif Display', Georgia, serif; font-size: 34px; font-weight: 400; }
        .subtitle { margin: 0 0 22px; color: var(--muted); font-size: 13px; }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 4px; background: white; }
        .panel-head { padding: 18px 20px 15px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { margin: 0; font-family: 'DM Serif Display', Georgia, serif; font-size: 22px; font-weight: 400; }
        .item-form { display: grid; gap: 15px; padding: 20px; }
        .field label { display: block; margin-bottom: 6px; color: #37374d; font-size: 11px; font-weight: 700; }
        .optional, .field small { color: #8c909b; font-size: 10px; font-weight: 400; }
        input, textarea { width: 100%; min-height: 42px; padding: 10px 11px; border: 1px solid #dfe3dd; border-radius: 3px; outline: none; background: white; color: var(--ink); font-size: 12px; }
        input:focus, textarea:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        textarea { min-height: 100px; resize: vertical; line-height: 1.5; }
        input[type=file] { min-height: 44px; padding: 8px; }
        .field small { display: block; margin-top: 5px; }
        .two-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .error { margin: 4px 0 0; color: #b44533; font-size: 10px; }
        .current-photo { display: flex; align-items: center; gap: 12px; color: var(--muted); font-size: 11px; }
        .current-photo img { width: 84px; height: 64px; border-radius: 3px; object-fit: cover; }
        .actions { display: flex; justify-content: flex-end; gap: 9px; margin-top: 3px; }
        .button { min-height: 42px; display: inline-flex; align-items: center; justify-content: center; padding: 0 14px; border: 1px solid #d9d9e2; border-radius: 3px; background: white; color: var(--ink); text-decoration: none; font-size: 11px; font-weight: 700; cursor: pointer; }
        .button-primary { border-color: var(--pink); background: var(--pink); color: white; }
        @media (max-width: 560px) { .topbar { padding: 11px 16px; flex-wrap: wrap; } .topbar-actions { width: 100%; justify-content: flex-end; gap: 9px; } main { padding-top: 26px; } .two-fields { grid-template-columns: 1fr; } .item-form { padding: 16px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('admin.found-items.index') }}"><span class="brand-mark" aria-hidden="true">A</span><span>Achados e Perdidos<span class="brand-caption">painel de administração</span></span></a>
        <nav class="topbar-actions" aria-label="Navegação administrativa">
            <a class="account-link" href="{{ route('admin.account.edit') }}">Minha conta</a>
            <a class="back-link" href="{{ route('admin.found-items.index') }}">Voltar aos itens</a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="logout-button" type="submit">Sair</button>
            </form>
        </nav>
    </header>
    <main>
        <p class="eyebrow">Gestão dos achados</p>
        <h1>Editar item</h1>
        <p class="subtitle">Atualize os dados de “{{ $item->name }}”.</p>
        @if ($errors->any())
            <div class="error" role="alert">Revise os campos destacados abaixo.</div>
        @endif
        <section class="panel" aria-labelledby="form-title">
            <div class="panel-head"><h2 id="form-title">Detalhes do item</h2></div>
            @include('found-items.admin._form', ['item' => $item])
        </section>
    </main>
</body>
</html>