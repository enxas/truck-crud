<script setup>
import { onMounted, ref } from "vue"
import useTrucks from "@/composables/trucks"
import SubunitsList from "@/components/SubunitsList.vue"

const {
	truck,
	getTruck,
	updateTruck,
	errors,
	storeSubunit,
	getSubunits,
	subunits,
	destroySubunit,
} = useTrucks()

const props = defineProps({
	id: {
		required: true,
		type: String,
	},
})

const form = ref({
	start_date: "",
	end_date: "",
	main_truck: "",
	subunit: "",
})

onMounted(async () => {
	await getTruck(props.id)
	form.value.main_truck = truck.value.id
	await getSubunits(truck.value.id)
})
</script>

<template>
	<form
		class="max-w-md mx-auto p-4 bg-white shadow-md rounded-md"
		@submit.prevent="updateTruck($route.params.id)"
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
				v-model="truck.unit_number"
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
				v-model="truck.year"
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
				v-model="truck.notes"
				class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				placeholder="Lorem ipsum"
			/>
			<div v-if="errors.notes">
				<span class="text-sm text-red-400">{{ errors.notes[0] }}</span>
			</div>
		</div>

		<button
			type="submit"
			class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
		>
			Update
		</button>
	</form>

	<form
		class="max-w-md mx-auto p-4 bg-white shadow-md rounded-md mt-3"
		@submit.prevent="storeSubunit(form)"
	>
		<h2 class="text-2xl mb-3">Assign a subunit</h2>
		<div class="grid gap-6 mb-6 md:grid-cols-2">
			<div>
				<label
					for="first_name"
					class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
					>Start date</label
				>
				<input
					type="date"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					v-model="form.start_date"
					required
				/>
			</div>
			<div>
				<label
					for="last_name"
					class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
					>End date</label
				>
				<input
					type="date"
					class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					v-model="form.end_date"
					required
				/>
			</div>
		</div>
		<div class="mb-6">
			<label
				for="countries"
				class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
				>Select subunit</label
			>
			<select
				id="countries"
				class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
				v-model="form.subunit"
			>
				<option v-for="subunit in truck.trucks" :value="subunit.id">
					{{ subunit.unit_number }}
				</option>
			</select>
			<div v-if="errors.subunit">
				<span class="text-sm text-red-400">{{ errors.subunit[0] }}</span>
			</div>
		</div>

		<button
			type="submit"
			class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center"
		>
			Add
		</button>
	</form>

	<SubunitsList :subunits="subunits" :destroySubunit="destroySubunit" />
</template>
