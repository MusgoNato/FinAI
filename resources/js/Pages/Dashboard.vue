<!-- resources/js/Pages/Dashboard.vue -->
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

const page = usePage()
const user = page.props.auth.user
const total_balance = page.props.total_balance
const total_by_type = page.props.total_by_type
const last_transactions = page.props.last_transactions
const ai_insight = page.props.ai_insight;
const currencyFormatter = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
});

const _last_transactions = ref([...last_transactions]);
const _total_balance = ref(total_balance);
const _total_by_type = ref(total_by_type);
const _ai_insight = ref(ai_insight);
// Saldo total formatado
const formattedBalance = computed(() => {
  return currencyFormatter.format(_total_balance.value);
});

const formattedTotalByTypes = computed(() => {
  const result = {}

  for (const key in _total_by_type.value) {
    result[key] = currencyFormatter.format(
      _total_by_type.value[key] ?? 0
    )
  }

  return result
});

// Para formatações
const formatCurrency = (value) =>
  currencyFormatter.format(value ?? 0)

const successMessage = computed(() => page.props.flash?.success ?? '');

// Delete transaction
const onDeleteTransaction = (id) => {
  if (!confirm('Deseja realmente excluir esta transação?')) return

  router.delete(route('transactions.destroy', id), {
    preserveScroll: true,
    preserveState: false,
    onSuccess: () => {
      _last_transactions.value = _last_transactions.value.filter(t => t.id !== id)
    },
  });
}


const renderedInsight = computed(() => {
  if (!_ai_insight.value) return ''

  const rawHtml = marked.parse(_ai_insight.value)
  return DOMPurify.sanitize(rawHtml)
});

</script>

