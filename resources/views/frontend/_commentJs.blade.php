@section('script')
    <script type="text/javascript">
        $(document).on('click', '#comments .comment-reply', function () {
            let link = $(this);
            let form = $('#reply-block');
            let comment = link.closest('.comment-item');
            $('#parent-id').val(comment.data('id'));
            form.detach().appendTo(comment.find('.reply-block:first'));
            document.getElementById('cancel-reply').style.display = 'inline-block';
            return false;
        });
        $(document).on('click', '#comments #cancel-reply', function () {
            let form = $('#reply-block');
            $('#parent-id').removeAttr('value');
            form.detach().appendTo('#root-level');
            document.getElementById('cancel-reply').style.display = 'none';
            return false;
        });
    </script>
@endsection
