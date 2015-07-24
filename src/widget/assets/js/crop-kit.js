/**
 * Created by Liv on 15/7/24.
 */
(function( $ ) {
    jQuery.fn.yiiModalCropKit = function(settings) {
        var target, $crop, imageId;
        var defaults = {
            cropUrl: '',
            aspectRatio: 1,
            ratio: 1.5,
            modalId: '#jcrop-modal',
            imageId: '#jcrop-modal #imageId',
            targetBtn: '.btn-crop',
            cropBtn: '#btn-crop',
            cropUrlId: '#url',
            cropXId: '#crop_x',
            cropYId: '#crop_y',
            cropWId: '#crop_w',
            cropHId: '#crop_h'
        };
        var options = $.extend({}, defaults, settings);

        var pub = {
            init: function(){
                pri.initTargetHandle();
                pri.initModalHandle();
                pri.initImageHandle();
                pri.initCropBtnHandle();
            }
        };

        var pri = {
            initImageHandle: function(){
                $(options.imageId).load(function(){
                    $(this).Jcrop({
                        aspectRatio : options.aspectRatio,
                        onSelect: function(c){
                            $(options.cropXId).val(c.x);
                            $(options.cropYId).val(c.y);
                            $(options.cropWId).val(c.w);
                            $(options.cropHId).val(c.h);
                        }
                    },function(){
                        $crop = this;
                    });
                })
            },
            initModalHandle: function(){
                $(options.modalId).on('show.bs.modal', function (e) {
                    target = $(e.relatedTarget);
                    var src = target.data('src');

                    $(options.imageId).attr('src',src + '?r=' + Math.random());
                    $(options.cropUrlId).val(src);

                }).on('hide.bs.modal', function (e) {
                    if($crop){
                        $crop.destroy();
                    }
                    $(options.imageId).removeAttr('style');
                    $(options.imageId).attr('src','');
                });

                $(options.modalId).on('cropSuccess',function(e,result){
                    var src = result.src + '?r=' + Math.random();
                    var item = target.parents('.upload-kit-item');

                    target.data('src', src);
                    item.find('img').attr('src',src);
                    item.find('input[name*="path"]').val(result.path);
                });

            },
            initTargetHandle:function(){
                $(document).on('click', options.targetBtn,function (e) {
                    e.preventDefault();
                    $(options.modalId).modal('show',this);
                })
            },
            initCropBtnHandle:function(){
                $(options.cropBtn).on('click',function(){
                    if (parseInt($(options.cropWId).val())){
                        var modal = $(this).closest(options.modalId);
                        var url = options.cropUrl;

                        var imageUrl = $(options.cropUrlId).val();
                        var pos = imageUrl.indexOf('?');
                        if (pos > 0) {
                            imageUrl = imageUrl.substring(pos, 0);
                        }

                        var x = $(options.cropXId).val();
                        var y = $(options.cropYId).val();
                        var w = $(options.cropWId).val();
                        var h = $(options.cropHId).val();

                        var data = {
                            'crop_x':x,
                            'crop_y':y,
                            'crop_w':w,
                            'crop_h':h,
                            'src':imageUrl
                        };
                        $.post(url,data,function(result){
                            if(result.status == 'y'){
                                modal.trigger('cropSuccess',[result]);
                                console.log(result);
                                modal.modal('hide');
                            }else{
                                alert('裁切错误，请重试！');
                            }
                        },'json');
                    }else{
                        alert('Please select a crop region then press submit.');
                    }
                    return false;
                });
            }
        };

        pub.init.apply(this);
        return this;
    };

})(jQuery);


