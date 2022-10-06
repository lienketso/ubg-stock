<footer class="main">
    <div class="container pb-30  wow animate__animated animate__fadeInUp"  data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">{!! clean(theme_option('copyright')) !!}</p>
            </div>
           
           
        </div>
    </div>
</footer>

    
        {!! Theme::footer() !!}
        @if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
            <script type="text/javascript">
                $(document).ready(function () {
                    @if (session()->has('success_msg'))
                        window.showAlert('alert-success', '{{ session('success_msg') }}');
                    @endif
    
                    @if (session()->has('error_msg'))
                        window.showAlert('alert-danger', '{{ session('error_msg') }}');
                    @endif
    
                    @if (isset($error_msg))
                        window.showAlert('alert-danger', '{{ $error_msg }}');
                    @endif
    
                    @if (isset($errors))
                        @foreach ($errors->all() as $error)
                            window.showAlert('alert-danger', '{!! clean($error) !!}');
                        @endforeach
                    @endif
                });
            </script>
        @endif
        </body>
    </html>
    