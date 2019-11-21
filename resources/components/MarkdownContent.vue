<template>
	<a-layout>
		<a-layout-content>
			<a-spin :spinning="onDataLoading" size="large">
				<a-skeleton
					active
					style="min-height: 95vh;"
					:title="{ width: 20 }"
					:paragraph="{ rows: 25 }"
					:loading="onDataLoading">
				</a-skeleton>
				<a-layout>
					<a-layout-content class="markdown-body">
						<slot />
					</a-layout-content>
				</a-layout>
			</a-spin>
		</a-layout-content>
	</a-layout>
</template>

<script>
import NProgress from 'nprogress'

export default {
	name: "MarkdownContent",
	props: [
		'markdownContent',
  ],
	data() {
		return {
			onDataLoading: false,
		}
	},
	props: [
		"targetUri",
	],
	mounted() {
		this.onDataLoading = true
		this.setBackHomeButton()
		this.parseMarkdownContent()

		setTimeout(() => {
			NProgress.done()
			this.onDataLoading = false
			this.showMarkdownContent()
		}, 300)
	},
	methods: {
		setBackHomeButton() {
			this.$jQuery("button.back-to-home").on('click',
				() => window.location.href = `${this.targetUri}`)
		},
		parseMarkdownContent() {
			const $ = this.$jQuery
			const thisComponent = this

			$("div.markdown-body table").addClass("table table-bordered table-hover")
			$("div.markdown-body table thead tr").addClass("bg-primary text-light")
			$("div.markdown-body pre").addClass("m-3 p-3 bg-light border")
			$("div.markdown-body p").addClass("mt-4")
			$("div.markdown-body pre code").toArray().forEach(function (code) {
				const prettystring = thisComponent.syntaxHighlight($(code).text())

				$(code).text("")
				$(code).html(prettystring)
				$(code).children(".string").addClass("text-success")
				$(code).children(".number").addClass("text-warning")
				$(code).children(".boolean").addClass("text-primary")
				$(code).children(".null").addClass("text-info")
				$(code).children(".key").addClass("text-danger")
			})
		},
		syntaxHighlight(json) {
			if (typeof json != 'string') {
				json = JSON.stringify(json, undefined, 2);
			}

			json = json.replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>');

			return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function(match) {
				var cls = 'number';

				if (/^"|^'/.test(match)) {
					cls = /:$/.test(match) ? 'key' : 'string'
				} else if (/true|false/.test(match)) {
					cls = 'boolean';
				} else if (/null/.test(match)) {
					cls = 'null';
				}

				return '<span class="' + cls + '">' + match + '</span>';
			});
		},
		showMarkdownContent() {
			this.$jQuery("div.m-markdown-content").show()
		},
	},
}
</script>

<style>
.ant-skeleton-content .ant-skeleton-paragraph > li {
	background: rgba(0, 0, 0, 0.11) !important;
}
.markdown-body {
	padding: 45px;
}
.bg-primary {
	background-color: #1890ff !important;
}
.text-danger {
	color: #f5222d !important;
}
.text-success {
	color: #52c41a !important;
}
.text-info .text-primary {
	color: #1890ff !important;
}
.text-warning {
	color: #faad14 !important;
}
.markdown-body table {
	display: inline-table !important;
}

</style>