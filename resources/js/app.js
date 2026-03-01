import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

import { ZiggyVue } from 'ziggy-js'


/** @type {Record<string, () => Promise<any>>} */
const pages = import.meta.glob('./Pages/**/*.vue')

createInertiaApp({
  resolve: name =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      pages
    ),

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue, props.initialPage.props.ziggy)
      .mount(el)
  },
})
