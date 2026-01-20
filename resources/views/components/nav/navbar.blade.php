<nav class="navbar bg-base-100 border-b border-base-200 px-6">
    <!-- Logo -->
    <div class="flex-1">
        <a href="{{ route('dashboard') }}"
           class="text-lg font-semibold text-primary tracking-tight">
            FinAi
        </a>
    </div>

    <!-- Menu desktop -->
    <div class="hidden md:flex items-center gap-1">
        <a href="{{ route('dashboard') }}"
           class="btn btn-ghost btn-sm">
            Dashboard
        </a>

        <a href="{{ route('transactions.index') }}"
           class="btn btn-ghost btn-sm">
            Transações
        </a>

        <a href="#"
           class="btn btn-ghost btn-sm">
            Relatórios
        </a>
    </div>

    <!-- Usuário -->
    <div class="flex-none ml-4">
        <div class="dropdown dropdown-end">
            <label tabindex="0"
                   class="btn btn-ghost btn-sm btn-circle avatar">
                <div
                    class="w-9 rounded-full bg-primary text-primary-content flex items-center justify-center font-medium">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </label>

            <ul tabindex="0"
                class="dropdown-content z-1 mt-3 w-48 rounded-box bg-base-100 shadow-md border border-base-200">
                
                <li class="px-4 py-2 text-sm font-medium text-base-content">
                    {{ auth()->user()->name }}
                </li>

                <div class="divider my-0"></div>

                <li>
                    <a class="block w-full px-4 py-2 hover:bg-base-200 text-sm" href="#">
                        Perfil
                    </a>
                </li>

                <li>
                    <a class="block w-full px-4 py-2 hover:bg-base-200 text-sm" href="#">
                        Configurações
                    </a>
                </li>

                <div class="divider my-0"></div>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-error w-full justify-start px-4 py-2 text-sm">
                            Sair
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
