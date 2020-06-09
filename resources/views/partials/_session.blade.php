@if (session('success'))
    <script>

        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();

    </script>
    <script>
        swal("@lang('site.deleted')", "", "success");
    </script>
@endif
