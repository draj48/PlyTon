@extends('site_app') 

@if($episode_info->seo_title)
  @section('head_title', stripslashes($episode_info->seo_title).' | '.getcong('site_name'))
@else
  @section('head_title', $series_name.' '.$season_name.' '.stripslashes($episode_info->video_title).' | '.getcong('site_name'))
@endif

@if($episode_info->seo_description)
  @section('head_description', stripslashes($episode_info->seo_description))
@else
  @section('head_description', Str::limit(stripslashes($episode_info->video_description),160))
@endif

@if($episode_info->seo_keyword)
  @section('head_keywords', stripslashes($episode_info->seo_keyword)) 
@endif

@section('head_image', URL::to('upload/source/'.$episode_info->video_image))

@section('head_url', Request::url())

@section('content')
  
 <script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>

 @if(get_player_cong('player_style')!="")  
 	<link href="{{ URL::asset('site_assets/videojs_player/css/'.get_player_cong('player_style').'.min.css') }}" rel="stylesheet" type="text/css" />    
 @else
	<link href="{{ URL::asset('site_assets/videojs_player/css/videojs_style1.min.css') }}" rel="stylesheet" type="text/css" />
 @endif

  
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
						  <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_info->video_slug.'/'.$episode_info->id) }}">
						  <div class="video-js vjs-big-play-centered skin-blue vjs-16-9 vjs-paused v_player-dimensions vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active vjs-cast-button">
							  
							  <div class="vjs-poster" aria-disabled="false" style="background-image: url({{URL::to('upload/source/'.$episode_info->video_image)}});"></div>

							  <button class="vjs-big-play-button" type="button" title="Play Video" aria-disabled="false"><span aria-hidden="true" class="vjs-icon-placeholder"></span><span class="vjs-control-text" aria-live="polite">Play Video</span></button>
							  
						  </div>
						</a>
					  </div>
						
					  </main> 

					  <div id="theater_mode_width">

					  <h3 class="vfx_video_title">{{stripslashes($series_name)}}</h3>
					  <!--<p class="video-release-date"><i class="fa fa-calendar"></i> 12 Jan 2019</p>-->
					  <ul class="channel_content_info">
 

					  <li style="font-size: 16px;">{{stripslashes($episode_info->video_title)}}</li>
					  <li style="font-size: 16px;">{{App\Season::getSeasonInfo($episode_info->episode_season_id,'season_name')}}</li>
					  @if($episode_info->release_date)
						<li><i class="fa fa-calendar"></i> {{ isset($episode_info->release_date) ? date('M d Y',$episode_info->release_date) : null }}</li>
						@endif 
					   @if($episode_info->duration) 
					   <li><i class="fa fa-clock-o"></i> {{$episode_info->duration}}</li>
					   @endif
						 @if($episode_info->imdb_rating) 
						 <li><img src="{{URL::to('site_assets/images/icons/imdb-logo.png')}}" alt="IMDb Rating"> &nbsp;<b>{{$episode_info->imdb_rating}}</b></li>
						 @endif

						@if($series_content_rating) 
						 <li>					  	 
					  	 	<span class="channel_info_count">{{$series_content_rating}}</span>
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
											<a href="https://twitter.com/intent/tweet?text={{$episode_info->video_title}}&amp;url={{url()->current()}}"><i class="fa fa-twitter"></i></a>
											<a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&media={{URL::to('upload/source/'.$episode_info->video_image)}}&description={{$episode_info->video_title}}"><i class="fa fa-pinterest"></i></a>
											<a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>

										</div>
									</div>
								</div>
								<div class="col-md-7 col-xs-12">
									<div class="news-tag">
										 @foreach(explode(',',$series_genres_ids) as $genres_ids)
										<p><b><a href="{{ URL::to('genres/series/'.App\Genres::getGenresInfo($genres_ids,'genre_slug')) }}">{{App\Genres::getGenresInfo($genres_ids,'genre_name')}}</a></b></p>
										@endforeach
										<p><a href="{{ URL::to('language/series/'.App\Language::getLanguageInfo($series_lang_id,'language_slug')) }}"><b>{{App\Language::getLanguageInfo($series_lang_id,'language_name')}}</b></a></p>
									</div>
								</div>
							</div>
						</div>  
					  </div> 
						
						<div class="clearfix"></div> 	
						@if(get_ads('episode_single_ad_top')->status!=0)
						<div class="add_banner_section">               
						  <div class="row">
							<div class="col-md-12">
							  {!!get_ads('episode_single_ad_top')->ad_code!!}
							</div>
						  </div>               
						</div>
						@endif

					  <div class="single-section video-entry mr-top-20" id="episodes_all">
						  <h3 class="single-vfx_section_title">{{trans('words.description')}}</h3>
						  <div class="section-content">	
							@if(strlen($episode_info->video_description) > 500)
							<div class="listing-section">
							  <div class="show-more">
							  <div class="pricing-list-container">
								 {!!stripslashes($episode_info->video_description)!!}
							  </div>
							  </div>
							  <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a> 
							</div>
							@else
							{!!stripslashes($episode_info->video_description)!!} 	
							@endif    				
						  </div>
						</div>	

					 </div>	

					</div>
					<div class="col-md-4 col-sm-12 col-xs-12" id="right_sidebar_hide">             
					  <div class="sidebar_playlist series_sidebar_list">
						<div class="caption">
						   <div class="left"> <a href="#"><i class="fa fa-arrow-down"></i> {{trans('words.up_next')}}</a> </div>               
						   <div class="right"> <a href="#episodes_all">{{trans('words.view_all')}}</a> </div>
						  <div class="clearfix"></div>
						</div>
						@foreach($episode_up_next_list as $episode_up_next_data)
						<div class="playlist_item">
						  <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_up_next_data->video_slug.'/'.$episode_up_next_data->id) }}">
							<div class="sidebar_movie_item">
								<img src="{{URL::to('upload/source/'.$episode_up_next_data->video_image)}}" alt="show" />
							</div>	
							<div class="playlist_content">
							  <h3>{{Str::limit(stripslashes($episode_up_next_data->video_title),25)}}</h3>
                <p class="vfx_video_length">{!!Str::limit(stripslashes(strip_tags($episode_up_next_data->video_description)),50)!!}
                </p>
							 </div>        
						  </a>
						</div>
						@endforeach
							   
					  </div>

            @if(get_ads('episode_single_ad_sidebar')->status!=0)
            <div class="add_banner_section">               
              <div class="row">
                <div class="col-md-12">
                  {!!get_ads('episode_single_ad_sidebar')->ad_code!!}
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
            <h2 class="vfx_section_title">{{trans('words.episodes_text')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="owl-carousel video-carousel" id="video-carousel">
          
          @foreach($episode_list as $episode_data)
          
          @if(Auth::check())              
              <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_data->video_slug.'/'.$episode_data->id) }}">
          @else
             @if($episode_data->video_access=='Paid')
              <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
             @else
              <a href="{{ URL::to('series/'.$series_slug.'/'.$episode_data->video_slug.'/'.$episode_data->id) }}">
             @endif  
          @endif  
          <div class="vfx_video_item">
            <div class="vfx_upcomming_item_block"> 
              <img src="{{URL::to('upload/source/'.$episode_data->video_image)}}" alt="{{$episode_data->video_title}}">
              @if($episode_data->video_access=='Paid')<span class="premium_video"><i class="fa fa-lock"></i>Premium</span>@endif                             
            </div>
            <div class="vfx_video_detail">
              <h4 class="vfx_video_title">{{Str::limit(stripslashes($episode_data->video_title),10)}}</h4>
             </div>
          </div>
          </a> 
          @endforeach

        </div>
      </div>
    </div>
  </div>

  <div class="section section-padding vfx_movie_section_block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="vfx_section_header">
            <h2 class="vfx_section_title">{{trans('words.seasons_text')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="owl-carousel video-carousel vfx_tvshow_carousel" id="vfx_tvshow_carousel">
        @foreach($season_list as $season_data)
            <a href="{{ URL::to('series/'.$series_slug.'/seasons/'.$season_data->season_slug.'/'.$season_data->id) }}">
             <div class="vfx_video_item">
                <div class="vfx_upcomming_item_block">
					<img class="img-responsive" src="{{URL::to('upload/source/'.$season_data->season_poster)}}" alt="{{$season_data->season_name}}"> 
				</div>	
                <div class="vfx_video_detail">
                  <h4 class="vfx_video_title">{{Str::limit(stripslashes($season_data->season_name),25)}}</h4>
                </div>                         
             </div>
            </a>
        @endforeach   
        </div>         
      </div>
    </div>
  </div>   
</div>

@if(get_ads('episode_single_ad_bottom')->status!=0)
<div class="add_banner_section">               
  <div class="row">
    <div class="col-md-12">
      {!!get_ads('episode_single_ad_bottom')->ad_code!!}
    </div>
  </div>               
</div>
@endif
 
@endsection