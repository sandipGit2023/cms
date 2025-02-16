<script setup>
import { ref, watch, computed } from 'vue'
import { Head, Link, usePage } from '@inertiajs/vue3'
import TreeView from '@/Components/TreeView.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Plus } from 'lucide-vue-next'

const page = usePage()

const props = defineProps({
  pages: Array
})

const pageTree = ref(props.pages)

watch(() => props.pages, (newPages) => {
  pageTree.value = newPages
}, { deep: true })

const successMessage = ref(null)

watch(() => page.props.flash.success, (newMessage) => {
  if (newMessage) {
    successMessage.value = newMessage

    setTimeout(() => {
      successMessage.value = null
      page.props.flash.success = null
    }, 3000)
  }
}, { immediate: true })

const breadcrumbs = computed(() => {
  const currentPath = page.url
  const segments = currentPath.split('/').filter(segment => segment)
  let fullPath = ''

  return segments.map((segment, index) => {
    fullPath += '/' + segment
    return {
      name: segment.replace(/-/g, ' ').toUpperCase(),
      path: fullPath
    }
  })
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Pages" />
    <template #header>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pages</h2>
            <Link
              :href="route('pages.create')"
              class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 space-x-2"
            >
              <Plus class="w-5 h-5" />
              <span>New Page</span>
            </Link>
        </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div v-if="successMessage" class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ successMessage }}
          </div>

          <nav class="text-sm text-gray-600 mb-4">
            <ol class="flex space-x-2">
              <li>
                <Link href="/" class="text-gray-500 hover:text-gray-700">Home</Link>
                <span class="mx-1">/</span>
              </li>
              <li v-for="(breadcrumb, index) in breadcrumbs" :key="index">
                <Link
                  v-if="index < breadcrumbs.length - 1"
                  :href="breadcrumb.path"
                  class="text-gray-500 hover:text-gray-700"
                >
                  {{ breadcrumb.name }}
                </Link>
                <span v-else class="text-gray-900 font-semibold">
                  {{ breadcrumb.name }}
                </span>
                <span v-if="index < breadcrumbs.length - 1" class="mx-1">/</span>
              </li>
            </ol>
          </nav>

          <TreeView :items="pageTree" class="mt-4" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
