var current_no_up;
jQuery(document).ready(function(c) {
    delete_binder();
    var b;
    var a = 0;
    current_no_up = parseInt(c(".uploaded_images ").length, 10);
    b = 0;
    if (typeof(plupload) !== "undefined") {
        var d = new plupload.Uploader(ajax_vars.plupload);
        d.init();
        d.bind("FilesAdded", function(e, g) {
            if (ajax_vars.max_images > 0) {
                if (current_no_up === 0) {
                    b = ajax_vars.max_images;
                    if (g.length > ajax_vars.max_images) {
                        current_no_up = b
                    } else {
                        current_no_up = g.length
                    }
                } else {
                    if (current_no_up >= ajax_vars.max_images) {
                        b = -1
                    } else {
                        b = ajax_vars.max_images - current_no_up;
                        if (g.length > b) {
                            current_no_up = current_no_up + b
                        } else {
                            current_no_up = current_no_up + g.length
                        }
                    }
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
                    c(".image_max_warn").remove();
                    c("#imagelist").before('<div class="image_max_warn" style="width:100%;float:left;">' + ajax_vars.warning_max + "</div>")
                }
                if (b == -1) {
                    c(".image_max_warn").remove();
                    c("#imagelist").before('<div class="image_max_warn" style="width:100%;float:left;">' + ajax_vars.warning_max + "</div>");
                    g = [];
                    e = [];
                    return
                }
            }
            c.each(g, function(j, h) {
                c("#aaiu-upload-imagelist").append('<div id="' + h.id + '">' + h.name + " (" + plupload.formatSize(h.size) + ") <b></b></div>")
            });
            e.refresh();
            d.start()
        });

        jQuery("#aaiu-uploader").click(function(f) {
            d.splice();
            d.refresh()
        });
        c("#aaiu-uploader2").click(function(f) {
        	// alert('kakaka');
            d.start();
            f.preventDefault()
        });
        c("#aaiu-uploader-floor").click(function(f) {
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
    jQuery("#imagelist img").dblclick(function() {
        jQuery("#imagelist .uploaded_images .thumber").each(function() {
            jQuery(this).remove()
        });
        jQuery(this).parent().append('<i class="fa thumber fa-star"></i>');
        jQuery("#attachthumb").val(jQuery(this).parent().attr("data-imageid"))
    })
}

function delete_binder() {
    jQuery("#imagelist i.fa-trash-o").unbind("click");
    jQuery("#imagelist i.fa-trash-o").click(function() {
        var c = "";
        var b = "";
        var a = jQuery(this).parent().attr("data-imageid");
        current_no_up = current_no_up - 1;
        jQuery(this).parent().remove();
        jQuery("#imagelist .uploaded_images").each(function() {
            b = jQuery(this).attr("data-imageid");
            c = c + "," + b
        });
        jQuery("#attachid").val(c);
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
to_insert_floor = '<div class=""><p class="meta-options floor_p">\n                <label for="plan_title">' + control_vars.plan_title + '</label><br />\n                <input id="plan_title" type="text" size="36" name="plan_title[]" value="" />\n            </p>\n            \n            <p class="meta-options floor_full"> \n                <label for="plan_description">' + control_vars.plan_desc + '</label><br /> \n                <textarea class="plan_description" type="text" size="36" name="plan_description[]" ></textarea> \n            </p>\n             \n            <p class="meta-options floor_p"> \n                <label for="plan_size">' + control_vars.plan_size + '</label><br /> \n                <input id="plan_size" type="text" size="36" name="plan_size[]" value="" /> \n            </p> \n            \n            <p class="meta-options floor_p"> \n                <label for="plan_rooms">' + control_vars.plan_rooms + '</label><br /> \n                <input id="plan_rooms" type="text" size="36" name="plan_rooms[]" value="" /> \n            </p> \n            <p class="meta-options floor_p"> \n                <label for="plan_bath">' + control_vars.plan_bathrooms + '</label><br /> \n                <input id="plan_bath" type="text" size="36" name="plan_bath[]" value="" /> \n            </p> \n            <p class="meta-options floor_p"> \n                <label for="plan_price">' + control_vars.plan_price + '</label><br /> \n                <input id="plan_price" type="text" size="36" name="plan_price[]" value="" /> \n            </p> \n    </div>';