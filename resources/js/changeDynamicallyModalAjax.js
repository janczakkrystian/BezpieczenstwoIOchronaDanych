$(document).ready(function() {
	$(".socialIcons li").on('click', function(e)
	{
		e.preventDefault();
		var path = $(this).attr('data-path');
		var name = $(this).attr('class');
		$.ajax({
			type     : "POST",
			url      : path + name,
			dataType: "json",
			//pomyślne wysłanie danych do skryptu
			success : function(response) {
				$('.modal').find('.tableBody').empty();
                $('.modal').find('.modal-title').empty();
                $('.modal').find('.modal-title').append(response[0].Name);
                var url = window.location.hostname +  window.location.pathname;
				$.each(response, function(i, item) {
					$('.modal').find('.tableBody').append(
						'<tr>' +
							'<td>'+item.Login+'</td>' +
							'<td>'+item.Password+'</td>' +
                        	'<td><a type="button" class="btn btn-info" href="http://'+ url +'?controller=Accounts&action=editform&id='+item.IdAccount+'">Edytuj</a></td>' +
                        '<td><a type="button" class="btn btn-danger" href="http://'+ url +'?controller=Accounts&action=delete&id='+item.IdAccount+'">Usuń</a></td>' +
						'</tr>');
				});
				$('.modal').modal('show'); 
				return true;
			},
			error : function(r) {
				console.log(r);
			}
		});
		return false;
	});
});