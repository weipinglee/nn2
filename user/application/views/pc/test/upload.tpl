


<link href="{root:/js/webuploader/webuploader.css}" rel="stylesheet" type="text/css" />

<link href="{root:/js/webuploader/demo.css}" rel="stylesheet" type="text/css" />
<div class="page-container">
    <h1 id="demo">Demo</h1>


    <div id="uploader" class="wu-example">
        <div class="queueList">
            <div id="dndArea" class="placeholder">
                <div id="filePicker"></div>
                <p>或将照片拖到这里，单次最多可选300张</p>
            </div>
        </div>
        <div class="statusBar" style="display:none;">
            <div class="progress">
                <span class="text">0%</span>
                <span class="percentage"></span>
            </div><div class="info"></div>
            <div class="btns">
                <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
            </div>
        </div>
    </div>

</div>





<script type="text/javascript" src="{root:/js/webuploader/webuploader.js}"></script>
<div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div>
<script type="text/javascript">
    jQuery(function() {
        var $ = jQuery,
                $toc = $('.post-toc');



        $toc.each(function() {
            var $this = $( this ),
                    postion = $this.offset();

            $this.affix({
                offset: {
                    top: postion.top - 80
                }
            });
        });

        if ( $toc.length ) {
            $('body').scrollspy({ target: '.post-toc' });
        }
    });

    // comments相关
    jQuery(function() {
        var $ = jQuery,
                $el = $('#ghComments'),
                issueId;

        // 不合法
        if ( !$el.length || !$el.attr('data-issue-id') ) {
            return;
        }

        issueId = $el.attr('data-issue-id') ^ 0;

        function formatNumber(val, len) {
            var num = "" + val;

            len = len || 2;
            while (num.length < len) {
                num = "0" + num;
            }

            return num;
        }

        function formatDate( str ) {
            var date = new Date( str.replace(/T/, ' ').replace(/Z/, ' UTC') );

            return date.getFullYear() + '-' +
                    formatNumber( date.getMonth() + 1 ) + '-' +
                    formatNumber( date.getDate() ) + ' ' +
                    formatNumber( date.getHours() ) + ':' +
                    formatNumber( date.getMinutes() ) + ':' +
                    formatNumber( date.getSeconds() );
        }

        function loadComments( data ) {
            for (var i = 0; i < data.length; i++) {
                var cuser = data[i].user.login;
                var cuserlink = 'https://www.github.com/' + data[i].user.login;
                var clink = 'https://github.com/fex-team/webuploader/issues/' + issueId + '#issuecomment-' + data[i].url.substring(data[i].url.lastIndexOf('/') + 1);
                var cbody = data[i].body_html;
                var cavatarlink = data[i].user.avatar_url;
                var cdate = formatDate( data[i].created_at );
                $el.append('<div class="comment"><div class="commentheader"><div class="commentgravatar"><img src="' + cavatarlink + '" alt="" width="20" height="20"></div><a class="commentuser" href="' + cuserlink + '">' + cuser + '</a><a class="commentdate" href="' + clink + '">' + cdate + '</a></div><div class="commentbody">' + cbody + '</div></div>');
            }
        }

        $.ajax('https://api.github.com/repos/fex-team/webuploader/issues/' + issueId + '/comments?per_page=100', {
            headers: {
                Accept: 'application/vnd.github.full+json'
            },
            dataType: 'json',
            success: loadComments
        });
    });
</script>
<script type="text/javascript" src="{root:/js/webuploader/demo.js}"></script>