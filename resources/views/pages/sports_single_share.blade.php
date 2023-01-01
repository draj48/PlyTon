@extends('site_app')
 

@if($sports_info->seo_title)
	@section('head_title', stripslashes($sports_info->seo_title).' | '.getcong('site_name'))
@else
	@section('head_title', stripslashes($sports_info->video_title).' | '.getcong('site_name') )
@endif

@if($sports_info->seo_description)
	@section('head_description', stripslashes($sports_info->seo_description))
@else
	@section('head_description', Str::limit(stripslashes($sports_info->video_description),160))
@endif

@if($sports_info->seo_keyword)
	@section('head_keywords', stripslashes($sports_info->seo_keyword)) 
@endif


@section('head_image', URL::to('upload/source/'.$sports_info->video_image) )

@section('head_url', Request::url())

@section('content')
  

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

					  	<a href="{{ URL::to('sports/'.$sports_info->video_slug.'/'.$sports_info->id) }}">
              <div class="video-js vjs-big-play-centered skin-blue vjs-16-9 vjs-paused v_player-dimensions vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active vjs-cast-button">
                
                <div class="vjs-poster" aria-disabled="false" style="background-image: url({{URL::to('upload/source/'.$sports_info->video_image)}});"></div>

                <button class="vjs-big-play-button" type="button" title="Play Video" aria-disabled="false"><span aria-hidden="true" class="vjs-icon-placeholder"></span><span class="vjs-control-text" aria-live="polite">Play Video</span></button>
                
              </div>
            </a> 

					  </main> 

					  <div id="theater_mode_width">

					  <h3 class="vfx_video_title">{{stripslashes($sports_info->video_title)}}</h3> 

					  @if(Session::has('flash_message'))
              <div class="alert alert-success">
              	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                  {{ Session::get('flash_message') }}
              </div>
            @endif

					  <ul class="channel_content_info">
					  	<li>					  	 
					  	 	<i class="fa fa-eye"></i> {{number_format_short($sports_info->views)}} {{trans('words.video_views')}}
					  	</li>
					  	
						@if($sports_info->date)
						<li><i class="fa fa-calendar"></i> {{ isset($sports_info->date) ? date('M d Y',$sports_info->date) : null }}</li>
						@endif 
					   @if($sports_info->duration) 
					   <li><i class="fa fa-clock-o"></i> {{$sports_info->duration}}</li>
					   @endif

					   @if($sports_info->download_enable)
					   <li>
					   	  <div class="video_download_btn">
							 <a href="{{$sports_info->download_url}}" target="_blank"><i class="fa fa-download"></i> {{trans('words.download')}}</a> 
							 						
						  </div>
					   </li>
					   @endif

					   <li>
			             <div class="video_download_btn">
			              @if(Auth::check()) 
				               @if(check_watchlist(Auth::user()->id,$sports_info->id,'Sports'))
				               	<a href="{{URL::to('watchlist/remove')}}?post_id={{$sports_info->id}}&post_type=Sports" ><i class="fa fa-check"></i> {{trans('words.remove_from_watchlist')}}</a>
				               @else
				               	<a href="{{URL::to('watchlist/add')}}?post_id={{$sports_info->id}}&post_type=Sports" ><i class="fa fa-plus-square"></i> {{trans('words.add_to_watchlist')}}</a>
				               @endif  
			              @else
			              	<a href="{{URL::to('watchlist/add')}}?post_id={{$sports_info->id}}&post_type=Sports" ><i class="fa fa-plus-square"></i> {{trans('words.add_to_watchlist')}}</a>
			              @endif 
			              </div>
			          </li>

					  </ul> 
					  <div class="video-attributes dtl_video">
						<div class="single-footer">
							<div class="row">
								<div class="col-md-5 col-xs-12">
									<div class="news-share">
										<label>{{trans('words.share_text')}}: </label>
										<div class="share-social">
											<a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook"></i></a>
											<a href="https://twitter.com/intent/tweet?text={{$sports_info->video_title}}&amp;url={{url()->current()}}"><i class="fa fa-twitter"></i></a>
											<a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&media={{URL::to('upload/source/'.$sports_info->video_image)}}&description={{$sports_info->video_title}}"><i class="fa fa-pinterest"></i></a>
											<a href="https://wa.me?text={{url()->current()}}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-7 col-xs-12">
									 
								</div>
							</div>
						</div> 							  
					  </div>
					  <div class="clearfix"></div> 	
					  @if(get_ads('sports_single_ad_top')->status!=0)
					  <div class="add_banner_section">					     
					      <div class="row">
					        <div class="col-md-12">
					          {!!get_ads('sports_single_ad_top')->ad_code!!}
					        </div>
					      </div>					     
					  </div>
					  @endif

					  <div class="single-section video-entry mr-top-20" id="episodes_all">
						  <h3 class="single-vfx_section_title">{{trans('words.description')}}</h3>
						  <div class="section-content">
							@if(strlen($sports_info->video_description) > 500)
							<div class="listing-section">
								  <div class="show-more">
									<div class="pricing-list-container">
									   {!!stripslashes($sports_info->video_description)!!}
									</div>
								  </div>
								  <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a> 
							</div>
							@else
                				{!!stripslashes($sports_info->video_description)!!}
							@endif
						  </div>
						</div>	

					</div>	

					</div>
					<div class="col-md-4 col-sm-12 col-xs-12" id="right_sidebar_hide">             
					  <div class="sidebar_playlist sports_sidebar_list">
						<div class="caption">
						   <div class="left"> <a href="#"><i class="fa fa-list"></i> {{trans('words.latest_video')}}</a> </div>               
						   <div class="clearfix"></div>
						</div>
						@foreach($latest_sports_list as $latest_sports_data)
						<div class="playlist_item">
						  <a href="{{ URL::to('sports/'.$latest_sports_data->video_slug.'/'.$latest_sports_data->id) }}">
							<div class="vfx_upcomming_item_block">
								<img src="{{URL::to('upload/source/'.$latest_sports_data->video_image)}}" alt="{{$latest_sports_data->video_title}}" />
							</div>
							<div class="playlist_content">
							  <h3>{{Str::limit(stripslashes($latest_sports_data->video_title),20)}}</h3>
							  <p class="vfx_video_length">{!!Str::limit(stripslashes(strip_tags($latest_sports_data->video_description)),50)!!}</p>
							 </div>        
						  </a>
						</div>
						@endforeach
							   
					  </div> 

					    @if(get_ads('sports_single_ad_sidebar')->status!=0)
						<div class="add_banner_section">					     
						  <div class="row">
						    <div class="col-md-12">
						      {!!get_ads('sports_single_ad_sidebar')->ad_code!!}
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
        <div class="owl-carousel video-carousel vfx_tvshow_carousel" id="vfx_tvshow_carousel">
        @foreach($related_sports_list as $sports_data)
            <a href="{{ URL::to('sports/'.$sports_data->video_slug.'/'.$sports_data->id) }}">
             <div class="vfx_video_item">
                <div class="vfx_upcomming_item_block"> 
					<img class="img-responsive" src="{{URL::to('upload/source/'.$sports_data->video_image)}}" alt="show"> 
				</div>
                <div class="vfx_upcomming_detail">
                  <h4 class="vfx_video_title">{{Str::limit(stripslashes($sports_data->video_title),25)}}</h4>
                </div>                                         
			 </div>
           </a>
        @endforeach
        </div>         
      </div>
    </div>
  </div>
   
</div>

@if(get_ads('sports_single_ad_bottom')->status!=0)
<div class="add_banner_section">					     
  <div class="row">
    <div class="col-md-12">
      {!!get_ads('sports_single_ad_bottom')->ad_code!!}
    </div>
  </div>					     
</div>
@endif

@endsection