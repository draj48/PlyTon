@extends('site_app')

@section('head_title', $ad_info->ad_name.' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')


<div class="page-header">
  <div class="vfx_page_header_overlay">
    <div class="container">
      <div class="vfx_breadcrumb">
		  <ul>
			<li><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
			<li>{{$ad_info->ad_name}}</li>
		  </ul>       
	  </div>	  
    </div>
  </div>
</div>
 
 
 <div class="main-wrap">
  <div class="section section-padding tv_show vfx_video_list_section text-white">
    <div class="container">

      <div class="col-md-12 col-sm-12 col-xs-12 actors-member-single-item">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
          <div class="actors-member-item">
              @if($ad_info->ad_image) 
                <img src="{{URL::to('upload/thumbs/'.$ad_info->ad_image)}}" alt="video image" class="thumb-lg bdr_radius"> 
              @else
                <img src="{{URL::to('images/user_icon.png')}}" alt="star image" class="thumb-lg bdr_radius"> 
              @endif
              <span>{{$ad_info->ad_name}}</span>          
          </div> 
        </div>                                    
      </div>
      <div class="vfx-tabs-item">
            @if(getcong('menu_movies'))
                <input checked="checked" id="tab1" type="radio" name="pct" />
            @else

              @if(getcong('menu_shows'))
                <input checked="checked" id="tab2" type="radio" name="pct" />
              @endif

            @endif
            <input id="tab2" type="radio" name="pct" />
            <input id="tab3" type="radio" name="pct" />
            <nav>
            <ul>
              @if(getcong('menu_movies'))
              <li class="tab1">
              <label for="tab1">{{trans('words.movies_text')}}</label>
              </li>
              @endif

              @if(getcong('menu_shows'))
              <li class="tab2">
              <label for="tab2">{{trans('words.tv_shows_text')}}</label>
              </li>
              @endif 
            </ul>
            </nav>
            <section class="tabs_item_block">
                @if(getcong('menu_movies'))
                <div class="tab1">

                    <div class="row">
          
                    <div class="show-listing vfx_movie_list_item">
                     
                  @foreach($movies_list as $movies_data)      
                  @if(Auth::check())              
                      <a class="icon" href="{{ URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id) }}"> 
                  @else
                     @if($movies_data->video_access=='Paid')
                      <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
                     @else
                      <a class="icon" href="{{ URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id) }}">
                     @endif  
                  @endif
                  <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="vfx_video_item">
                          <div class="thumb-wrap"> <img src="{{URL::to('upload/source/'.$movies_data->video_image_thumb)}}" alt="{{$movies_data->video_title}}">
                            @if($movies_data->video_access=='Paid')<span class="premium_video"><i class="fa fa-lock"></i>Premium</span>@endif

                            <div class="thumb-hover"> 
                     
                      <i class="icon fa fa-play"></i><span class="ripple"></span>
                     
                      </div>
                          </div>
                          <div class="vfx_video_detail">
                            <h4 class="vfx_video_title"><a href="{{ URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id) }}">{{Str::limit(stripslashes($movies_data->video_title),12)}}</a></h4>
                            <p class="vfx_video_length"><i class="fa fa-clock-o"></i> {{$movies_data->duration}}</p>
                           </div>
                        </div>
                  </div>  
                  </a>
 
                  @endforeach 
              
                    
                    </div>    
                  </div>

                </div> 
                @endif 

                @if(getcong('menu_shows'))
                <div class="tab2">

                    <div class="row">
 
                      <div class="show-listing series_listing_view">
                    
                    @foreach($series_list as $series_data)    
                    <a href="{{ URL::to('series/'.$series_data->series_slug.'/'.$series_data->id) }}">  
                      <div class="col-md-3 col-sm-4 col-xs-6 sm-top-30">
                        <div class="vfx_upcomming_item_block"> 
                      <div class="series_view_img">
                      <img class="img-responsive" src="{{URL::to('upload/source/'.$series_data->series_poster)}}" alt="show">
                      </div>  
                      <div class="vfx_upcomming_detail">
                      <h4 class="vfx_video_title">{{Str::limit(stripslashes($series_data->series_name),25)}}</h4>          
                      </div>            
                        </div>                  
                      </div>
                    </a>
                    @endforeach        
                     
                      </div>    
                    </div>

                </div> 
                @endif 
            </section>
            
      </div>        
      
    </div>
  </div>
</div>
     
@endsection