        $(document).ready(function () {
            $('body').bind('keydown',function(event){
                if(event.keyCode == '13')
                {
                    $('button[name = "sub"]').click();
                }
            })

            $('button[name = "sub"]').click(function () {
                $('#data').html('<p style="color:red;text-align:center;"><b>查询中，请稍侯</b></p>');
                $.ajax({
                    url:'./core/post.core.php',
                    type:'POST',
                    dataType:"json",
                    data:{
                        '英雄':$('input[name = "hero"]').val(),
                        'sub':''
                    },
                    async:false,
                    success : function(data){
                        var contain = '<br>';
                        var percent = new Array('攻速成长','基础暴击率','基础暴击效果');
                        var power = new Array('基础能量值','能量值成长','满级能量值','基础回蓝','回蓝成长','满级回蓝');
                        contain += '<table class="table table-striped table-bordered table-hover table-sm">'
                        contain += '<thead><tr class="row" style="width: 100%;margin: 0 auto;"><th class="col-5">属性</th><th class="col-7">参考值</th></tr></thead>'
                        contain += '<tbody>'
                        for(var key in data)
                        {
                            if(typeof(data[key]) == 'object')
                            {
                                if(JSON.stringify(data[key]) == "{}" || JSON.stringify(data[key]) == "null" )
                                {
                                    continue;
                                }
                            }
                            if(percent.indexOf(key) >= 0)
                            {
                                data[key] = Math.round((data[key] * 100) * 100)/100 + '%';
                            }
                            if(power.indexOf(key) >= 0)
                            {
                                if(data[key] == 0)
                                {
                                    continue;
                                }
                            }
                            contain += '<tr class="row" style="width: 100%;margin: 0 auto;"><td class="col-5">' + key + '</td><td class="col-7">' + data[key] + '</td></tr>';
                        }
                        // $('#data').html($('#data').html() + '<span>' + Object.keys(data).length + '</span><br>'); 	//json长度
                        // $('#data').html($('#data').html() + '<span>' + Object.keys(data) + '</span><br>');			//json键值
                        contain += '</tbody></table>';
                        $('#data').html(contain)
                    },
                    error : function()
                    {
                        $('#data').html($('#data').html() + '<p style="color:red;text-align:center;">未查询到相关数据</p>');
                    }
                })
            })
        })