$(document).ready(function() {
    $(".list-input-hidden-upload").on('click', '.wrap-btn-delete', function(){ 
        let id = $(this).data('id');
        $(this).parents('.box-image').prev().remove();
        $(this).parents('.box-image').remove();
    });

    $(".list-images").on('click', '.wrap-btn-delete', function(){ 
        let id = $(this).data('id');
        $(this).parents('.box-image').remove();
    });

    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image"></div>');
        box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
        box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
        $(".list-input-hidden-upload").append(box_image);

        $(this).removeAttr('id');
        $(this).attr( 'id', time);

        if( $('.list-input-hidden-upload').hasClass('product-image') ) {
            var input_type_file = '<input type="file" name="pro_avatar[]" id="file_upload" accept="image/*" class="myfrm form-control hidden">';
        } else {
            var input_type_file = '<input type="file" name="avatar[]" id="file_upload" accept="image/*" class="myfrm form-control hidden">';
        }

        $('.list-input-hidden-upload').append(input_type_file);
    });

    $('button.remove').on('click', function () { 
        var _this = $(this);
        let data_id = _this.parents('tr').attr('data-id');
        $('#modal-confirm-delete').addClass('show');
        $('#modal-confirm-delete .btn-delete').attr('data-id', data_id);

    });

    $('#modal-confirm-delete .btn-cancel, #modal-confirm-delete .btn-close-modal').on('click', function () {
        $('#modal-confirm-delete').removeClass('show');
    });

    $('#modal-confirm-delete .btn-delete').on('click', function () {
        let data_id = $(this).attr('data-id');
        $('table tr').each( function (index) { 
            if ( data_id == $(this).attr('data-id') ) {
                $(this).find('form .btn-submit').trigger('click');
            }
        });
    });

    $("#overlay").on("click",function(e){
        e.preventDefault();
        $(".menu-mobi").removeClass("active");
        $('#overlay').fadeOut();
    });

    $('body').on('click', '.menu-mobi .btn-close', function(event) {
		event.preventDefault();
		$('#overlay').fadeOut();
		$('.menu-mobi').removeClass('active');
	});

    $('header nav.nav-menu').on('click', function () {
        $('.menu-mobi').addClass('active');
        $('#overlay').fadeIn();
    });



});