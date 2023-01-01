@extends('site_app')

@section('head_title', trans('words.subscription_plan').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section('content')
  
 
<div class="page-header">
  <div class="vfx_page_header_overlay">
    <div class="container">
      <div class="vfx_breadcrumb">
      <ul>
         <li><a href="{{ URL::to('dashboard') }}">{{trans('words.home')}}</a></li>
         <li>{{trans('words.subscription_plan')}}</li>      
      </ul>  
    </div>
  </div>
  </div>
</div>

<div class="main-wrap">
  <div class="section section-padding">
    <div class="container">

      @if ($message = Session::get('success'))
        <div class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
            {!! $message !!}
        </div>

        <?php Session::forget('success');?>
        @endif
        @if ($message = Session::get('error'))
        <div class="custom-alerts alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
            {!! $message !!}
        </div>
        <?php Session::forget('error');?>
        @endif

      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"><a href="#" class="pure-button btn btn-primary" onclick="open_coupon_apply_pop()">{{trans('words.have_coupon_code')}}</a></div>
      </div><br/>

      <div class="row">        

      @foreach($plan_list as $plan_data)  
      <div class="col-md-3 col-sm-4 col-xs-12">
      <div class="member-ship-option select_plan">
        <h5 class="color-up">{{$plan_data->plan_price}} <span>{{getcong('currency_code')}}</span><p class="premuim-memplan">For {{ App\SubscriptionPlan::getPlanDuration($plan_data->id) }}</p></h5>        
        <p>{{$plan_data->plan_name}}</p>
        <a href="{{ URL::to('payment_method/'.$plan_data->id) }}">{{trans('words.select_plan')}}</a>        
      </div>
      </div>
      @endforeach 
       
       
        </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<!-- Modal -->
<div id="coupon_apply_pop" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{trans('words.apply_coupon')}}</h4>
      </div>
      <div class="modal-body">
          @if ($message = Session::get('error_ref'))
            <div class="custom-alerts alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
                {!! $message !!}
            </div>
            <?php Session::forget('error_ref');?>
            @endif
        
          {!! Form::open(array('url' => 'apply_coupon_code','class'=>'','id'=>'change_pass','role'=>'form')) !!}
            <div class="row">
              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label>{{trans('words.coupon_code')}}:-</label>
                <input name="coupon_code" class="form-control" value="" type="text" required>  
              </div>             
               
              <div class="paste-mo bottom-border">
                <button type="submit" class="pure-button btn btn-primary">{{trans('words.submit')}}</button>  
              </div>
            </div>
          {!! Form::close() !!}
         
 
      </div>
       
    </div>

  </div>
</div>

<script type="text/javascript">
  function open_coupon_apply_pop(){

   jQuery("#coupon_apply_pop").modal("show");         
      return false;
}
</script> 

 
@endsection