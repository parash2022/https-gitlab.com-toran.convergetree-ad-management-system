@extends('administrator.layouts.oreo')

@section('content')

<div class="br-pagetitle">
        <div>
          <h4 class="mb-0"></h4>
        </div>
      </div>
	     <div class="br-section-wrapper">
        <div class="row row-sm mg-b-20">
          <div class="col-sm-6 col-xl-3 mg-b-10">
            <a href="{{route('administrator.ads.index')}}">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Ads</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['totalAds']}}</p>
                </div>
              </div>
              <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <a href="{{route('administrator.ads.index')}}?status=running">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Running Ads</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['runningAds']}}</p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div>
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <a href="{{route('administrator.ads.index')}}?status=scheduled">
            <div class="bg-purple rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Sheduled Ads</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['scheduled']}}</p>
                </div>
              </div>
              <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div>
           <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <a href="{{route('administrator.ads.index')}}?status=going-to-expire">
            <div class="bg-warning rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Going to expire</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['soonExpiry']}}</p>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div>
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0 ">
            <a href="{{route('administrator.ads.index')}}?status=expired">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Expired Ads</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['expired']}}</p>
                </div>
              </div>
              <div id="ch4" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div>
           <div class="col-sm-6 col-xl-3">
            <a href="{{route('administrator.clients.index')}}">
            <div class="bg-teal rounded overflow-hidden">
              <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Clients</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{$summary['totalClients']}}</p>
                </div>
              </div>
              <div id="ch2" class="ht-50 tr-y-1"></div>
            </div>
          </a>
          </div> 
         
        </div><!-- row -->

        </div>

@endsection

