/**
 * auto load js for this area
 */

if ('undefined' == $.type(AdminController)) {
	var AdminController = {};
}
if (!$.isPlainObject(AdminController)) {
	AdminController = {};
}

AdminController.renderTable = function() {
	$('#dataTable').DataTable({
		'language': {
			"decimal": ",",
			"emptyTable": "Không có dữ liệu",
			"info": "Hiển thị _START_ tới _END_ của _TOTAL_ kết quả",
			"infoEmpty": "Hiển thị 0 tới 0 của 0 kết quả",
			"infoFiltered": "(lọc từ _MAX_ tổng số kết quả)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Hiển thị _MENU_ kết quả",
			"loadingRecords": "Đang tải...",
			"processing": "Đang thực hiện...",
			"search": "Tìm kiếm:",
			"zeroRecords": "Không tìm thấy kết quả nào",
			"paginate": {
				"first": "Đầu tiên",
				"last": "Cuối",
				"next": "Tiếp",
				"previous": "Quay Lại"
			},
			"aria": {
				"sortAscending": ": kích hoạt để sắp xếp cột tăng dần",
				"sortDescending": ": kích hoạt để sắp xếp cột giảm dần"
			}
		},
		"columnDefs": [{
			"targets": 'no-sort',
			"orderable": false,
		}],
		"aaSorting": []
	});
};

AdminController.renderEditor = function() {
	tinymce.init({
		selector: '#editor',
		height: 300,
		plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code'
		],
		toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		content_css: '//www.tinymce.com/css/codepen.min.css',
		menubar: false
	});
};

AdminController.uploadFile = function(event, e, id, type) {
	var fileExtension = ['jpeg', 'jpg', 'JPEG', 'png', 'gif', 'bmp'];
	if ($.inArray($(e).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		alert("jpg,jpeg,JPEG,png,gif only");
		$(e).val('');
	} else {
		var container = $(e).closest('div'),
			file = event.target.files[0];

		if ('undefined' != typeof file) {

			var form_data = new FormData();
			form_data.append('file', file);
			form_data.append('id', id);
			form_data.append('content_type', type);

			$.ajax({
				url: '/admin/file/uploadFile.json', // point to server-side PHP script
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					var obj = jQuery.parseJSON(response);

					var output = '<div class="image-view-block">'
						+'<img src="'+baseUrl + 'data/Images/'+obj.image_id+'.'+obj.ext+'" class="view-img">'
						+'<span>Link: '+baseUrl + 'data/Images/'+obj.image_id+'.'+obj.ext+'<span>'
						+'</div>';
					container.prepend(output);

					var hiddenImagesId = $('#image-id');
					hiddenImagesId.prepend('<input type="hidden" name="Images[]" value="'+obj.image_id+'">');
				}
			});
			$(e).val('');
		} else {
			$(e).parents('.item').find('img').first().removeAttr('src');
			$(e).parents('.item').find('.remove-img').addClass('hidden');
		}
	}
};

AdminController.toggleNav = function() {
    if ($('body').hasClass('sidebar-collapse')) {
        $.removeCookie('toggle_nav');
    } else {
        $.cookie('toggle_nav', true, { expires: 7, path: '/' });
    }
};

AdminController.insertParam = function(key, value) {
    key = encodeURI(key);
    value = encodeURI(value);
    var href = location.protocol + '//' + location.host + location.pathname;
    var kvp = document.location.search.substr(1).split('&');

    if ( kvp[0] == '' ) {
        kvp.splice( 0, 1 );
    }

    var i=kvp.length; var x; while(i--) {
        x = kvp[i].split('=');

        if (x[0] == 'page' && value == 1) {
            kvp.splice( i , 1 );
            break;
        }

        if (x[0] == key) {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}
    window.history.pushState("tring", "Title", href + "?" + kvp.join('&'));
};

AdminController.getParams = function (key) {
    var kvp = document.location.search.substr(1).split('&');
    for ( i=0; i < kvp.length; i++) {
        x = kvp[i].split('=');

        if (x[0] == key) {
            return x[1];
        }
    }
    return false;
};

$(function() {
	$('#delete_modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget),
			model = button.data('model'),
			id = button.data('id');
		var modal = $(this);
		modal.find('form').attr('action', baseUrl + 'admin/' + model + '/delete/' + id);
	});
});