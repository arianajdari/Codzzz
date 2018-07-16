$('#mainarea #left').height($('#mainarea #left').height() - 60);
$('#mainarea #right').height($('#mainarea #right').height() - 60);
$('.closed').children().css('display','none');
$('#mainarea .down').css('line-height', $('#mainarea .down').height() + 'px');
$('.textPlace').css('display','none');
$('#middle').css('bottom', $('#mainarea .down').height() );
$('#dialog').css('margin-top',($(document).height() / 2) - 250);
$('#dialog').css('margin-left',($(document).width() / 2) - 300);

$(document.body).on('click', '.closed', function(e) {

    if(e.target !== e.currentTarget) return;
    if(!$(this).hasClass('opened')){
        $(this).children().css('display','block');
        $(this).addClass('opened');    
    } else {
        $(this).children().css('display','none');
        $(this).removeClass('opened');   
    } 
    $('.hidden').css('display','none'); 
});

var randomColorGenerator = function(element) {
    var array = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'];
    var color = '#';

    for(var i = 0; i < 6; i++){
        color += array[Math.floor((Math.random() * 16) + 0)]; 
    }

    $(element).css('background-color', color);
};

randomColorGenerator('.down');

$('#operations').css('display','none');

var editor = CodeMirror.fromTextArea(myTextarea, {
    lineNumbers: true
});


var cm = $('.CodeMirror')[0].CodeMirror;
$(cm.getWrapperElement()).hide();


$(document.body).on('click', '.files', function() {
    


    var fileName = $(this).html();
    var element = $(this);

    if($(element).parent().attr('id') === 'left') { }
    else {
        while (true) {
            res = '';
            res = $($(element).parent().find('.hidden').last()).html();
            
            fileName = res + '/' + fileName;
            element = $(element).parent();  
            if($(element).parent().attr('id') === 'left') break;
        }
    }
 
    

    $.ajax({
        method: 'POST',
        url: 'app/getFile.php',
        dataType: 'json',
        data: {
            file: fileName
        }
    }).done(function(e) {
        $(cm.getWrapperElement()).show();
        editor.getDoc().setValue(e['file']);
        $('#operations').css('display','block');
        $('#path').val(e['fullPath']);
    });
});


$('#operations .save').on('click', function(e) {
    e.preventDefault();

    var Text = editor.getDoc().getValue();
    var Path = $('#path').val();


    $.ajax({
        method: 'POST',
        url: 'app/saveFile.php',
        dataType: 'json',
        data: {
            text: Text,
            path: Path
        }
    }).done(function(e) {});
});

var clickedButton;

$('.openDialog').on('click', function() {

    clickedButton = $(this).attr('id');

    if(clickedButton === 'File' || clickedButton === 'Folder')
        $('#dialog #title').html('Select ' + clickedButton + "<div id='exit'>X<div>");
    else
        $('#dialog #title').html(clickedButton + "<div id='exit'>X<div>");

    $('#dialog').css('display','block');

    if(clickedButton === 'File' || clickedButton === 'Folder'){
        getFolderOrFileList(clickedButton);
    } else {
       getDeleteList(); 
    }
});

$(document.body).on('click','#exit',function() {
    $('#dialog').css('display','none');
});


$(document.body).on('click', '.folder_place', function() {
    name = $('#filename').val();
    action = clickedButton;
    folder = $(this).html();

    console.log(action + ' ' + folder + ' ' + name);

    if (name !== '' || action === 'Delete') {
        $.ajax({
            method: 'POST',
            url: 'app/createFileOrFolder.php',
            dataType: 'json',
            data: {
                fileName: name,
                fileAction: action,
                fileFolder: folder
            }
        }).done(function(e) {
            $('#left').html(e['result']);
            $('.closed').children().css('display','none');
            if(action === 'Delete') {getDeleteList()}
            else {getFolderOrFileList(clickedButton)}
        });
    }
});



function getDeleteList() 
{
    $.ajax({
            method: 'POST',
            url: 'app/findFullPathAndFolders.php',
            dataType: 'json',
            data: { }
        }).done(function(e) {
            $('#dialog #name').css('display','none');
            var files = '';
            for(var i = 0; i< e['fixed_path'].length; i++){
                files += "<li class='folder_place'>" + e['fixed_path'][i] + '</li>';
            }
            $('#files ul').html(files);
        });
};

function getAllFiles()
{
    $.ajax({
        method: 'POST',
        url: 'app/getAllPaths.php',
        dataType: 'json',
        data: { }
    }).done(function(e) {
        $('#dialog').css('display','block');
        $('#dialog #title').html('Select Where To save files' + "<div id='exit'>X</div>");
        $('#dialog #name').css('display','none');
        var files = '';
        for(var i = 0; i< e['fixed_path'].length; i++){
            files += "<li class='upload_place'>" + e['fixed_path'][i] + '</li>';
        }
        $('#files ul').html(files);
    });
};


function getFolderOrFileList(clickedButton)
{
    $.ajax({
        method: 'POST',
        url: 'app/getAllPaths.php',
        dataType: 'json',
        data: {
            buttonType: clickedButton
        }
    }).done(function(e) {
        $('#dialog #name').css('display','block');
        var files = '';
        for(var i = 0; i< e['fixed_path'].length; i++){
            files += "<li class='folder_place'>" + e['fixed_path'][i] + '</li>';
        }
        $('#files ul').html(files);
    });
};


$(document.body).on('dragover', '#dropzone', function(e) {
    $(this).addClass('dragover');
    return false;
});

$(document.body).on('dragenter', '#dropzone', function(e) {
    $(this).addClass('dragover');   
    return false;
});

$(document.body).on('dragleave', '#dropzone', function(e) {
    $(this).removeClass('dragover');
});


var formData;

$(document.body).on('drop','#dropzone', function(e) {
    e.dataTransfer = e.originalEvent.dataTransfer;
    e.preventDefault();

    var files = e.dataTransfer.files;

    formData = new FormData();

    for(var i = 0; i < files.length; i++){
        formData.append('file[]',files[i]);
    }  

    getAllFiles(); 
});


$(document.body).on('click', '.upload_place', function() {

    var xhr = new XMLHttpRequest;

    formData.append('key', $(this).html());
    xhr.open('POST','app/uploadDragAndDrop.php');
    xhr.send(formData);

    xhr.onload = function() {
        var a = JSON.parse(this.responseText);
        $('#left').html(a.result);
        $('.closed').children().css('display','none');
    };
});
