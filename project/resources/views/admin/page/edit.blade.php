@extends('layouts.admin.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
	<h1>{{__('Edit Page')}}</h1>
	<div class="form-content  p-3">
		<form method="post" action="{{route('pages.update',$page->id)}}">
			@if ($errors->any())
		        <ul class="alert alert-danger">
		            @foreach($errors->all() as $error)
		                <li>{{__($error) }}</li>
		            @endforeach
		        </ul>
		    @endif
			@csrf
			<input type="hidden" name="_method" value="put">
			<div class="form-group">
				<label >{{__('Page Title')}}</label>
				<input type="text" class="form-control rounded-0" value="{{__($page->title)}}" placeholder="eg: About us" name="title" required>
			</div>
			<div class="form-group">
				<label >{{__('Page Slug(url)')}}</label>
				<input type="text" class="form-control rounded-0" value="{{$page->slug}}" placeholder="eg: about-us" name="slug" required>
			</div>
			<div class="form-group">
				<label >{{__('Page Content')}}</label>
				<textarea rows="40" name="content" id="content" class="form-control" required>{!! $page->content !!}</textarea>
			</div>
			<div class="form-group">
			<label>
				<input id="seo" type="checkbox" <?= ($page->seo) ? 'checked="checked"' : '' ?> name="seo_input">
				{{__('Add Seo')}}
			</label>
			</div>
			<div id="seo-show" <?= ($page->seo) ? '' : 'style="display: none;"' ?> >
				<div class="form-group">
					<label>{{__('Seo Title')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Page title)')}}
						</span>
					</label>
					<input type="text" id="seo_title"
					 <?php 
					 if($page->seo){
					 ?>
					 	value="{{__($page->seo->title)}}" 
					 <?php 
						}
					 ?>

					 class="form-control seo-inputs" name="seo_title" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Keywords')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
						{{__('	(Add comma after every keyword*)')}}
						</span>
					</label>
					<input type="text" id="meta_tags"
					<?php 
					 if($page->seo){
					 ?>
					 value="
					<?php foreach ($page->seo->meta_tags as $pm_tag): ?>
						{{__($pm_tag)}} 
					<?php endforeach ?>
					" 
					<?php 
					}
					?>
					class="seo-inputs" name="meta_tags[]" class="form-control" />
				</div>
				<div class="form-group">
					<label>{{__('Meta Description')}}
						<span style="display: block;font-size: 10px; font-weight: 400">
							{{__('(Avoid long description*)')}}
						</span>
					</label>
					<textarea rows="10" class="form-control" class="seo-inputs" name="meta_description">{{($page->seo) ? $page->seo->meta_description : ''}}</textarea>
				</div>
			</div>
			<button type="submit" class="btn btn-primary rounded-0 float-right">{{__('Save')}}</button>
		</form>
	</div>
</div>
@endsection
@section('javascript')
<script src="https://cdn.tiny.cloud/1/sokyk3z608i7wzazq03wtdj2zj8b9ca57wckd7xc2d8ifsjp/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
 <script>tinymce.init({selector:'#content'});</script>
@endsection