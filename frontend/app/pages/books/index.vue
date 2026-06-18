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
        <div class="flex justify-end gap-2 mb-3" v-if="user?.role === 'admin'">
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
                  v-for="(book, index) in books?.data?.data"
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
                      v-if="book.book_cover"
                      :href="`http://127.0.0.1:8000/storage/${book.book_cover}`"
                      target="_blank"
                      class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded"
                    >
                      File
                    </a>

                    <span v-else class="text-gray-500"> None </span>
                  </td>
                  <td class="px-3 py-2">
                    <div
                      v-if="user?.role === 'admin'"
                      class="flex flex-row gap-1"
                    >
                      <NuxtLink
                        :to="`/books/detail/${book.id}`"
                        class="bg-green-600 hover:bg-green-400 text-white font-semibold px-3 py-2 rounded"
                      >
                        Detail
                      </NuxtLink>
                      <NuxtLink
                        :to="`/books/${book.id}`"
                        class="bg-blue-600 hover:bg-blue-400 text-white font-semibold px-3 py-2 rounded"
                      ><!-- Current Cover Preview -->
        <div class="mt-4">
          <label class="block font-semibold mb-2">Current Cover</label>
          <div class="flex justify-center">
            <img
              src="https://via.placeholder.com/200x300/1e293b/ffffff?text=Book+Cover"
              alt="Current book cover"
              class="rounded-lg shadow-lg max-h-48 object-cover"
            />
          </div>
          <p class="text-center text-gray-400 text-sm mt-2">
            book-cover-gatsby.jpg
          </p>
        </div>
                        Edit
                      </NuxtLink>
                      <button
                        @click="handleDelete(book.id)"
                        class="bg-red-600 hover:bg-red-400 text-white font-semibold px-3 py-2 rounded"
                      >
                        Delete
                      </button>
                    </div>

                    <div v-else>
                      <NuxtLink
                        :to="`/books/detail/${book.id}`"
                        class="bg-green-600 hover:bg-green-400 text-white font-semibold px-3 py-2 rounded"
                      >
                        Detail
                      </NuxtLink>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="flex justify-center p-5">
            <nav
              aria-label="Pagination"
              class="inline-flex -space-x-px rounded-md shadow-sm text-gray-100 bg-gray-800"
            >
              <button
                type="button"
                class="inline-flex items-center px-2 py-2 text-sm font-semibold border rounded-l-md dark:border-gray-600"
              >
                <span class="sr-only">Previous</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="w-5 h-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <div>
                <button
                  v-for="page in totalPage"
                  @click="currentPage = page"
                  :key="page"
                  type="button"
                  :class="buttonActive(page)"
                >
                  {{ page }}
                </button>
              </div>

              <button
                type="button"
                class="inline-flex items-center px-2 py-2 text-sm font-semibold border rounded-r-md border-gray-600"
              >
                <span class="sr-only">Next</span>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  class="w-5 h-5"
                >
                  <path
                    fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <ConfirmModal
    v-if="showModal"
    @close="showModal = false"
    @confirm="confirmDelete"
  />
</template>

<script setup>
definePageMeta({
  middleware: "is-authenticated",
});
const apiBase = useRuntimeConfig().public.apiBase;

const api = useApi();
const user = useState("authUser");
const selectedBookId = ref(null);
const showModal = ref(false);
const currentPage = ref(1);

const url = computed(() => `${apiBase}/book?page=${currentPage.value}`);

const { data: books, refresh: refreshBooks } = await useFetch(url);

const buttonActive = (pageNumber) => {
  return [
    "inline-flex items-center px-4 py-2 text-sm font-semibold border border-gray-600",
    currentPage.value === pageNumber
      ? "bg-blue-600 hover:bg-blue-400"
      : "bg-gray-900 hover:bg-gray-700",
  ];
};
const totalPage = computed(() => books.value?.data?.last_page || 1);

watchEffect(currentPage, async () => {
  await refreshBooks();
});
const handleDelete = async (id) => {
  selectedBookId.value = id;
  showModal.value = true;
};

const confirmDelete = async () => {
  try {
    await api(`/book/${selectedBookId.value}`, {
      method: "DELETE",
    });
    alert("Book successfully deleted");
    showModal.value = false;
  } catch (err) {
    console.error(err);
    alert(`Failed to delete book`);
  }
};
</script>
