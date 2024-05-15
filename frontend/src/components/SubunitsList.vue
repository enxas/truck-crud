<template>
	<div class="max-w-md mx-auto p-4 bg-white shadow-md rounded-md mt-3">
		<h2 class="text-2xl">Subunits</h2>
		<ul>
			<li v-for="subunit in subunits" class="flex justify-between items-center">
				<span
					>{{ subunit.unit_number }} ({{ subunit.start_date }} -
					{{ subunit.end_date }})</span
				>
				<button
					@click="destroySubunit(subunit.id)"
					class="my-2 px-4 py-1 bg-red-500 hover:bg-red-700 text-white rounded"
				>
					Delete
				</button>
			</li>
		</ul>
	</div>
</template>

<script setup>
defineProps({
	subunits: Array,
	destroySubunit: Function,
})
</script>
