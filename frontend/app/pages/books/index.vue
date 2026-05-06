<template>
  <div class="bg-gray-900">
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="flex justify-center my-10" v-if="pendingBooks">
        <div
          class="animate-spin size-10 border-4 border-white border-t-transparent rounded-full"
        ></div>
      </div>

      <div class="flex justify-center my-10" v-else-if="errorBooks">
        <h1 class="w-200 text-center text-red-600 bg-red-200 py-4 rounded">
          Gagal fetching data {{ errorBooks.message }}
        </h1>
      </div>

      <div v-else class="flex flex-col mx-auto my-10 max-w-3/4">
        <!-- Action Buttons -->
        <div class="flex justify-end gap-2 mb-3">
          <button
            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded"
            @click="refreshBooks"
          >
            Refresh
          </button>

          <NuxtLink
            to="/books/add"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded"
          >
            Add Book
          </NuxtLink>
        </div>

        <!-- Table -->
        <div class="p-2 mx-auto text-white">
          <h2 class="mb-3 text-2xl font-semibold leading-tight">Book List</h2>
          <div class="overflow-x-auto">
            <table class="text-xs rounded-md">
              <thead class="rounded-t-lg bg-gray-700">
                <tr class="text-right">
                  <th class="p-3">No</th>
                  <th class="p-3 text-center">Name</th>
                  <th class="p-3 text-center">Author</th>
                  <th class="p-3 text-center">Publisher</th>
                  <th class="p-3 text-center">Publish Date</th>
                  <th class="p-3 text-center">Price</th>
                  <th class="p-3 text-center">Stock</th>
                  <th class="p-3 text-center">Cover</th>
                  <th class="p-3 text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(book, index) in books?.data"
                  :key="book.id"
                  class="text-right border-b border-opacity-20 bg-gray-800"
                >
                  <td class="px-3 py-4 text-left">
                    <span>{{ index + 1 }}</span>
                  </td>
                  <td class="px-3 py-4 text-left">
                    <span>{{ book.name }}</span>
                  </td>
                  <td class="px-3 py-4 text-left">
                    <span>{{ book.author }}</span>
                  </td>
                  <td class="px-3 py-4 text-left">
                    <span>{{ book.publisher }}</span>
                  </td>
                  <td class="px-3 py-4 text-center">
                    <span>{{ book.publish_date }}</span>
                  </td>
                  <td class="px-3 py-4 text-left">
                    <span>{{ book.price }}</span>
                  </td>
                  <td class="px-3 py-4 text-center">
                    <span>{{ book.stock }}</span>
                  </td>
                  <td class="px-3 py-4 text-center">
                    <a
                      :href="`${book.book_cover}`"
                      target="_blank"
                      class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded"
                    >
                      Photo
                    </a>
                  </td>
                  <td class="px-3 py-2 flex flex-row gap-1">
                    <NuxtLink
                      :to="`/books/${book.id}`"
                      class="bg-green-600 hover:bg-green-400 text-white font-semibold px-3 py-2 rounded"
                    >
                      Edit
                    </NuxtLink>
                    <NuxtLink
                      to="/books/add"
                      class="bg-red-600 hover:bg-red-400 text-white font-semibold px-3 py-2 rounded"
                    >
                      Delete
                    </NuxtLink>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const apiBase = useRuntimeConfig().public.apiBase;
const {
  data: books,
  pending: pendingBooks,
  error: errorBooks,
  refresh: refreshBooks,
} = await useFetch(`${apiBase}/book`);
</script>
