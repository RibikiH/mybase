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
}

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
		menubar: false,
	});
}

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
}

$(function() {
	$('#delete_modal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var href = button.data('href');

		var modal = $(this);
		modal.find('.btn-primary').attr('onclick', 'window.location.replace("'+href+'")');
	});
})