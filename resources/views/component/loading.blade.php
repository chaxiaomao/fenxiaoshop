<!-- loading toast -->
<div id="loadingToast" style="display:none;">
    <div class="weui-mask_transparent"></div>
    <div class="weui-toast">
        <i class="weui-loading weui-icon_toast"></i>
        <p class="weui-toast__content">加载中</p>
    </div>
</div>
<script type="text/javascript">
    // toast
    $(function(){
        var $toast = $('#toast');
        $('#showToast').on('click', function(){
            if ($toast.css('display') != 'none') return;

            $toast.fadeIn(100);
            setTimeout(function () {
                $toast.fadeOut(100);
            }, 2000);
        });
    });

    // loading
    $(function(){
        var $loadingToast = $('#loadingToast');
        $('#showLoadingToast').on('click', function(){
            if ($loadingToast.css('display') != 'none') return;

            $loadingToast.fadeIn(100);
            setTimeout(function () {
                $loadingToast.fadeOut(100);
            }, 2000);
        });
    });
</script>