<template>
  <AppLayout title="Dashboard">
    <!-- Success Toast -->
    <div
      v-if="successMessage"
      class="toast toast-top toast-center z-50"
    >
      <div class="alert alert-success shadow-xl fade-out">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="stroke-current shrink-0 h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
          />
        </svg>
        <span>{{ successMessage }}</span>
      </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-7xl">
      <!-- Header -->
      <div class="mb-10">
        <h1 class="text-4xl md:text-5xl font-bold bg-linear-to-r from-primary to-primary-focus bg-clip-text text-transparent">
          Olá, {{ user.name }}
        </h1>
        <p class="text-base-content/70 mt-2">Aqui está o resumo financeiro atual</p>
      </div>

      <!-- Cards de resumo -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <div class="stats shadow-xl border border-base-300/50 bg-base-100/80 backdrop-blur-sm">
          <div class="stat place-items-center">
            <div class="stat-title text-base-content/70">Saldo Atual</div>
            <div class="stat-value text-3xl lg:text-4xl font-extrabold text-success">
              {{ formattedBalance }}
            </div>
          </div>
        </div>

        <div class="stats shadow-xl border border-base-300/50 bg-base-100/80 backdrop-blur-sm">
          <div class="stat place-items-center">
            <div class="stat-title text-base-content/70">Receitas</div>
            <div class="stat-value text-3xl lg:text-4xl font-extrabold text-primary">
              {{ formattedTotalByTypes?.Receita || 'R$ 0,00' }}
            </div>
          </div>
        </div>

        <div class="stats shadow-xl border border-base-300/50 bg-base-100/80 backdrop-blur-sm">
          <div class="stat place-items-center">
            <div class="stat-title text-base-content/70">Despesas</div>
            <div class="stat-value text-3xl lg:text-4xl font-extrabold text-error">
              {{ formattedTotalByTypes?.Despesa || 'R$ 0,00' }}
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Últimas Transações -->
        <div class="lg:col-span-2 card bg-base-100 shadow-2xl border border-base-200">
          <div class="card-body p-6 lg:p-8">
            <div class="flex items-center justify-between mb-6">
              <h2 class="card-title text-2xl">Últimas Transações</h2>
              <Link
                :href="route('transactions.create')"
                class="btn btn-primary btn-sm gap-2"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                  />
                </svg>
                Nova
              </Link>
            </div>

            <!-- DESKTOP TABLE -->
            <div class="hidden md:block overflow-x-auto">
            <table class="table table-zebra table-hover">
                <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th class="w-24 text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="t in _last_transactions" :key="t.id">
                    <td class="font-medium">{{ t.description }}</td>
                    <td>
                    <div class="badge badge-outline badge-sm">
                        {{ t.category }}
                    </div>
                    </td>
                    <td
                    :class="{
                        'text-success font-semibold': t.type === 'Receita',
                        'text-error font-semibold': t.type === 'Despesa',
                    }"
                    >
                    {{ formatCurrency(t.price) }}
                    </td>
                    <td class="text-base-content/70">
                    {{ t.updated_at_formatted }}
                    </td>
                    <td class="text-center">
                    <div class="flex justify-center gap-2">
                        <Link
                        :href="route('transactions.edit', t.id)"
                        class="btn btn-ghost btn-sm btn-circle"
                        >
                        ✏️
                        </Link>

                        <button
                        @click="onDeleteTransaction(t.id)"
                        class="btn btn-ghost btn-sm btn-circle text-error"
                        >
                        🗑
                        </button>
                    </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>

            <!-- MOBILE CARDS -->
            <div class="md:hidden space-y-4">
            <div
                v-for="t in _last_transactions"
                :key="t.id"
                class="card bg-base-200 shadow-md"
            >
                <div class="card-body p-4 space-y-3">

                <div class="flex justify-between items-start">
                    <h3 class="font-semibold text-base">
                    {{ t.description }}
                    </h3>

                    <div
                    :class="[
                        'text-sm font-bold',
                        t.type === 'Receita' ? 'text-success' : 'text-error'
                    ]"
                    >
                    {{ formatCurrency(t.price) }}
                    </div>
                </div>

                <div class="flex justify-between text-sm text-base-content/70">
                    <span class="badge badge-outline badge-xs">
                    {{ t.category }}
                    </span>

                    <span>
                    {{ t.updated_at_formatted }}
                    </span>
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <Link
                    :href="route('transactions.edit', t.id)"
                    class="btn btn-xs btn-outline"
                    >
                    Editar
                    </Link>

                    <button
                    @click="onDeleteTransaction(t.id)"
                    class="btn btn-xs btn-error btn-outline"
                    >
                    Excluir
                    </button>
                </div>

                </div>
            </div>

            <div v-if="!_last_transactions.length"
                class="text-center py-10 text-base-content/60">
                Nenhuma transação registrada ainda
            </div>
            </div>

          </div>
        </div>

        <!-- Sidebar – Ações Rápidas -->
        <div class="card bg-linear-to-br from-base-200 to-base-100 shadow-2xl border border-base-200 h-fit lg:sticky lg:top-8">
          <div class="card-body p-6 lg:p-8">
            <h2 class="card-title text-2xl mb-6">Ações Rápidas</h2>

            <Link
              :href="route('transactions.create')"
              class="btn btn-primary w-full py-7 text-lg gap-3 shadow-lg hover:shadow-xl transition-all"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
              Nova Transação
            </Link>

            <!-- Insight da IA -->
            <div
              class="card bg-base-100 shadow-2xl border border-primary/20 mt-6 lg:mt-8"
            >
              <div class="card-body p-6 lg:p-8 space-y-4">

                <div class="flex items-center gap-3">
                  <div class="p-2 rounded-xl bg-primary/10 text-primary">
                    🤖
                  </div>
                  <h2 class="card-title text-xl">
                    Insight Inteligente
                  </h2>
                </div>

                <!-- INSIGHT -->
                <div
                  v-if="_ai_insight"
                  class="prose prose-sm max-w-none text-base-content"
                  v-html="renderedInsight"
                  >
                </div>

                <!-- FALLBACK -->
                <div
                  v-else
                  class="text-base-content/50 italic"
                >
                  Nenhum insight disponível no momento.
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>