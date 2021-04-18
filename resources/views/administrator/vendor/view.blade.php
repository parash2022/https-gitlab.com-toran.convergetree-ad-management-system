@extends('administrator.layouts.oreo')

@section('content')

@include('administrator.notices.flash')

<div class="br-section-wrapper">
    <div class="table-top">
        <div class="tt__title-area mb-4">
          
            <div class="row">
                <div class="col-md-4">
                    <h6 class="br-section-label">Vendor detail</h6>
                </div>
            </div>
        
        </div>
    </div>

<div class="content__body vendor__detail-wrap">
        <div class="vendor__reg-group bg-light p-4 rouned mb-5">
          <h3 class="font-weight-bold mb-4">Vendor Profile</h3>
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Category')}}</label>
                <span class="d-inline-block vertical-align-top">
                  @isset($user->terms)
                      @if(!$user->terms->isEmpty())
                          <ul>
                          @foreach($user->terms as $term)
                          <li>{{$term->name}}</li>
                          @endforeach
                        </ul>
                      @endif
                  @endif
                </span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Weight')}}</label>
                @isset($user->vendorProfile->points)
                    <span><a href="#" data-toggle="modal" data-target="#weightModal">{{$user->vendorProfile->points}} <i class="fa fa-question-circle"></i></a></span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Company name')}}</label>
                @isset($user->vendorProfile->name)
                    <span>{{$user->vendorProfile->name}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Address')}}</label>
                @isset($user->vendorProfile->address)
                    <span>{{$user->vendorProfile->address}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Date of registration')}}</label>
               @isset($user->vendorProfile->date_of_registration)
                    <span>{{$user->vendorProfile->date_of_registration}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('No of experience years')}}</label>
                @isset($user->vendorProfile->no_of_experience_years)
                    <span>{{$user->vendorProfile->no_of_experience_years}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('No of clients')}}</label>
                @isset($user->vendorProfile->no_of_clients)
                    <span>{{$user->vendorProfile->no_of_clients}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Registration no')}}</label>
                @isset($user->vendorProfile->registration_no)
                    <span>{{$user->vendorProfile->registration_no}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('PAN/VAT no')}}</label>
                @isset($user->vendorProfile->pan_or_vat_no)
                    <span>{{$user->vendorProfile->pan_or_vat_no}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Last year turnover')}}</label>
                @isset($user->vendorProfile->last_year_turnover)
                    <span>{{$user->vendorProfile->last_year_turnover}}</span>
                @endif
              </div>
            </div> 
          </div>
        </div>
        <div class="vendor__reg-group bg-light p-4 rouned mb-5">
          <h3 class="font-weight-bold  mb-4">Contact</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Contact person name')}}</label>
                @isset($user->vendorContact->name)
                    <span>{{$user->vendorContact->name}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Contact person email')}}</label>
                @isset($user->vendorContact->email)
                    <span>{{$user->vendorContact->email}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Contact person mobile')}}</label>
                @isset($user->vendorContact->mobile)
                    <span>{{$user->vendorContact->mobile}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Office phone')}}</label>
               @isset($user->vendorContact->office_phone)
                    <span>{{$user->vendorContact->office_phone}}</span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>{{__('Office email')}}</label>
                @isset($user->vendorContact->office_email)
                    <span>{{$user->vendorContact->office_email}}</span>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="vendor__reg-group bg-light p-4 rouned mb-5">
          <h3 class="font-weight-bold  mb-4">Documents</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="d-block">{{__('Company registration')}}</label>
                @isset($user->vendorDocument->company_registration)
                @if(Storage::disk('public')->exists($user->vendorDocument->company_registration))
                <a href="{{Storage::disk('public')->url($user->vendorDocument->company_registration)}}" download>Download</a>
                @endif
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="d-block">{{__('PAN/VAT registration')}}</label>
               @isset($user->vendorDocument->pan_vat_registration)
               @if(Storage::disk('public')->exists($user->vendorDocument->tax_clearance))
               <a href="{{Storage::disk('public')->url($user->vendorDocument->pan_vat_registration)}}" download>Download</a>
               @endif
               @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="d-block">{{__('Tax Clearance')}}</label>
               @isset($user->vendorDocument->tax_clearance)
               @if(Storage::disk('public')->exists($user->vendorDocument->tax_clearance))
               <a href="{{Storage::disk('public')->url($user->vendorDocument->tax_clearance)}}" download>Download</a>
               @endif
               @endif
              </div>
            </div>
          </div>
        </div>

</div>
   
</div>

<div class="modal fade" id="weightModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Weight detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body point-table">
        <?php  
        $vendorConfig = Config('vendor'); 
        $experience = 0;
        $clients = 0;
        $turnover = 0;
        ?>
        <ul>
          <li>
            <label class="font-weight-bold">Experience</label>
              @isset($user->vendorProfile->no_of_experience_years)
                  <span>{{$user->vendorProfile->no_of_experience_years}} years</span>
                  @isset($vendorConfig['experience'][$user->vendorProfile->no_of_experience_years])
                  <?php $experience =$vendorConfig['experience'][$user->vendorProfile->no_of_experience_years]; ?>
                  <span>{{$experience}} out of 20 points</span>
                  @endisset
              @endif
          </li>
          <li>
            <label class="font-weight-bold">Clients</label> 
           @isset($user->vendorProfile->no_of_clients)
                  <span>{{$user->vendorProfile->no_of_clients}}</span>
                  @isset($vendorConfig['clients'][$user->vendorProfile->no_of_clients])
                   <?php $clients =$vendorConfig['clients'][$user->vendorProfile->no_of_clients]; ?>
                  <span>{{$clients}} out of 20 points</span>
                  @endisset
              @endif
          </li>
          <li>
            <label class="font-weight-bold">Turnover</label>
            @isset($user->vendorProfile->last_year_turnover)
                  <span>{{$user->vendorProfile->last_year_turnover}}</span>
                  @isset($vendorConfig['turnover'][$user->vendorProfile->last_year_turnover])
                  <?php $turnover =$vendorConfig['turnover'][$user->vendorProfile->last_year_turnover]; ?>
                  <span>{{$turnover}} out of 20 points</span>
                  @endisset
              @endif
          </li>
          <li>
            <label></label>
            <span></span>
            <span>Total - {{$user->vendorProfile->points}}%</span>
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

@endsection
