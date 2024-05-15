<script setup>
import { RouterLink, RouterView } from "vue-router"
</script>

<template>
	<header>
		<div class="max-w-6xl mx-auto">
			<nav class="space-x-3">
				<RouterLink
					to="/"
					class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded inline-block mb-3"
					>Home</RouterLink
				>
				<RouterLink
					to="/trucks/create"
					class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded inline-block mb-3"
					>Create New</RouterLink
				>
			</nav>
		</div>
	</header>
	<main class="max-w-6xl mx-auto min-h-screen">
		<RouterView />
	</main>
</template>
