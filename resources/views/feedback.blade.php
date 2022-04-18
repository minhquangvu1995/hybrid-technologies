<x-layout>
    <x-slot name="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Employee name</th>
                                <th>Comment</th>
                                <th>Written at</th>
                                <th style="width: 15%">Reply</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($feedbackList->isNotEmpty())
                                @foreach($feedbackList as $feedback)
                                    <tr>
                                        <td>{{$feedback->user->name}}</td>
                                        <td>{{$feedback->comment}}</td>
                                        <td>{{$feedback->created_at}}</td>
                                        <td>
                                            @role('admin')
                                                <a class="btn btn-primary btn-sm btn-reply-feedback"
                                                   data-toggle="modal"
                                                   data-target="#modal-reply-feedback"
                                                   data-id="{{$feedback->id}}">
                                                    <i class="nav-icon fas fa-edit"></i>
                                                </a>
                                            @else
                                                <a class="btn btn-primary btn-sm btn-admin-reply-list"
                                                   data-id="{{$feedback->id}}">
                                                    <i class="nav-icon nav-icon far fa-envelope"></i>
                                                </a>
                                                <span class="text-loading-{{$feedback->id}}"></span>
                                                @endrole
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- modal-reply-feedback -->
                    <div class="modal fade" id="modal-reply-feedback" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{route('feedback.reply')}}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">
                                            @role('admin')
                                                Reply
                                            @else
                                                Feedback
                                            @endrole
                                        </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="form-control" rows="3" name="comment" required></textarea>
                                        <input type="hidden" name="parent_id" value="0"/>
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}"/>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Reply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal-reply-feedback -->

                    <div class="modal-admin-reply-list"></div>
                </div>
            </div>
        </div>

        @role('employee')
            <button type="button"
                    data-toggle="modal"
                    data-target="#modal-reply-feedback"
                    class="btn btn-primary btn-reply-employee">Send feedback
            </button>
        @endrole

        @if (session('success'))
            <div class="toasts-top-right fixed">
                <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">Toast Title</strong>
                        <small>Subtitle</small>
                        <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="toast-body">{!! session('success') !!}</div>
                </div>
            </div>
        @endif

        <script>
            $('.btn-reply-feedback').click(function () {
                var feedbackId = $(this).data('id');
                if (typeof feedbackId !== 'undefined') {
                    $("#modal-reply-feedback [name='parent_id']").val(feedbackId);
                }
            });

            $('.btn-admin-reply-list').click(function () {
                var feedbackId = $(this).data('id');
                var textLoading = $('.text-loading-' + feedbackId);

                $.ajax({
                    url: '{{ route('feedback.replyList') }}',
                    method: 'get',
                    data: {
                        feedback_id: feedbackId
                    },
                    beforeSend: function () {
                        textLoading.text('Waiting a minute...');
                    },
                    success: function (data) {
                        textLoading.text('');
                        $('.modal-admin-reply-list').html(data);
                    }
                });
            });
        </script>
    </x-slot>
</x-layout>
