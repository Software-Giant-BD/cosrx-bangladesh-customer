@include('layouts.head')
@yield('css')

<body>
    <div class="wrapper">
        @include('layouts.header.index')
        <main class="main-content">
            @yield('main')
        </main>
        @include('layouts.footer')
        <!--== Scroll Top Button ==-->
        <div id="scroll-to-top" class="scroll-to-top"><span class="fa fa-angle-up"></span></div>
        @include('layouts.aside')
    </div>
    <!--== Wrapper End ==-->
    @include('layouts.foot')
    @yield('js')
</body>

</html>
