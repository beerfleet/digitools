var strtxt;
$(function () {
});
function editcat(el) {
    console.log('test2');
    var eForm = document.createElement("form");
    var eTxtinput = document.createElement("input");
    var eBtnSave = document.createElement("button");
    var eBtnDelete = document.createElement("button");
    var eBtnCancel = document.createElement("button");
    var eCategoryname = $(el).prev();
    var eEditimg = $(el);
    var eParent = $(el).parent();
    eTxtinput.type = "text";
    eTxtinput.name = "category";
    eTxtinput.value = $(el).prev().text();
    eBtnCancel.type = "button";
    eBtnSave.type = "button";
    eBtnDelete.type = "button";
    eBtnCancel.innerHTML = "Cancel";
    eBtnDelete.innerHTML = "Delete";
    eBtnSave.innerHTML = "Save";
    eBtnSave.dataset.catid = $(el).attr("data-catid");
    eBtnCancel.dataset.catname = $(el).prev().text();
    eBtnCancel.dataset.catid = $(el).attr("data-catid");
    eBtnDelete.dataset.catname = $(el).prev().text();
    eBtnDelete.dataset.catid = $(el).attr("data-catid");
    eBtnCancel.onclick = function () {
        cancelcat(this)
    };
    eBtnSave.onclick = function () {
        savecat(this)
    };
    eBtnDelete.onclick = function () {
        deletecat(this)
    };
    $(eTxtinput).addClass("category");
    $(eBtnSave).addClass("btn btn-default");
    $(eBtnDelete).addClass("btn btn-default");
    $(eBtnCancel).addClass("btn btn-default cancel");
    $(eForm).append(eTxtinput, eBtnSave, eBtnCancel);
    $(eParent).html("");
    $(eParent).append(eForm);
//$(eCategoryname).remove();
//$(eEditimg).remove();
    /*strtxt='<form><input class="category" type="text" name="category" value="';
     strtxt+=$(this).prev().text();
     strtxt+='"/>';
     strtxt+='<a class="btn btn-default" href="#" role="button">Save</a> <a class="btn btn-default cancel" href="#" role="button" data-catname="';
     strtxt+=$(this).prev().text();
     strtxt+='">Cancel</a></form>';
     $(this).parent().html(strtxt);*/
}
;
function cancelcat(el) {
    console.log('test');
    if ($(el).attr('data-catid') == "")
    {
        $(el).parents("div .cat").remove();
    }
    else
    {
        strtxt = '<strong class="catname">';
        strtxt += $(el).attr('data-catname');
        strtxt += '</strong><img class="editcat" src="../img/edit.png" data-catid="';
        strtxt += $(el).attr('data-catid');
        strtxt += '" onClick="editcat(this)">';
        strtxt += '<img class="deletecat" src="../img/delete.png" data-catid="';
        strtxt += $(el).attr('data-catid');
        strtxt += '" onClick="deletecat(this)">';
        $(el).parents("div .cat").html(strtxt);
        $(el).parents("form").remove();
    }
}
;
function savecat(el) {
    console.log($(el).attr('data-catid'));
    if ($(el).attr('data-catid') == "")
    {
        $.ajax({
            type: "POST",
            url: "addcategory",
            data: 'name=' + $(el).prev().val(),
            dataType: "json",
            success: function (newname) {
                console.log("success");
                strtxt = '<strong class="catname">';
                strtxt += newname.name;
                strtxt += '</strong><img class="editcat" src="../img/edit.png" data-catid="';
                strtxt += newname.id;
                strtxt += '" onClick="editcat(this)">';
                strtxt += ' <img class="deletecat" src="../img/delete.png" data-catid="';
                strtxt += newname.id;
                strtxt += '" onClick="deletecat(this)"> <strong style="color:green">category saved</strong>';
                $(el).parents("div .cat").html(strtxt);
                $(el).parents("form").remove();
            },
            error: function (result, status) {
                console.log(result);
                console.log(status);
                strtxt = ' <strong style="color:red">error try again</strong>';
                $(el).parent().append(strtxt);
            }
        });
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "editcategory" + '/' + $(el).attr('data-catid'),
            data: 'name=' + $(el).prev().val() + "&id=" + $(el).attr('data-catid'),
            dataType: "json",
            success: function (newname) {
                console.log("success");
                strtxt = '<strong class="catname">';
                strtxt += newname.name;
                strtxt += '</strong><img class="editcat" src="../img/edit.png" data-catid="';
                strtxt += $(el).attr('data-catid');
                strtxt += '" onClick="editcat(this)">';
                strtxt += ' <img class="deletecat" src="../img/delete.png" data-catid="';
                strtxt += $(el).attr('data-catid');
                strtxt += '" onClick="deletecat(this)"> <strong style="color:green">category saved</strong>';
                $(el).parents("div .cat").html(strtxt);
                $(el).parents("form").remove();
            },
            error: function (result, status) {
                console.log(result);
                console.log(status);
                strtxt = '"<strong style="color:red">error try again</strong>';
                $(el).parent().append(strtxt);
            }
        });
    }
}
function deletecat(el) {
    console.log($(el).attr('data-catid'));
    if (confirm("Are you sure to delete?"))
    {
        $.ajax({
            type: "POST",
            url: "deletecategory" + '/' + $(el).attr('data-catid'),
            data: "id=" + $(el).attr('data-catid'),
            dataType: "json",
            success: function () {
                console.log("success");
                $(el).parents("div .cat").remove();
            },
            error: function (result, status) {
                console.log(result);
                console.log(status);
                strtxt = '"<strong style="color:red">error try again</strong>';
                $(el).parent().append(strtxt);
            }
        });
    }
}
function addcat(el) {
    console.log('test2');
    var eDiv = document.createElement("div");
    var eForm = document.createElement("form");
    var eTxtinput = document.createElement("input");
    var eBtnSave = document.createElement("button");
    var eBtnCancel = document.createElement("button");
    var eCategoryname = "";
    eTxtinput.type = "text";
    eTxtinput.name = "category";
    eTxtinput.value = "";
    eBtnCancel.type = "button";
    eBtnSave.type = "button";
    eBtnCancel.innerHTML = "Cancel";
    eBtnSave.innerHTML = "Save";
    eBtnSave.dataset.catid = "";
    eBtnCancel.dataset.catname = $(el).prev().text();
    eBtnCancel.dataset.catid = "";
    eBtnCancel.onclick = function () {
        cancelcat(this)
    };
    eBtnSave.onclick = function () {
        savecat(this)
    };
    $(eDiv).addClass("cat");
    $(eTxtinput).addClass("category");
    $(eBtnSave).addClass("btn btn-default");
    $(eBtnCancel).addClass("btn btn-default cancel");
    $(eForm).append(eTxtinput, eBtnSave, eBtnCancel);
    $(eDiv).append(eForm);
    $("#categorylist").append(eDiv);
//$(eCategoryname).remove();
//$(eEditimg).remove();
    /*strtxt='<form><input class="category" type="text" name="category" value="';
     strtxt+=$(this).prev().text();
     strtxt+='"/>';
     strtxt+='<a class="btn btn-default" href="#" role="button">Save</a> <a class="btn btn-default cancel" href="#" role="button" data-catname="';
     strtxt+=$(this).prev().text();
     strtxt+='">Cancel</a></form>';
     $(this).parent().html(strtxt);*/
}
;
function addcatinform(el) {
    console.log('test2');
    var eDiv = document.createElement("div");
    var eTxtinput = document.createElement("input");
    var eBtnSave = document.createElement("button");
    var eBtnCancel = document.createElement("button");
    var eCategoryname = "";
    eTxtinput.type = "text";
    eTxtinput.name = "category";
    eTxtinput.value = "";
    eBtnCancel.type = "button";
    eBtnSave.type = "button";
    eBtnCancel.innerHTML = "Cancel";
    eBtnSave.innerHTML = "Save";
    eBtnSave.dataset.catid = "";
    eBtnCancel.dataset.catname = $(el).prev().text();
    eBtnCancel.dataset.catid = "";
    eBtnCancel.onclick = function () {
        cancelcatinform(this)
    };
    eBtnSave.onclick = function () {
        savecatinform(this)
    };
    $(eDiv).addClass("cat");
    $(eTxtinput).addClass("category");
    $(eBtnSave).addClass("btn btn-default");
    $(eBtnCancel).addClass("btn btn-default cancel");
    $(eDiv).append(eTxtinput, eBtnSave, eBtnCancel);
    $("#score").append(eDiv);
//$(eCategoryname).remove();
//$(eEditimg).remove();
    /*strtxt='<form><input class="category" type="text" name="category" value="';
     strtxt+=$(this).prev().text();
     strtxt+='"/>';
     strtxt+='<a class="btn btn-default" href="#" role="button">Save</a> <a class="btn btn-default cancel" href="#" role="button" data-catname="';
     strtxt+=$(this).prev().text();
     strtxt+='">Cancel</a></form>';
     $(this).parent().html(strtxt);*/
}
;
function cancelcatinform(el) {
    console.log('test');
    $(el).parents("div .cat").remove();
}
;
function savecatinform(el) {
    console.log($(el).attr('data-catid'));
    $.ajax({
        type: "POST",
        url: "../addcategory",
        data: 'name=' + $(el).prev().val(),
        dataType: "json",
        success: function (newname) {
            console.log("success");
            strtxt = '<label for="cat';
            strtxt += newname.id;
            strtxt += ';">';
            strtxt += newname.name;
            strtxt += '</label> <input id="cat';
            strtxt += newname.id;
            strtxt += '" type="text" data-slider-min="0" data-slider-max="10" data-slider-step="0.5" data-slider-value="0" />';
            strtxt += '<input id="catparam';
            strtxt += newname.id;
            strtxt += '" name="catparam[]" type="hidden" value="" />';
            strtxt += '<span id="cat';
            strtxt += newname.id;
            strtxt += 'CurrentSliderValLabel">Current value selected: <span id="cat';
            strtxt += newname.id;
            strtxt += 'SliderVal"></span> / 10</span><p>&nbsp;</p>';
            $("#score").append(strtxt);
            $(el).parents("div .cat").remove();
            st = '#cat' + newname.id;
            $(st).slider({formatter: function (value) {
                    return 'Current value: ' + value;
                }
            });
            $(st).on("slide", function (slideEvt) {
                $(newname.id + "SliderVal").text(slideEvt.value);
                $("#catparam" + newname.id).val(newname.id + "|" + slideEvt.value);
            })
        },
        error: function (result, status) {
            console.log(result);
            console.log(status);
            strtxt = ' <strong style="color:red">error try again</strong>';
            $(el).parent().append(strtxt);
        }
    });
}
function like(el) {
    eImg = $(el).children("img");
    reset = "";
    if ($(el).attr('data-name') == "Like")
    {
        if ($(el).attr('data-pos') == 1)
        {
            newstatus = 0;
            bgcolor = "white";
            bgimg = "none";
            newsrc = "../img/like_icon.png";
        }
        else
        {
            newstatus = 1;
            bgcolor = "green";
            bgimg = "none";
            newsrc = "../img/like_icon_active.png";
            eOtherlink = $(el).next();
            eOtherimage = $(eOtherlink).children("img");
            reset = "../img/dislike_icon.png";
        }
    }
    else
    {
        if ($(el).attr('data-pos') == -1)
        {
            newstatus = 0;
            bgcolor = "white";
            bgimg = "none";
            newsrc = "../img/dislike_icon.png";
        }
        else
        {
            newstatus = -1;
            bgcolor = "darkred";
            bgimg = "none";
            newsrc = "../img/dislike_icon_active.png";
            eOtherlink = $(el).prev();
            eOtherimage = $(eOtherlink).children("img");
            reset = "../img/like_icon.png";
        }
    }
    $.ajax({
        type: "POST",
        url: "../whiskylike",
        data: 'whiskyid=' + $(el).attr('data-whiskyid') + '&userid=' + $(el).attr('data-userid') + '&likeid=' + $(el).attr('data-id') + '&status=' + newstatus,
        dataType: "html",
        success: function (id) {
            console.log("success");
            $(eImg).attr({src: newsrc});
            $(el).attr("data-pos", newstatus);
            console.log("POSITION=" + $(el).attr('data-pos'));
            $(el).css("background-color", bgcolor);
            $(el).css("background-image", bgimg);
            if (reset != "") {
                $(eOtherimage).attr({src: reset});
                $(eOtherlink).css("background-color", "#FFFFFF");
                $(eOtherlink).attr("data-pos", "");
            }
        },
        error: function (result, status) {
            console.log(result);
            console.log(status);
            strtxt = ' <strong style="color:red">error try again</strong>';
            $(el).parent().append(strtxt);
        }
    });
}
function likecomment(el) {
    eImg = $(el).children("img");
    reset = "";
    if ($(el).attr('data-name') == "Like")
    {
        if ($(el).attr('data-pos') == 1)
        {
            newstatus = 0;
            bgcolor = "white";
            bgimg = "none";
            newsrc = "../img/like_icon.png";
        }
        else
        {
            newstatus = 1;
            bgcolor = "green";
            bgimg = "none";
            newsrc = "../img/like_icon_active.png";
            eOtherlink = $(el).next();
            eOtherimage = $(eOtherlink).children("img");
            reset = "../img/dislike_icon.png";
        }
    }
    else
    {
        if ($(el).attr('data-pos') == -1)
        {
            newstatus = 0;
            bgcolor = "white";
            bgimg = "none";
            newsrc = "../img/dislike_icon.png";
        }
        else
        {
            newstatus = -1;
            bgcolor = "green";
            bgimg = "none";
            newsrc = "../img/dislike_icon_active.png";
            eOtherlink = $(el).prev();
            eOtherimage = $(eOtherlink).children("img");
            reset = "../img/like_icon.png";
        }
    }
    $.ajax({
        type: "POST",
        url: "../commentlike",
        data: 'commentid=' + $(el).attr('data-commentid') + '&userid=' + $(el).attr('data-userid') + '&likeid=' + $(el).attr('data-id') + '&status=' + newstatus,
        dataType: "html",
        success: function (id) {
            console.log("success");
            $(eImg).attr({src: newsrc});
            $(el).attr("data-pos", newstatus);
            console.log("POSITION=" + $(el).attr('data-pos'));
            $(el).css("background-color", bgcolor);
            $(el).css("background-image", bgimg);
            if (reset != "") {
                $(eOtherimage).attr({src: reset});
                $(eOtherlink).css("background-color", "#FFFFFF");
                $(eOtherlink).attr("data-pos", "");
            }
        },
        error: function (result, status) {
            console.log(result);
            console.log(status);
            strtxt = ' <strong style="color:red">error try again</strong>';
            $(el).parent().append(strtxt);
        }
    });
}