  <div class="row">

               <div class='col-md-4 col-sm-6'>{!! Former::text('from')
               -> label(trans('message::message.label.from'))
               -> placeholder(trans('message::message.placeholder.from'))!!}
               </div>

               <div class='col-md-4 col-sm-6'>{!! Former::text('to')
               -> label(trans('message::message.label.to'))
               -> placeholder(trans('message::message.placeholder.to'))!!}
               </div>

               <div class='col-md-4 col-sm-6'>{!! Former::text('subject')
               -> label(trans('message::message.label.subject'))
               -> placeholder(trans('message::message.placeholder.subject'))!!}
               </div>

               <div class='col-md-4 col-sm-6'>{!! Former::text('message')
               -> label(trans('message::message.label.message'))
               -> placeholder(trans('message::message.placeholder.message'))!!}
               </div>
        </div>