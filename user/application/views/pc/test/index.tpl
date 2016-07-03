

<script type="text/javascript" src="{root:/js/webuploader/webuploader.js}"></script>
<link href="{root:/js/webuploader/webuploader.css}" rel="stylesheet" type="text/css" />
<link href="{root:/js/webuploader/demo.css}" rel="stylesheet" type="text/css" />


<div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <ul id="filelist" class="filelist">


    </ul>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var uploader = WebUploader.create({
            auto: true,
            // swf文件路径
            swf: '{root:/js/webuploader/Uploader.swf}',

            // 文件接收服务端。
            server: '{url:/ucenter/upload}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });


        uploader.on( 'fileQueued', function( file ) {
            var $li = $(
                            '<li id="' + file.id + '" class="file-item thumbnail">' +
                           // '<p class="title">' + file.name + '</p>' +
                            '<p ><img /></p>' +
                            '<p class="progress"><span style="display:block;"></span></p>' +
                            '<p class="res"></p>'+
                            '</li>'

                    ),
                    $img = $li.find('img');


            // $list为容器jQuery实例
            $('#filelist').append( $li );

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, 100, 100 );
        });


        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {

            var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                        .appendTo( $li )
                        .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );

        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file ,resporse) {

            $( '#'+file.id).find('.progress').remove();
            $( '#'+file.id).find('.res').css('display','block').addClass('success');
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

            // 避免重复创建
            if ( !$error.length ) {
                $error = $('<div class="error"></div>').appendTo( $li );
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').remove();
        });


    })
</script>