<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#292a40">
    <title>Minha conta | Achados e Perdidos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #292a40; --muted: #76768a; --paper: #f5f5f8; --line: #e4e4eb; --pink: #f31656; --purple: #61458f; font-family: 'DM Sans', sans-serif; color: var(--ink); background: var(--paper); }
        * { box-sizing: border-box; }
        body { min-width: 320px; min-height: 100vh; margin: 0; background: var(--paper); }
        a, button, input { font: inherit; -webkit-tap-highlight-color: transparent; }
        .topbar { min-height: 70px; display: flex; align-items: center; justify-content: space-between; gap: 18px; padding: 12px max(24px, calc((100vw - 940px) / 2)); background: var(--ink); color: white; }
        .brand { display: flex; align-items: center; gap: 11px; color: white; text-decoration: none; }
        .brand-mark { width: 34px; height: 34px; display: grid; place-items: center; border-radius: 8px; background: var(--pink); font-family: 'DM Serif Display', serif; font-size: 22px; }
        .brand-caption { display: block; margin-top: 2px; color: #c6c6d3; font-size: 11px; }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .nav-link, .logout-button { min-height: 36px; display: inline-flex; align-items: center; padding: 0 10px; border: 1px solid #77788a; border-radius: 3px; background: transparent; color: white; text-decoration: none; font-size: 11px; font-weight: 600; cursor: pointer; }
        .nav-link:hover, .logout-button:hover { border-color: white; background: #ffffff12; }
        main { width: min(760px, calc(100% - 36px)); margin: 0 auto; padding: 46px 0 60px; }
        .eyebrow { margin: 0 0 7px; color: var(--purple); font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        h1, h2, p { margin-top: 0; }
        h1 { margin-bottom: 7px; font-family: 'DM Serif Display', Georgia, serif; font-size: 36px; font-weight: 400; }
        .subtitle { margin-bottom: 24px; color: var(--muted); font-size: 13px; line-height: 1.6; }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 5px; background: white; }
        .panel-head { padding: 19px 22px 15px; border-bottom: 1px solid var(--line); }
        .panel-head h2 { margin: 0 0 5px; font-family: 'DM Serif Display', Georgia, serif; font-size: 22px; font-weight: 400; }
        .panel-head p { margin: 0; color: var(--muted); font-size: 11px; line-height: 1.6; }
        .account-form { display: grid; gap: 17px; padding: 21px 22px 23px; }
        .field label { display: block; margin-bottom: 7px; color: #37374d; font-size: 11px; font-weight: 700; }
        .field input { width: 100%; min-height: 43px; padding: 10px 11px; border: 1px solid #dfe0e7; border-radius: 3px; outline: none; background: white; color: var(--ink); font-size: 12px; }
        .field input:focus { border-color: #8062a9; box-shadow: 0 0 0 3px #61458f20; }
        .field small { display: block; margin-top: 6px; color: #8c909b; font-size: 10px; }
        .error { margin: 5px 0 0; color: #b44533; font-size: 10px; }
        .success, .errors { margin-bottom: 16px; padding: 11px 13px; border-radius: 3px; font-size: 12px; }
        .success { border: 1px solid #b9d1c1; background: #e9f2e9; color: #275b40; }
        .errors { border: 1px solid #e8bec7; background: #fff1f4; color: #9c2145; }
        .submit { min-height: 43px; border: 0; border-radius: 3px; background: var(--pink); color: white; font-size: 12px; font-weight: 700; cursor: pointer; }
        .submit:hover { background: #cb1046; }
        footer { padding: 18px; border-top: 1px solid var(--line); color: #839087; text-align: center; font-size: 10px; }
        @media (max-width: 560px) { .topbar { padding: 11px 16px; flex-wrap: wrap; } .topbar-actions { width: 100%; justify-content: flex-end; gap: 6px; } .nav-link, .logout-button { padding: 0 7px; font-size: 10px; } main { padding-top: 30px; } .account-form, .panel-head { padding-right: 16px; padding-left: 16px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('admin.found-items.index') }}"><span class="brand-mark" aria-hidden="true">A</span><span>Achados e Perdidos<span class="brand-caption">painel de administração</span></span></a>
        <nav class="topbar-actions" aria-label="Navegação administrativa">
            <a class="nav-link" href="{{ route('admin.found-items.index') }}">Voltar aos itens</a>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="logout-button" type="submit">Sair</button>
            </form>
        </nav>
    </header>
    <main>
        <p class="eyebrow">Segurança da conta</p>
        <h1>Minha conta</h1>
        <p class="subtitle">Atualize o login e, se desejar, defina uma nova senha para acessar a administração.</p>
        @if (session('success'))
            <div class="success" role="status">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="errors" role="alert">Confira os dados informados e tente novamente.</div>
        @endif
        <section class="panel" aria-labelledby="account-form-title">
            <div class="panel-head">
                <h2 id="account-form-title">Dados de acesso</h2>
                <p>Por segurança, informe sua senha atual antes de salvar as alterações.</p>
            </div>
            <form class="account-form" action="{{ route('admin.account.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="field">
                    <label for="username">Novo login</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" maxlength="30" autocomplete="username" required>
                    <small>Use letras, números, hífen ou sublinhado.</small>
                    @error('username')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="current_password">Senha atual</label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" required>
                    @error('current_password')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="new_password">Nova senha <span>(opcional)</span></label>
                    <input id="new_password" name="new_password" type="password" autocomplete="new-password" minlength="8">
                    <small>Deixe em branco para manter a senha atual. A nova senha deve ter pelo menos 8 caracteres.</small>
                    @error('new_password')<p class="error">{{ $message }}</p>@enderror
                </div>
                <div class="field">
                    <label for="new_password_confirmation">Confirme a nova senha</label>
                    <input id="new_password_confirmation" name="new_password_confirmation" type="password" autocomplete="new-password" minlength="8">
                </div>
                <button class="submit" type="submit">Salvar dados de acesso</button>
            </form>
        </section>
    </main>
    <footer>Área de administração · Achados e Perdidos</footer>
</body>
</html>
