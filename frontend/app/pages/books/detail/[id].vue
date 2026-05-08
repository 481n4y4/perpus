<template>
  <div class="bg-gray-900 text-white">
    <div class="px-6 pt-14 lg:px-8">
      <h1 class="text-2xl font-bold mb-6 text-center">Detail Data Book</h1>

      <!-- FORM -->
      <div class="bg-gray-800 p-6 rounded shadow space-y-4">
        <!-- Nama -->
        <div>
          <label class="block font-semibold mb-1"> Name </label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.name }}</span
          >
        </div>

        <!-- Author -->
        <div>
          <label class="block font-semibold mb-1"> Author </label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.author }}</span
          >
        </div>

        <!-- Publisher -->
        <div>
          <label class="block font-semibold mb-1"> Publisher </label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.publisher }}</span
          >
        </div>

        <!-- Publish Date -->
        <div>
          <label class="block font-semibold mb-1"> Publish Date </label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.publish_date }}</span
          >
        </div>

        <!-- Price -->
        <div>
          <label class="block font-semibold mb-1">Price</label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.price }}</span
          >
        </div>

        <!-- Stock -->
        <div>
          <label class="block font-semibold mb-1">Stock</label>
          <span
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            >{{ book.data.stock }}</span
          >
        </div>

        <!-- Book Cover -->
        <div>
          <label class="block font-semibold mb-1">Book Cover</label>
          <div
            class="mt-2 flex justify-center rounded-lg border border-dashed border-white/25 px-6 py-10"
          >
            <img v-if="isImage" :src="fileUrl" alt="" />

            <div v-else class="flex flex-col gap-3">
              <span>{{ book.data.book_cover }}</span>
              <div class="flex justify-center">
                <a
                  :href="fileUrl"
                  target="_blank"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-3 py-2 rounded"
                >
                  Open File</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// const apiBase = useRuntimeConfig().public.apiBase;
// const token = useCookie("auth_token");

definePageMeta({
  layout: "book",
  middleware: "is-authenticated",
});

const route = useRoute();
const id = route.params.id;
const api = useApi();
const book = await api(`/book/${id}`);
const fileUrl = `http://127.0.0.1:8000/storage/${book.data.book_cover}`;
const imageExtensions = ["jpg", "jpeg", "png"];

const fileExtension = book.data.book_cover.split(".").pop().toLowerCase();
const isImage = imageExtensions.includes(fileExtension);
</script>
