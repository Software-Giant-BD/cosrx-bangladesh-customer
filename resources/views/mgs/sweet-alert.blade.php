@if (session('success'))
    <input type="hidden" id="success-mgs" value="{{ session('success') }}">
    <script>
        $(document).ready(function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: $("#success-mgs").val(),
                showConfirmButton: false,
                background: '#EDF8FC',
                timer: 2000
            })
        });
    </script>
@elseif(session('warning'))
    <input type="hidden" id="warning-mgs" value="{{ session('warning') }}">
    <script>
        $(document).ready(function() {
            console.log($("#warning-mgs").val())
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: $("#warning-mgs").val(),
                showConfirmButton: false,
                background: '#EDF8FC',
                timer: 2000
            })
        });
    </script>
@endif
