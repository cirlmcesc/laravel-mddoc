<template>
  <a-menu
		@click="handleClick"
		:defaultOpenKeys="defaultOpenKeys"
		:defaultSelectedKeys="[defaultSelectedKeys]"
		style="width: 256px;margin-top: 2vh;"
		mode="inline"
		theme="dark">
		<slot />
  </a-menu>
</template>

<script>
export default {
	name: "MarkdownMenu",
	data() {
		return {
			openKeys: [],
		}
	},
	props: [
		"targetUri",
		"defaultOpenKeys",
		"defaultSelectedKeys",
	],
	methods: {
		handleClick(item) {
			window.location.href = `${this.targetUri}/${item.key}`
		},
	},
}
</script>