@extends('site_app')

@if($movies_info->seo_title)
	@section('head_title', stripslashes($movies_info->seo_title).' | '.getcong('site_name'))
@else
	@section('head_title', stripslashes($movies_info->video_title).' | '.getcong('site_name'))
@endif

@if($movies_info->seo_description)
	@section('head_description', stripslashes($movies_info->seo_description))
@else
	@section('head_description', Str::limit(stripslashes($movies_info->video_description),160))
@endif

@if($movies_info->seo_keyword)
	@section('head_keywords', stripslashes($movies_info->seo_keyword)) 
@endif


@section('head_image', URL::to('upload/source/'.$movies_info->video_image))

@section('head_url', Request::url())

@section('content')
 

 @if(get_player_cong('player_style')!="")  
 	<link href="{{ URL::asset('site_assets/videojs_player/css/'.get_player_cong('player_style').'.min.css') }}" rel="stylesheet" type="text/css" />    
 @else
	<link href="{{ URL::asset('site_assets/videojs_player/css/videojs_style1.min.css') }}" rel="stylesheet" type="text/css" />
 @endif
 
 <!--<script src="{{ URL::asset('site_assets/videojs_player/plugins/videojs-chromecast.min.js') }}"></script>-->

 <style type="text/css">
    
  .videoWrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 */
  padding-top: 25px;
  height: 0;
}
.videoWrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
} 

.vjs-pip-control
{
	@if(get_player_cong('pip_mode')=="ON")
	display: block!important;
	@else
	display: none!important;
	@endif
}

.video-js .vjs-control-bar .vjs-button.skiptrailerbutton {
    background: #eb1536;
	position: absolute;
	min-width: 60px;
	height: 34px;
	border-radius: 4px;
	text-transform: uppercase;
	text-shadow: none;
	font-weight: 600;
	font-size: 13px;
	line-height: 30px;
	top: -65px;
	right: 10px;
	z-index: 999;
}

