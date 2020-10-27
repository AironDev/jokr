@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{asset('assets/faq/css/style.css')}}">
<script>document.getElementsByTagName("html")[0].className += " js";</script>
<header class="cd-header flex flex-column flex-center">
  <div class="text-component text-center">
    <h1>FAQ</h1>
  </div>
</header>

<section class="cd-faq js-cd-faq container max-width-md margin-top-lg margin-bottom-lg">
    <ul class="cd-faq__categories">
        @foreach($categories as $category)
            <li><a class="cd-faq__category truncate" href="#{{ $category->name }}">{{ $category->name }}</a></li>
        @endforeach
    </ul> <!-- cd-faq__categories -->

    <div class="cd-faq__items">
    @foreach($categories as $category)
        <ul id="{{ $category->name }}" class="cd-faq__group">
            <li class="cd-faq__title"><h2>{{$category->name}}</h2></li>
            @foreach($category->faqs as $faq)
            <li class="cd-faq__item">
                <a class="cd-faq__trigger" href="#0"><span>{{$faq->question}}</span></a>
                <div class="cd-faq__content">
                    <div class="text-component">
                        <p>{{$faq->answer}}</p>
                    </div>

                    <div id="faq-footer-{{ $faq->id }}" class="card-footer" style="border-top: 1px solid #ddd;">
                        <div class="btn-group btn-group-sm">
                            @csrf
                            <span class="btn" style="padding-left: 0px;">Was this question helpful?</span>
                            <a class="btn btn-success btn-helpful mx-3" href="#" data-id="{{ $faq->id }}" data-type="helpful_yes">
                                <i class="fa fa-thumbs-up"></i> Yes
                            </a>
                            <a class="btn btn-danger btn-helpful mx-3" href="#" data-id="{{ $faq->id }}" data-type="helpful_no">
                                <i class="fa fa-thumbs-down"></i> No
                            </a>
                        </div>
                    </div>
                </div> <!-- cd-faq__content -->
            </li>
             @endforeach
        </ul> <!-- cd-faq__group -->
       
    @endforeach
    </div> <!-- cd-faq__items -->

    <a href="#0" class="cd-faq__close-panel text-replace">Close</a>
  
  <div class="cd-faq__overlay" aria-hidden="true"></div>
</section> <!-- cd-faq -->

@endsection

@section('js')
    @Include('partials.js')
   


    <script type="text/javascript" charset="utf-8">
        $(document).ready(function () {
            $('#faq-box')
                .on('show.bs.collapse', function (e) {
                    $.post('/faq/question/' + $(e.target).attr('data-id'));

                    $(e.target).parents('.card').addClass('card-info');
                })
                .on('hide.bs.collapse', function (e) {
                    $(e.target).parents('.card').removeClass('card-info');
                });

            $('.btn-helpful').on('click', function (e) {
                e.preventDefault();
                
                // show spinner
                var $footer = $('#faq-footer-' + $(this).attr('data-id'));
                $footer.html("<i class=\"fa fa-spinner fa-spin text-primary text-sm\"></i>");

                // post and show response
                // $.post('/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'), function () {
                //     $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
                // });
                
                $.ajax({
                  headers: {
                  'X-CSRF-TOKEN': $('input[name$="_token"]').attr('value')
                  },
                  url: '/faq/question/' + $(this).attr('data-id') + '/' + $(this).attr('data-type'),
                  
                  type: 'POST',
                  data: {},
                  contentType: false,
                  processData: false,
                  success:function(response) {
                       console.log(response);
                       $footer.html("<div><small><span class=\"text-muted\">Thank you for your feedback.</span></small></div>");
                  }
                });
                return false;
            });
        })
    </script>

     <script src="{{asset('assets/faq/js/util.js')}}"></script> <!-- util functions included in the CodyHouse framework -->
    <script src="{{asset('assets/faq/js/main.js')}}"></script> 


@endsection