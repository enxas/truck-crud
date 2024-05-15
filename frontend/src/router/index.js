import { createRouter, createWebHistory } from 'vue-router'
import TrucksList from '../views/TrucksList.vue'
import TruckEdit from '../views/TruckEdit.vue'
import TruckCreate from '../views/TruckCreate.vue'

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			name: 'Home',
			component: TrucksList
		},
		{
			path: '/trucks/create',
			name: 'TruckCreate',
			component: TruckCreate
		},
		{
			path: '/trucks/:id/edit',
			name: 'TruckEdit',
			component: TruckEdit,
			props: true,
		},
	]
})

export default router
