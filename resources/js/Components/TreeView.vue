<script setup>
import { ref, nextTick } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import { ChevronRight, ChevronDown, Pencil, Trash } from 'lucide-vue-next'
import Modal from '@/Components/Modal.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import DangerButton from '@/Components/DangerButton.vue'

// Props to accept a nested list of pages
const props = defineProps({
  items: {
    type: Array,
    required: true
  }
})

const expanded = ref(new Set())
const confirmingDeletion = ref(false)
const pageToDelete = ref(null)

const form = useForm({})

// Toggle a node’s expanded state
const toggleExpand = (id) => {
  expanded.value.has(id) ? expanded.value.delete(id) : expanded.value.add(id)
}

const isExpanded = (id) => expanded.value.has(id)

// Show delete confirmation modal
const confirmDelete = (item) => {
  pageToDelete.value = item
  confirmingDeletion.value = true
}

// Perform delete action
const deletePage = () => {
  if (!pageToDelete.value) return

  form.delete(route('pages.destroy', pageToDelete.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      confirmingDeletion.value = false
      pageToDelete.value = null
    }
  })
}
</script>

<template>
  <div>
    <template v-for="item in items" :key="item.id">
      <div class="tree-node">
        <div class="flex items-center py-2 px-4 hover:bg-gray-50 rounded-lg group">
          <button
            v-if="item.children?.length"
            @click="toggleExpand(item.id)"
            class="mr-2 text-gray-500 hover:text-gray-700"
          >
            <ChevronRight v-if="!isExpanded(item.id)" class="w-4 h-4" />
            <ChevronDown v-else class="w-4 h-4" />
          </button>

          <Link :href="item.full_path" class="flex-grow text-gray-700 hover:text-gray-900">
            {{ item.title }}
            <span v-if="item.children_count" class="ml-2 text-xs text-gray-500">
              ({{ item.children_count }})
            </span>
          </Link>

          <div class="opacity-0 group-hover:opacity-100 transition-opacity flex space-x-2">
            <Link :href="route('pages.edit', item.id)" class="text-gray-400 hover:text-gray-600">
              <Pencil class="w-4 h-4" />
            </Link>
            <button @click="confirmDelete(item)" class="text-gray-400 hover:text-red-600">
              <Trash class="w-4 h-4" />
            </button>
          </div>
        </div>

        <!-- Recursive Rendering for Child Nodes -->
        <div v-if="item.children?.length && isExpanded(item.id)" class="ml-6 mt-1 border-l border-gray-200">
          <TreeView :items="item.children" />
        </div>
      </div>
    </template>
    <Modal :show="confirmingDeletion" @close="confirmingDeletion = false">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          Are you sure you want to delete this page?
        </h2>

        <p class="mt-1 text-sm text-gray-600">
          This action cannot be undone. Once deleted, this page and all its nested pages will be permanently removed.
        </p>

        <div class="mt-6 flex justify-end">
          <SecondaryButton @click="confirmingDeletion = false">Cancel</SecondaryButton>
          <DangerButton
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deletePage"
          >
            Delete Page
          </DangerButton>
        </div>
      </div>
    </Modal>
  </div>

</template>
