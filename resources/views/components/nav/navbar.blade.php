<nav class="navbar bg-base-100 shadow px-4">
    <!-- Logo -->
    <div class="flex-1">
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl font-bold text-primary">
            FinAi
        </a>
    </div>

    <!-- Menu desktop -->
    <div class="hidden md:flex gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-ghost">
            Dashboard
        </a>
        <a href="#" class="btn btn-ghost">
            Transações
        </a>
        <a href="#" class="btn btn-ghost">
            Relatórios
        </a>
    </div>

    <!-- Usuário -->
    <div class="flex-none">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </label>

            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-3 z-1 p-2 shadow bg-base-100 rounded-box w-52">
                <li class="menu-title px-4 py-2">
                    {{ auth()->user()->name }}
                </li>
                <li><a>Perfil</a></li>
                <li><a>Configurações</a></li>
                <li class="divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left text-error">
                            Sair
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</nav>
