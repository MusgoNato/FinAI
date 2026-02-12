<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage()
const user = page.props.auth.user
</script>

<template>
  <nav class="navbar bg-base-100 border-b border-base-200 px-6">
    <!-- Logo -->
    <div class="flex-1">
      <Link
        href="/dashboard"
        class="text-lg font-semibold text-primary tracking-tight"
      >
        FinAI
      </Link>
    </div>

    <!-- Menu desktop -->
    <div class="hidden md:flex items-center gap-1">
      <Link href="/dashboard" class="btn btn-ghost btn-sm">
        Dashboard
      </Link>

      <Link href="/transactions" class="btn btn-ghost btn-sm">
        Transações
      </Link>

      <span class="btn btn-ghost btn-sm cursor-not-allowed">
        <del>Relatórios</del>
      </span>
    </div>

    <!-- Usuário -->
    <div class="flex-none ml-4">
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-sm btn-circle avatar">
          <div class="w-9 rounded-full">
            <img :src="user.profile_image_url" alt="Profile Image" />
          </div>
        </label>

        <ul
          tabindex="0"
          class="dropdown-content z-10 mt-3 w-48 rounded-box bg-base-100 shadow-md border border-base-200"
        >
          <li class="px-4 py-2 text-sm font-medium">
            {{ user.name }}
          </li>

          <div class="divider my-0"></div>

          <li>
            <Link
              href="/profile"
              class="block px-4 py-2 hover:bg-base-200 text-sm"
            >
              Perfil
            </Link>
          </li>

          <li>
            <span class="block px-4 py-2 text-sm text-gray-400">
              <del>Configurações</del>
            </span>
          </li>

          <div class="divider my-0"></div>

          <li>
            <Link
              href="/logout"
              method="post"
              as="button"
              class="btn btn-error w-full justify-start px-4 py-2 text-sm"
            >
              Sair
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
