<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	<meta name="description" content=""/>
	<meta name="author" content=""/>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
	<div id="app">
		<a-layout>
			<a-layout-header>
				<a-row type="flex" justify="start" :gutter="12">
					<a-col :span="12">
						<h2 style="color: #fff;margin-top: 8px;">{{ $title }}</h2>
					</a-col>
				</a-row>
			</a-layout-header>
			<a-layout>
				<a-layout-sider style="min-height: 95vh;min-width: 256px;">
					<m-menu
						:target-uri="'{{ $route_path }}'"
						:default-open-keys='@json($menu_seleced)'
						:default-selected-keys="'{{ $selected_key }}'">
						<template>
							@foreach ($directory as $f => $first)
								@if (! has_subdir($first))
									<a-menu-item key="{{ $first['url'] }}">{{ $f }}</a-menu-item>
								@endif
							@endforeach
							@foreach ($directory as $f => $first)
								@if (has_subdir($first))
									<a-sub-menu key="{{ $first['url'] }}">
										<span slot="title"><span>{{ $f }}</span></span>
										@foreach ($first['children_directory'] as $s => $second)
											@if (! has_subdir($second))
												<a-menu-item key="{{ buildMenuKey($first['url'], $second['url']) }}">{{ $s }}</a-menu-item>
											@endif
										@endforeach
										@foreach ($first['children_directory'] as $s => $second)
											@if (has_subdir($second))
												<a-sub-menu key="{{ buildMenuKey($first['url'], $second['url']) }}">
													<span slot="title"><span>{{ $s }}</span></span>
													@foreach ($second['children_directory'] as $t => $third)
														<a-menu-item key="{{ buildMenuKey($first['url'], $second['url'], $third['url']) }}">{{ $t }}</a-menu-item>
													@endforeach
												</a-sub-menu>
											@endif
										@endforeach
									</a-sub-menu>
								@endif
							@endforeach
						</template>
					</m-menu>
				</a-layout-sider>
				<a-layout-content>
					<m-content :target-uri="'{{ $route_path }}'">
						<template
							class="m-markdown-content"
							style="display: none;">
							@if ($markdown_content === "Markdown file can not find.")
								<a-button
									class="back-to-home"
									style="margin-bottom: 65px;"
									type="primary"
									@click="() => {}">回到主页
								</a-button>
								<a-alert
									show-icon
									message="Whoops !!! Looks like something went wrong."
									description="Markdown file can not find."
									type="error"/>
							@else
								{!! $markdown_content !!}
							@endif
						</template>
					</m-content>
				</a-layout-content>
			</a-layout>
		</a-layout>
	</div>
	<script src="{{ asset('mddoc/mddoc.js') }}"></script>
</body>
</html>
