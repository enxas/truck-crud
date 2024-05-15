import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { useToast } from "vue-toastification"

axios.defaults.baseURL = import.meta.env.VITE_BACKEND_URL

export default function useTrucks() {
	const trucks = ref([])
	const truck = ref([])
	const errors = ref({})
	const message = ref('')
	const router = useRouter()
	const toast = useToast()
	const subunits = ref([])

	const getTrucks = async () => {
		try {
			const response = await axios.get('trucks')
			trucks.value = response.data
		} catch (error) {
			errors.value = error.response.data.errors
			message.value = error.response.data.message
			toast.error(error.response.data.message)
		}
	}

	const getTruck = async (id) => {
		try {
			const response = await axios.get('trucks/' + id)
			truck.value = response.data
		} catch (error) {
			errors.value = error.response.data.errors
			message.value = error.response.data.message
			toast.error(error.response.data.message)
			await router.push({ name: "Home" })
		}
	}

	const storeTruck = async (data) => {
		try {
			const response = await axios.post('trucks', data)
			await router.push({ name: "Home" })
			toast.success(response.data.message)
		} catch (error) {
			errors.value = error.response.data.errors
			message.value = error.response.data.message
		}
	}

	const updateTruck = async (id) => {
		try {
			const response = await axios.put('trucks/' + id, truck.value)
			await router.push({ name: "Home" })
			toast.success(response.data.message)
		} catch (error) {
			errors.value = error.response.data.errors
			message.value = error.response.data.message
		}
	}

	const destroyTruck = async (id) => {
		if (!window.confirm("Are you sure?")) {
			return
		}

		const response = await axios.delete("trucks/" + id)
		toast.success(response.data.message)
		await getTrucks()
	}

	const storeSubunit = async (data) => {
		try {
			const response = await axios.post('subunits', data)
			toast.success(response.data.message)
			await getSubunits(truck.value.id)
		} catch (error) {
			errors.value = error.response.data.errors || {}
			message.value = error.response.data.message
			toast.error(error.response.data.message)
		}
	}

	const getSubunits = async (id) => {
		try {
			const response = await axios.get('subunits/' + id)
			subunits.value = response.data
		} catch (error) {
			errors.value = error.response.data.errors
			message.value = error.response.data.message
			toast.error(error.response.data.message)
		}
	}

	const destroySubunit = async (id) => {
		if (!window.confirm("Are you sure?")) {
			return
		}

		const response = await axios.delete("subunits/" + id)
		toast.success(response.data.message)
		await getSubunits(truck.value.id)
	}

	return {
		truck,
		trucks,
		getTruck,
		getTrucks,
		storeTruck,
		updateTruck,
		destroyTruck,
		errors,
		storeSubunit,
		getSubunits,
		subunits,
		destroySubunit,
	}
}