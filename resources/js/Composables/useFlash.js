import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export function useFlash() {
    const page = usePage()

    const alertType = computed(() => {
        const keys = Object.keys(page.props.flash)
        return keys.length ? keys[0] : null
    })

    const alertMessage = computed(() => {
        const values = Object.values(page.props.flash)
        return values.length ? values[0] : null
    })

    return { alertType, alertMessage }
}