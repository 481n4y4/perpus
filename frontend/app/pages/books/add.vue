<template>
  <div class="bg-gray-900 text-white">
    <div class="px-6 pt-14 lg:px-8">
      <h1 class="text-2xl font-bold mb-6 text-center">Add Data Book</h1>

      <!-- FORM -->
      <form
        @submit.prevent="submitBook"
        class="bg-gray-800 p-6 rounded shadow space-y-4"
      >
        <!-- Nama -->
        <div>
          <label class="block font-semibold mb-1"> Name </label>
          <input
            v-model="form.name"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Name"
            required
          />
        </div>

        <!-- Auhtor -->
        <div>
          <label class="block font-semibold mb-1"> Author </label>
          <input
            v-model="form.author"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Author"
            required
          />
        </div>

        <!-- Publoisher -->
        <div>
          <label class="block font-semibold mb-1"> Publisher </label>
          <input
            v-model="form.publisher"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Publisher"
            required
          />
        </div>

        <!-- Publish Date -->
        <div>
          <label class="block font-semibold mb-1"> Publish Date </label>
          <input
            v-model="form.publish_date"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Publish Date"
            required
          />
        </div>

        <!-- Price -->
        <div>
          <label class="block font-semibold mb-1">Price</label>
          <input
            v-model="form.publisher"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Price"
            required
          />
        </div>

        <!-- Stock -->
        <div>
          <label class="block font-semibold mb-1">Stock</label>
          <input
            v-model="form.publisher"
            type="text"
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            placeholder="Input Stock"
            required
          />
        </div>

        <!-- Book Cover -->
        <div>
          <label class="block font-semibold mb-1">Book Cover</label>
          <div
            class="mt-2 flex justify-center rounded-lg border border-dashed border-white/25 px-6 py-10"
          >
            <div class="text-center">
              <PhotoIcon
                class="mx-auto size-12 text-gray-600"
                aria-hidden="true"
              />
              <div class="mt-4 flex text-sm/6 text-gray-400">
                <label
                  for="file-upload"
                  class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-500 hover:text-indigo-300"
                >
                  <span>Upload a file</span>
                  <input
                    id="file-upload"
                    name="file-upload"
                    type="file"
                    class="sr-only"
                  />
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs/5 text-gray-400">PNG, JPG, GIF up to 10MB</p>
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded"
          >
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
definePageMeta({ layout: "book", middleware: "is-authenticated" });
const apiBase = useRuntimeConfig().public.apiBase;

const form = ref({
  name: "",
  author: "",
  publisher: "",
  publish_date: null,
  price: null,
  stock: null,
  book_cover: "",
});

const submitBook = async () => {
  try {
    await $fetch(`${apiBase}/book`, {
      method: "POST",
      body: JSON.stringify(form.value),
    });
    alert("Book successfuly added");
    navigateTo("/book");
  } catch (error) {
    console.error(error);
    alert("Failed to add book");
  }
};
</script>
