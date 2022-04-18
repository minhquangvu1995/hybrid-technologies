<div class="modal fade show" style="display: block" id="modal-admin-reply-list" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Admin name</th>
                        <th>Reply</th>
                        <th>Reply at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($replyList as $reply)
                        <tr>
                            <td>{{$reply->user->name}}</td>
                            <td>{{$reply->comment}}</td>
                            <td>{{$reply->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
        </div>
    </div>
</div>
<script>
    $('.close').click(function () {
        $('.modal').removeClass('show').css({'display': 'none'});
    });
</script>
