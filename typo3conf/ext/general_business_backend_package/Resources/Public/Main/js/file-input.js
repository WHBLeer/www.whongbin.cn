    $("#bootstarp-fileupload").fileinput({
        language: 'zh',
        theme: 'fas',
        uploadUrl: '/api/fileprocessing?cmd=f_upload', 
        showUpload: false,
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 20,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        },
        showUploadedThumbs : true,
        initialPreviewAsData: true,
        initialPreview:initialPreview,
        initialPreviewConfig:initialPreviewConfig,
        deleteUrl: "/api/fileprocessing?cmd=f_delete"    //删除操作的URL地址
    });
    $('#bootstarp-fileupload').on('change', function(event) {
        console.log("change");
        $('#bootstarp-fileupload').fileinput('upload');
        console.log("upload");
    });

    $("#bootstarp-fileupload").on("fileuploaded", function (event, data, previewId, index) {
        var obj = data.response;
        if (obj.code==1) {
            oval = $("#imageuids").val();
            $("#imageuids").val(oval+','+obj.uid);
            notify(obj.message, "success");
        }else{
            notify(obj.message, "error");
        }
    });
    $('#bootstarp-fileupload').on('fileerror', function(event, data, msg) {
        console.log(data.id);
        console.log(data.index);
        console.log(data.file);
        console.log(data.reader);
        console.log(data.files);
        // 获取信息
        alert(msg);
    });
    $("#bootstarp-fileupload").on('filepreremove', function(event, id, index) {
        console.log(event);
        console.log(id);
        console.log(index);
        // layer.confirm('确定删除文件吗？', {icon: 0, title:'提示'}, function(index){
        //     //do something
        //     layer.close(index);
        // });
    });
    $("#bootstarp-fileupload").on('filepredelete', function(event, key, jqXHR, data) {
        // layer.confirm('确定删除原文件？删除后不可恢复', {icon: 0, title:'提示'}, function(index){
            console.log('Key = ' + key);  
            console.log(jqXHR);  
            console.log(data);   
            // layer.close(index);
        // });
    });
    $("#bootstarp-fileupload").on('filedeleted', function(event, key) {
        notify('图片已删除！',"success");
    });
    $('#bootstarp-fileupload').on('filezoomshow', function(event, params) {
        console.log(params);
        console.log('File zoom show ', params.sourceEvent, params.previewId, params.modal);
    });
    $('#bootstarp-fileupload').on('change', function(event) {
        console.log("change");
    });
    
    /*
    * 鼠标放在图片上方，显示大图
    */
    var bigImgIndex = null;
    function tipImg(obj,level){
        try{
            var navigatorName = "Microsoft Internet Explorer"; 
            if( navigator.appName != navigatorName ){ 
                if(obj.nodeName == 'IMG'){
                    var e = window.event;
                    // var x = e.clientX+document.body.scrollLeft + document.documentElement.scrollLeft
                    // var y = e.clientY+document.body.scrollTop + document.documentElement.scrollTop
                    var x = document.documentElement.clientWidth/4;
                    var y = document.documentElement.clientHeight/4;
                    var src = obj.src;
                    // var width = obj.naturalWidth;
                    // var height = obj.naturalHeight;
                    var width = obj.naturalWidth/3;
                    var height = obj.naturalHeight/3;
                    var curlayer;
                    if(!level){
                        curlayer = layer;
                    }else if(level==1){
                        curlayer = parent.layer;
                    }

                    var img_infor = "<img width='" + width + "' height='" + height + "' border='0' src='" + src + "' />";
                    bigImgIndex = curlayer.open({
                        // content:[src,'no'],
                        content:img_infor,
                        // type:2,
                        type:1,
                        offset:[y+"px",x+"px"],
                        title:false,
                        // area:[width+"px",height+"px"],
                        area:['auto','auto'],
                        shade:0,
                        closeBtn:0
                    });
                    
                }
            }
        }catch(e){
        }
        
    }
// //上传成功触发
// $("#bootstarp-fileupload").on("fileuploaded", function (event, data, previewId, index) {
//     var obj = data.response;
//     if (obj.code==1) {
//         oval = $("#imageuids").val();
//         $("#imageuids").val(oval+','+obj.uid);
//         notify(obj.message, "success");
//     }else{
//         notify(obj.message, "error");
//     }
// });
// //上传成功后，缩略删除图片，触发事件 data包含图片本来得 name
// $('#bootstarp-fileupload').on('filesuccessremove', function(event, key, data) {
//     console.log('event:'+event);
//     console.log('key:'+key);
//     console.log('data:'+data);
//     var index=data.indexOf("_");
//     //删除图片名称
//     var del_img_name = key.substring(key.indexOf("_", index));
//     console.log('del_img_name:'+del_img_name);
//     return false;
//     //当前上传的图片，拼接后字符串
//     var url=$("#del_name").val();
//     console.log("原始url:"+url);
//     var img_names = url.split(";");
//     var del_name;
//     for (var i = 0; i < img_names.length; i++) {
//         if(img_names[i].indexOf(del_img_name) >= 0){
//             del_name=img_names[i];
//         }
//     }
//     console.log("当前删除url:"+del_name);
//     url=url.replace(del_name+";","");
//     console.log("删除后url:"+url);
//     $.post("/api/fileprocessing?cmd=f_delete",{"urls":del_name},function (data) {
//         if(data.code == 200){
//             $("#del_name").val(url);
//         }else {
//             console.log("code:"+data.code+",message:"+data.message);
//         }
//     })
// });
// //移除按钮触发事件
// $('#bootstarp-fileupload').on('filecleared', function() {
//     var testVal = $("#del_name").val();
//     var url=$("#del_name").val();
//     console.log(url);
//     if (testVal){
//         $.post("/api/fileprocessing?cmd=f_delete",{"urls":url},function (data) {
//             if(data.code == 200){
//                 $("#del_name").val('');
//                 console.log("code:"+data.code+",message:"+data.message);
//             }else {
//                 console.log("code:"+data.code+",message:"+data.message);
//             }
//         })
//     }
// });
