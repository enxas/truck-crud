<template>
	<div class="relative overflow-x-auto">
		<table
			class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
		>
			<thead
				class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
			>
				<tr>
					<th scope="col" class="px-6 py-3">Truck unit number</th>
					<th scope="col" class="px-6 py-3">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr
					v-for="truck in trucks"
					:key="truck.id"
					class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
				>
					<th
						scope="row"
						class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
					>
						{{ truck.unit_number }} ({{ truck.year }})
					</th>
					<td class="px-6 py-4 space-x-2">
						<RouterLink
							:to="{ name: 'TruckEdit', params: { id: truck.id } }"
							class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded"
							>Edit</RouterLink
						>
						<button @click="destroyTruck(truck.id)"
							class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded"
						>
							Delete
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script setup>
import useTrucks from "@/composables/trucks"
import { onMounted } from "vue"

const { trucks, getTrucks, destroyTruck } = useTrucks()

onMounted(() => getTrucks())
</script>
