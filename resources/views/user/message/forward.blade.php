            {!!Form::vertical_open()
                ->id('forward-message-message')
                ->method('POST')
                ->files('true')
                ->action(URL::to('user/message/message'))!!}
                {!! Form::hidden('status')
                 -> forceValue("Sent")!!}
                 {!! Form::hidden('subject')!!}
            <table class="table  table-striped">
                <tbody>
                 	
                    <tr>
                        <td colspan="4">
                        {!! Form::select('mails[]')
                        -> options(trans('message::message.options.type'))
                        -> class('js-example-tags select2-hidden-accessible')
                        -> style('width:100%')
                        -> multiple()
                        -> required()!!}
                        </td>
                    </tr>
                            {!! Form::hidden('subject')
                            -> value("Fwd: ".$message['subject']) !!}
                    <tr>
                        <td colspan="4">
                            {!! Form::textarea ('message')
                            -> placeholder("Message")
                            -> value($message['message'])
                            -> required()
                            -> rows(6)
                            -> raw()!!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn-primary" id="forward-send"><i class="fa fa-check"></i> Send</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}
            <link rel="stylesheet" type="text/css" href="https://select2.github.io/dist/css/select2.min.css">
            <script type="text/javascript" src="https://select2.github.io/dist/js/select2.full.js"></script>       

            <script type="text/javascript">
            $(".js-example-tags").select2({
                  tags: true
                });
            $(document).ready(function(){
                $('#forward-send').click(function(){
                    $('#forward-message-message').submit();
                });
                $('#forward-message-message').submit( function( e ) {
                    if($('#forward-message-message').valid() == false) {
                        toastr.error('Unprocessable entry.', 'Warning');
                        return false;
                    }
                    var url  = $(this).attr('action');
                    var formData = new FormData( this );
                    $.ajax( {
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend:function()
                        {
                            $('#forward-send').prop('disabled',true);
                            $('#forward-close').prop('disabled',true);
                        },
                        success:function(data, textStatus, jqXHR)
                        {
                            $('#entry-message').load('{{URL::to('user/message/status/Inbox')}}');
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                        }
                    });
                    e.preventDefault();
                });
            });
            </script>
