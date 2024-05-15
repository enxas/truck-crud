<script setup>
import { ref } from "vue"
import useTrucks from "@/composables/trucks"

const { storeTruck, errors } = useTrucks()

const form = ref({
	unit_number: "",
	year: "",
	notes: "",
})
</script>

<template>
	<form
		class="max-w-md mx-auto p-4 bg-white shadow-md rounded-md"
		@submit.prevent="storeTruck(form)"
	>
		<div class="mb-6">
			<label
				for="unit_number"
				class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
				>Unit Number</label
			>
			<input
				type="text"
				id="unit_number"
				v-model="form.unit_number"
				class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				placeholder="A123"
			/>
			<div v-if="errors.unit_number">
				<span class="text-sm text-red-400">{{ errors.unit_number[0] }}</span>
			</div>
		</div>
		<div class="mb-6">
			<label
				for="year"
				class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
				>Year</label
			>
			<input
				type="number"
				id="year"
				v-model="form.year"
				class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				placeholder="1950"
			/>
			<div v-if="errors.year">
				<span class="text-sm text-red-400">{{ errors.year[0] }}</span>
			</div>
		</div>
		<div class="mb-6">
			<label
				for="notes"
				class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
				>Notes</label
			>
			<input
				type="text"
				id="notes"
				v-model="form.notes"
				class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				placeholder="Lorem ipsum"
			/>
			<div v-if="errors.notes">
				<span class="text-sm text-red-400">{{ errors.notes[0] }}</span>
			</div>
		</div>

		<button
			type="submit"
			class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
		>
			Create
		</button>
	</form>
</template>
