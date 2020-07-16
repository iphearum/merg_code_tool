var current_no_up;
var data = ajax_var_upload_1;
var elm_container = ajax_var_upload.plupload.container;
var elm_uploaded_images = ajax_var_upload.uploaded_images;

jQuery(document).ready(function(c) {
    delete_binder();
    var b;
    var a = 0;
    
    current_no_up = parseInt(c("#" +elm_container+ " .uploaded_images ").length, 10);
  
    b = 0;
    if (typeof(plupload) !== "undefined") {
        var d = new plupload.Uploader(ajax_var_upload.plupload);
        d.init();
        d.bind("FilesAdded", function(e, g) {
            if (ajax_var_upload.max_images > 0) { 
                if (current_no_up === 0) {
                    b = ajax_var_upload.max_images;
                    if (g.length > b) {
                        current_no_up = b
                    } else {
                        current_no_up = g.length
                    }
                } else {

                    if (current_no_up >= ajax_var_upload.max_images) {
                        b = -1
                    } else {
                        b = ajax_var_upload.max_images - current_no_up;
                        if (g.length > b) {
                            current_no_up = current_no_up + b
                        } else {
                            current_no_up = current_no_up + g.length
                        }
                    }
                }
                if(ajax_var_upload.max_images == 1) {
                    b = 1;
                    current_no_up = 0;
                }
              
                if (b > 0) {
                    e.files.slice(0, b);
                    g.slice(0, b);
                    var f = b;
                    while (g.length > b) {
                        e.files.pop();
                        g.pop();
                        a = 1
                    }
                }
                if (a === 1) {
                    c("#" + elm_container + ".image_max_warn").remove();
                    c("#" + elm_container + "  #imagelist").before('<div class="image_max_warn" style="width:100%;float:left;">' + ajax_var_upload.warning_max + "</div>")
                }
                
                if (b == -1) {
                    c("#" + elm_container + ".image_max_warn").remove();
                    c("#" + elm_container + "  #imagelist").before('<div class="image_max_warn" style="width:100%;float:left;">' + ajax_var_upload.warning_max + "</div>");
                    g = [];
                    e = [];
                    
                    
                    return
                }
            }
            c.each(g, function(j, h) {
                c("#" + elm_container + "  #aaiu-upload-imagelist").append('<div id="' + h.id + '">' + h.name + " (" + plupload.formatSize(h.size) + ") <b></b></li>")
            });
            e.refresh();
            d.start()
        });
        d.bind("UploadProgress", function(e, f) {
            c("#" + elm_container + "  #" + f.id + " b").html(f.percent + "%")
        });
        d.bind("Error", function(e, f) {
            c("#" + elm_container + "  #aaiu-upload-imagelist").append("<div>Error: " + f.code + ", Message: " + f.message + (f.file ? ", File: " + f.file.name : "") + "</li>");
            e.refresh()
        });
        d.bind("FileUploaded", function(f, i, h) {
            var e = c.parseJSON(h.response);
            c("#" + elm_container + "  #image_warn").remove();
            c("#" + elm_container + "  #" + i.id).remove();
            if (e.success) {
                c("#" + elm_container + "  #preview-image").attr("src", e.html);
                c("#" + elm_container + "  #preview-image").attr("data-profileurl", e.html);
                c("#" + elm_container + "  #preview-image").attr("data-smallprofileurl", e.attach);
                c("#" + elm_container + "  #preview-image").show();

                var g = c("#" + elm_container + "#attachid").val();
                g = g + "," + e.attach;
                c("#" + elm_container + "  #attachid").val(g);
                if (e.html !== "") {
                    if (ajax_var_upload.is_floor === "1") {
                        c("#" + elm_container + "  #no_plan_mess").remove();
                        c("#" + elm_container + "  #imagelist").append('<div class="uploaded_images floor_container" data-imageid="' + e.attach + '"><input type="hidden" name="plan_image_attach[]" value="' + e.attach + '"><input type="hidden" name="plan_image[]" value="' + e.html + '"><img src="' + e.html + '" alt="thumb" /><i class="fa deleter fa-trash-o"></i>' + to_insert_floor + "</div>")
                    } else {
                        c("#" + elm_container + "  #imagelist").append('<div class="uploaded_images" data-imageid="' + e.attach + '"><img src="' + e.html + '" alt="thumb" /><i class="fa deleter fa-trash-o"></i> </div>')
                    }
                } else {
                    c("#" + elm_container + "  #imagelist").append('<div class="uploaded_images" data-imageid="' + e.attach + '"><img src="' + ajax_var_upload.path + '/img/pdf.png" alt="thumb" /><i class="fa deleter fa-trash-o"></i> </div>')
                }
                if (jQuery().sortable) {
                    c("#" + elm_container + "  #imagelist").sortable({
                        revert: true,
                        update: function(l, m) {
                            var k, j;
                            k = "";
                            c("#" + elm_container + "  #imagelist .uploaded_images").each(function() {
                                j = c(this).attr("data-imageid");
                                if (typeof j != "undefined") {
                                    k = k + "," + j
                                }
                            });
                            c("#" + elm_container + "  #attachid").val(k)
                        },
                    })
                }
                delete_binder();
                thumb_setter();
                max_image_checker_remove()
            } else {
                if (e.image) {
                    c("#" + elm_container + "  #preview-image").hide();
                    c("#" + elm_container + "  #imagelist").before('<div id="image_warn" style="width:100%;float:left;">' + ajax_var_upload.warning + "</div>")
                }
            }
        });
        jQuery("#" + elm_container + "  #brand-aaiu-uploader").click(function(f) {
            d.splice();
            d.refresh()
        });
        c("#" + elm_container + "  #aaiu-uploader2").click(function(f) {
            d.start();
            f.preventDefault()
        });
        c("#" + elm_container + "  #aaiu-uploader-floor").click(function(f) {
            f.preventDefault();
            c("#aaiu-uploader").trigger("click")
        });
        d.splice();
        d.refresh()
    }
    d.splice();
    d.refresh()
});

function max_image_checker_remove() {}

function thumb_setter() {
    jQuery("#" + elm_container + "  #imagelist img").dblclick(function() {
        jQuery("#" + elm_container + "  #imagelist .uploaded_images .thumber").each(function() {
            jQuery(this).remove()
        });
        jQuery(this).parent().append('<i class="fa thumber fa-star"></i>');
        jQuery("#" + elm_container + "  #attachthumb").val(jQuery(this).parent().attr("data-imageid"))
    })
}

function delete_binder() {
    jQuery("#" + elm_container + " #imagelist i.fa-trash-o").unbind("click");
    jQuery("#" + elm_container + " #imagelist i.fa-trash-o").click(function() {
        var c = "";
        var b = "";
        var a = jQuery(this).parent().attr("data-imageid");
        current_no_up = current_no_up - 1;
        jQuery(this).parent().remove();
        jQuery("#" + elm_container + "  #imagelist .uploaded_images").each(function() {
            b = jQuery(this).attr("data-imageid");
            c = c + "," + b
        });
        jQuery("#" + elm_container + "  #attachid").val(c);
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "wpestate_delete_file",
                attach_id: a,
            },
            success: function(d) {},
            error: function(d) {
                console.log(d)
            }
        })
    })
}