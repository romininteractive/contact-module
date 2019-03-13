<template>
	<div>
		Hi, {{ name }}
	</div>
</template>

<script>
	export default {
		name: 'ri-hello',
		props: ['name'],
		data(){
			return {}
		}
	}
</script>