<div class="row">
  <div class="col-md-12">
    @forelse($messages as $message)
      <div class="row">

                              <div class="col-md-4 col-sm-6 ">
                                 <div class="form-group">
                                      <label for="from">{!! trans('message::message.label.from') !!}</label><br />
                                      {!! $message['from'] !!}
                                 </div>
                              </div>

                              <div class="col-md-4 col-sm-6 ">
                                 <div class="form-group">
                                      <label for="to">{!! trans('message::message.label.to') !!}</label><br />
                                      {!! $message['to'] !!}
                                 </div>
                              </div>

                              <div class="col-md-4 col-sm-6 ">
                                 <div class="form-group">
                                      <label for="subject">{!! trans('message::message.label.subject') !!}</label><br />
                                      {!! $message['subject'] !!}
                                 </div>
                              </div>

                              <div class="col-md-4 col-sm-6 ">
                                 <div class="form-group">
                                      <label for="message">{!! trans('message::message.label.message') !!}</label><br />
                                      {!! $message['message'] !!}
                                 </div>
                              </div>
        </div>
    @empty
    <p>No messages</p>
    @endif
  </div>
</div>