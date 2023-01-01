@extends('site_app')

@section('head_title', trans('words.my_watchlist').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')


<div class="page-header">
  <div class="vfx_page_header_overlay">
    <div class="container">
      <div class="vfx_breadcrumb">
		  <ul>
			<li><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
			<li>{{trans('words.my_watchlist')}}</li>
		  </ul>       
	  </div>	  
    </div>
  </div>
</div>
 
 
 <div class="main-wrap">
  <div class="section section-padding tv_show vfx_video_list_section text-white">
    <div class="container">
      <div class="row">
          
        <div class="show-listing series_listing_view">
         
      @foreach($my_watchlist as $watchlist_data)      
      
      @if($watchlist_data->post_type=="Movies")

          <a href="{{ URL::to('movies/'.App\Movies::getMoviesInfo($watchlist_data->post_id,'video_slug').'/'.App\Movies::getMoviesInfo($watchlist_data->post_id,'id')) }}">  
              <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
                <div class="vfx_upcomming_item_block"> 
              <div class="series_view_img">
              <img class="img-responsive" src="{{URL::to('upload/source/'.App\Movies::getMoviesInfo($watchlist_data->post_id,'video_image_thumb'))}}" alt="show">
              </div>  
              <div class="vfx_upcomming_detail">
              <h4 class="vfx_video_title">{{ Str::limit(stripslashes(App\Movies::getMoviesInfo($watchlist_data->post_id,'video_title')),25)}}</h4>  
                <br/>
                <a href="{{URL::to('watchlist/remove')}}?post_id={{$watchlist_data->post_id}}&post_type=Movies" style="color: #eb1536;background: rgba(0, 0, 0, 0.06);    padding: 5px 15px;border-radius: 6px;display: inline-block;"><i class="fa fa-check"></i> REMOVE FROM WATCHLIST</a>          
              </div>            
                </div>                  
              </div>
          </a>
           
        @endif  

        @if($watchlist_data->post_type=="Shows")

          <a href="{{ URL::to('series/slug/'.App\Episodes::getEpisodesInfo($watchlist_data->post_id,'video_slug').'/'.$watchlist_data->post_id) }}">  
              <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
                <div class="vfx_upcomming_item_block"> 
              <div class="series_view_img">
              <img class="img-responsive" src="{{URL::to('upload/source/'.App\Episodes::getEpisodesInfo($watchlist_data->post_id,'video_image'))}}" alt="show">
              </div>  
              <div class="vfx_upcomming_detail">
              <h4 class="vfx_video_title">{{Str::limit(stripslashes(App\Episodes::getEpisodesInfo($watchlist_data->post_id,'video_title')),25) }}</h4>  
                <br/>
                <a href="{{URL::to('watchlist/remove')}}?post_id={{$watchlist_data->post_id}}&post_type=Shows" style="color: #eb1536;background: rgba(0, 0, 0, 0.06);    padding: 5px 15px;border-radius: 6px;display: inline-block;"><i class="fa fa-check"></i> REMOVE FROM WATCHLIST</a>          
              </div>            
                </div>                  
              </div>
           </a>
           
        @endif

        @if($watchlist_data->post_type=="Sports")

          <a href="{{ URL::to('sports/'.App\Sports::getSportsInfo($watchlist_data->post_id,'video_slug').'/'.App\Sports::getSportsInfo($watchlist_data->post_id,'id')) }}">  
              <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
                <div class="vfx_upcomming_item_block"> 
              <div class="series_view_img">
              <img class="img-responsive" src="{{URL::to('upload/source/'.App\Sports::getSportsInfo($watchlist_data->post_id,'video_image'))}}" alt="show">
              </div>  
              <div class="vfx_upcomming_detail">
              <h4 class="vfx_video_title">{{ Str::limit(stripslashes(App\Sports::getSportsInfo($watchlist_data->post_id,'video_title')),25)}}</h4>  
                <br/>
                <a href="{{URL::to('watchlist/remove')}}?post_id={{$watchlist_data->post_id}}&post_type=Sports" style="color: #eb1536;background: rgba(0, 0, 0, 0.06);    padding: 5px 15px;border-radius: 6px;display: inline-block;"><i class="fa fa-check"></i> REMOVE FROM WATCHLIST</a>          
              </div>            
                </div>                  
              </div>
          </a>
           
        @endif

        @if($watchlist_data->post_type=="LiveTV")

          <a href="{{ URL::to('live-tv/'.App\LiveTV::getLiveTvInfo($watchlist_data->post_id,'channel_slug').'/'.App\LiveTV::getLiveTvInfo($watchlist_data->post_id,'id')) }}">  
              <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
                <div class="vfx_upcomming_item_block"> 
              <div class="series_view_img">
              <img class="img-responsive" src="{{URL::to('upload/source/'.App\LiveTV::getLiveTvInfo($watchlist_data->post_id,'channel_thumb'))}}" alt="show">
              </div>  
              <div class="vfx_upcomming_detail">
              <h4 class="vfx_video_title">{{ Str::limit(stripslashes(App\LiveTV::getLiveTvInfo($watchlist_data->post_id,'channel_name')),25)}}</h4>  
                <br/>
                <a href="{{URL::to('watchlist/remove')}}?post_id={{$watchlist_data->post_id}}&post_type=LiveTV" style="color: #eb1536;background: rgba(0, 0, 0, 0.06);    padding: 5px 15px;border-radius: 6px;display: inline-block;"><i class="fa fa-check"></i> REMOVE FROM WATCHLIST</a>          
              </div>            
                </div>                  
              </div>
          </a>
           
        @endif

     
      @endforeach 
 
        
       
        </div>    
      </div>
    </div>
  </div>
</div>
    
    
@endsection