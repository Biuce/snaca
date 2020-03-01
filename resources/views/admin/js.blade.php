<script src="/public/vendor/layui-v2.4.5/layui.all.js"></script>
{{--<script src="/public/components/base/script.js"></script>--}}
<script src="/public/admin/js/jquery.min.js?v=2.1.4"></script>
{{--<script src="/public/admin/js/vue.js"></script>--}}
{{--<script src="/public/admin/js/jquery.form.js"></script>--}}
<script src="/public/admin/js/admin.js"></script>
<script src="/public/admin/js/laypage/laypage.js"></script>
@yield('js')
<script>
    window.onload = function() {
        window.parent.scrollTo(0, -1);
        document.body.scrollTop = 0;
    }
</script>
