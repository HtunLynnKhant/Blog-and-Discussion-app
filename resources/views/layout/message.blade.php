<script>
    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    @endif

    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    @if(session('warning'))
        toastr.warning('{{ session('warning') }}');
    @endif

    @if(session('danger'))
        toastr.error('{{ session('danger') }}');
    @endif
</script>
