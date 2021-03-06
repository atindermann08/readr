@extends('layouts.plain')

@section('cover')
@include('partials._carousel')
<div class='container'>
<div class='row usage'>
    <div class="col-md-4">
      <i class='fa fa-group fa-5x  usage-pic img-round'></i>
      <h2>Join Livrogo</h2>
      <p>Sign up using your email account. Activate your account and ensure to add
        'team@livrogo.com' to your contact list so that you dont miss any emails from us.</p>

    </div>
    <div class="col-md-4">
      <i class='fa fa-leanpub fa-5x  usage-pic img-round'></i>
      <h2>Manage Your Library</h2>
      <p>Add books you have in your library so that you can share those with your fellow members in bookclub.
      Note: You can only add books in bookclub those you have added in your library.</p>

    </div>
    <div class="col-md-4">
      <i class='fa fa-share-alt fa-5x  usage-pic img-round'></i>
      <h2>Interact</h2>
      <p>Request Books from your fellow members of bookclub you want want to read. Other members can request
        books added by you. You can Accept or Reject their books. Onc a book is shared with others by accepting
        request it becomes unavailable till it is received back.</p>
    </div>
  </div>
    <div class="row">
      <hr />
        <div class="col-md-7">
          <h2 class="featurette-heading">I think of life as a good book. The further you get into it, the more it begins to make sense.
            <p><small class="text-muted lead">-- Harold Kushner</small>
            </p>
          </h2>

        </div>
        <div class="col-md-5">
          <img class="img img-responsive center-block" src="{{ asset('assets/img/books4.jpg') }}" alt="Generic placeholder image">
        </div>
      </div>

      <hr/>

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">There is a great deal of difference between an eager man who wants to read a book and the tired man who wants a book to read.
          <p><small class="text-muted lead">-- Gilbert K. Chesterton</small></p>
          </h2>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="img img-responsive center-block" src="{{ asset('assets/img/books5.jpg') }}" alt="Generic placeholder image">
        </div>
      </div>

      <hr/>

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">A great book should leave you with many experiences, and slightly exhausted at the end. You live several lives while reading.
          </h2>
          <p><span class="text-muted lead">-- William Styron</span><p>
        </div>
        <div class="col-md-5">
          <img class="img img-responsive center-block" src="{{ asset('assets/img/books6.jpg') }}" alt="Generic placeholder image">
        </div>
      </div>

      <hr/>
  </div>
@stop()