.channel_info_count {
    background: #fff;
    min-width: 40px;
    height: 40px;
    display: inline-block;
    line-height: 40px;
	padding:0px 8px;
    text-align: center;
    border-radius: 50px;
    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.2);
    font-weight: 800;
    font-size: 16px;
    color: #e53935;
}
 
 </style>

 <div class="main-wrap">
  <div class="section section-padding vfx_video_single_section">
    <div class="container">
      <div class="video-single">
        <div class="row">
          <div class="col-xs-12">            
            <div class="content-wrap">              
				<div class="vfx_video_detail xs-top-40">
				  <div class="row">
 
					<div class="single-section col-md-8 col-sm-12 col-xs-12" id="left_video_player">
					  <main>
						  
 						<div id="container">
						  <a href="{{ URL::to('movies/'.$movies_info->video_slug.'/'.$movies_info->id) }}">
						  <div class="video-js vjs-big-play-centered skin-blue vjs-16-9 vjs-paused v_player-dimensions vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active vjs-cast-button">
							  
							  <div class="vjs-poster" aria-disabled="false" style="background-image: url({{URL::to('upload/source/'.$movies_info->video_image)}});"></div>

							  <button class="vjs-big-play-button" type="button" title="Play Video" aria-disabled="false"><span aria-hidden="true" class="vjs-icon-placeholder"></span><span class="vjs-control-text" aria-live="polite">Play Video</span></button>
							  
						  </div>
						</a>
					  </div> 
						
					  </main> 

					  <div id="theater_mode_width">

					  <h3 class="vfx_video_title">{{stripslashes($movies_info->video_title)}}</h3> 
					  <ul class="channel_content_info">
						@if($movies_info->release_date)
						<li><i class="fa fa-calendar"></i> {{ isset($movies_info->release_date) ? date('M d Y',$movies_info->release_date) : null }}</li>
						@endif 
					   @if($movies_info->duration) 
					   <li><i class="fa fa-clock-o"></i> {{$movies_info->duration}}</li>
					   @endif
					   @if($movies_info->imdb_rating) 
					   <li><img src="{{URL::to('site_assets/images/icons/imdb-logo.png')}}" alt="IMDb Rating"> &nbsp;<b>{{$movies_info->imdb_rating}}</b></li>
					   @endif

					  @if($movies_info->content_rating) 
						 <li>					  	 
					  	 	<span class="channel_info_count">{{$movies_info->content_rating}}</span>
					  	</li> 
					  	@endif
					    
					  </ul> 
					   
					   
					  <div class="video-attributes dtl_video">
						<div class="single-footer">
							<div class="row">
								<div class="col-md-5 col-xs-12">
									<div class="news-share">

										<label>{{trans('words.share_text')}}: </label>
										<div class="share-social">
											<a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook"></i></a>
											<a href="https://twitter.com/intent/tweet?text={{$movies_info->video_title}}&amp;url={{url()->current()}}"><i class="fa fa-twitter"></i></a>
											<a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&media={{URL::to('upload/source/'.$movies_info->video_image)}}&description={{$movies_info->video_title}}"><i class="fa fa-pinterest"></i></a>
											<a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>

										</div>
									</div>
								</div>
								<div class="col-md-7 col-xs-12">
									 <div class="news-tag">
										@foreach(explode(',',$movies_info->movie_genre_id) as $genres_ids)
										<p><b><a href="{{ URL::to('genres/movies/'.App\Genres::getGenresInfo($genres_ids,'genre_slug')) }}">{{App\Genres::getGenresInfo($genres_ids,'genre_name')}}</a></b></p>
										@endforeach  

										<p><a href="{{ URL::to('language/movies/'.App\Language::getLanguageInfo($movies_info->movie_lang_id,'language_slug')) }}"><b>{{App\Language::getLanguageInfo($movies_info->movie_lang_id,'language_name')}}</b></a></p>
									</div>
								</div>
							</div>
						</div> 							  
					  </div>  
					 <div class="clearfix"></div> 	
					 @if(get_ads('movie_single_ad_top')->status!=0)
					  <div class="add_banner_section">					     
					      <div class="row">
					        <div class="col-md-12">
					          {!!get_ads('movie_single_ad_top')->ad_code!!}
					        </div>
					      </div>					     
					  </div>
					  @endif 

					 <div class="single-section video-entry mr-top-20" id="episodes_all">
						  <h3 class="single-vfx_section_title">{{trans('words.description')}}</h3>
						  <div class="section-content">
							 @if(strlen($movies_info->video_description) > 500)
								 <div class="listing-section">
								  <div class="show-more">
									<div class="pricing-list-container">
									   {!!stripslashes($movies_info->video_description)!!}
									</div>
								  </div>
								  <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a> 
								</div>
							 @else
							 	{!!stripslashes($movies_info->video_description)!!}	
							 @endif	
						  </div>

						</div> 	
					</div>	

					</div>
					<div class="col-md-4 col-sm-12 col-xs-12" id="right_sidebar_hide">             
					  <div class="sidebar_playlist movie_sidebar_playlist_block">
						<div class="caption">
						   <div class="left"> <a href="#"><i class="fa fa-list"></i> {{trans('words.latest_movies')}}</a> </div>               
						   <div class="clearfix"></div>
						</div>
						@foreach($latest_movies_list as $latest_movies_data)
						<div class="playlist_item">
						  <a href="{{ URL::to('movies/'.$latest_movies_data->video_slug.'/'.$latest_movies_data->id) }}">
							<div class="sidebar_movie_item">
								@if(file_exists(public_path('upload/source/'.$latest_movies_data->video_image)))
								<img src="{{URL::to('upload/source/'.$latest_movies_data->video_image)}}" alt="show" />
								@else
								<img src="{{URL::to('upload/thumbs/'.$latest_movies_data->video_image)}}" alt="show" />
								@endif
							</div>
							<div class="playlist_content">
							  <h3>{{Str::limit(stripslashes($latest_movies_data->video_title),20)}}</h3>
							  <p class="vfx_video_length">{!!Str::limit(stripslashes(strip_tags($latest_movies_data->video_description)),50)!!}
							  </p>

							 </div>        
						  </a>
						</div>
						@endforeach
							   
					  </div> 

					    @if(get_ads('movie_single_ad_sidebar')->status!=0)
						<div class="add_banner_section">					     
						  <div class="row">
						    <div class="col-md-12">
						      {!!get_ads('movie_single_ad_sidebar')->ad_code!!}
						    </div>
						  </div>					     
						</div>
						@endif

					</div>
				  </div>                

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   
  <div class="section section-padding top-padding-normal vfx_movie_section_block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="vfx_section_header">
            <h2 class="vfx_section_title">{{trans('words.you_may_like')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="owl-carousel video-carousel" id="video-carousel">
          @foreach($related_movies_list as $movies_data)            
           @if(Auth::check())              
          <a class="icon" href="{{ URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id) }}"> 
	      @else
	         @if($movies_data->video_access=='Paid')
	          <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
	         @else
	          <a class="icon" href="{{ URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id) }}">
	         @endif  
	      @endif	
           <div class="vfx_video_item">
              <div class="thumb-wrap"> <img src="{{URL::to('upload/source/'.$movies_data->video_image_thumb)}}" alt="Movie Thumb"> @if($movies_data->video_access=='Paid')<span class="premium_video"><i class="fa fa-lock"></i>Premium</span>@endif
                <div class="thumb-hover"> 
            
                <i class="icon fa fa-play"></i><span class="ripple"></span>
            
              </div>
              </div>
              <div class="vfx_video_detail">
                <h4 class="vfx_video_title">{{Str::limit(stripslashes($movies_data->video_title),12)}}</h4>
                <p class="vfx_video_length"><i class="fa fa-clock-o"></i> {{$movies_data->duration}}</p>                
               </div>
            </div>
          </a>
          @endforeach
       
        </div>
      </div>
    </div>
  </div>

</div>

	@if(get_ads('movie_single_ad_bottom')->status!=0)
	<div class="add_banner_section">					     
	  <div class="row">
	    <div class="col-md-12">
	      {!!get_ads('movie_single_ad_bottom')->ad_code!!}
	    </div>
	  </div>					     
	</div>
	@endif 


 
@endsection