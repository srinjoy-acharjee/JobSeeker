$(document).ready(function() {
	"use strict";

	var site_url  = $('#site_url').val();
	var admin_url = $('#admin_url').val();

	$('.list-group-item').on('click',function(e){
     	  var previous = $(this).closest(".list-group").children(".active");
     	  previous.removeClass('active');
     	  $(e.target).addClass('active');
   	});

	$('.ApplyJob').on('click', function(e) {
		e.preventDefault();

		$('#JobDescription').html('');
		LoaderShow('.loader');
		var UniqueID   = $(this).data('uniqid');
		var dataString = { UniqueID: UniqueID };
		$.ajax({
			type 	 : 'POST',
			dataType : "json",
			url  	 : site_url + 'ajax/GetJob.php',			        	
			data 	 : dataString,
			success: function(response) {
				if( response.msg == 1 ) {
					$('#JobMessage').addClass('text-success');
					$('#JobMessage').html('You have already applied for this Job!');
					$('#SubmitJob').attr('disabled', 'disabled');
				}
				$('#JobDescription').html(response.html);
				$('#jobID').val(response.jobID);
				LoaderHide('.loader');
			}
		});
	});
	// End of the script

	$('#SubmitJob').on('click', function(e) {
		e.preventDefault();

		$(this).attr('disabled', 'disabled');
		var UniqueID   = $('#jobID').val();
		var dataString = { UniqueID: UniqueID };
		$.ajax({
			type 	 : 'POST',
			dataType : "json",
			url  	 : site_url + 'ajax/SubmitJob.php',			        	
			data 	 : dataString,
			success: function(response) {
				if( response.msg == 1 ) {
					$('#JobMessage').addClass('text-success');
					$('#JobMessage').html('Congratulation! Job Successfully applied!');
					setTimeout(function() {
						$('#ApplyJob').modal('hide');
					}, 2000);
				} else {
					$('#JobMessage').addClass('text-danger');
					$('#SubmitJob').removeAttr('disabled');
					$('#JobMessage').html('Oops! Unable to apply for the Job.');
				}				
			}
		});
	});
	// End of the script

	$('#sendmail').on('click', function(e) {
		e.preventDefault();

		$('#sendmail').attr('disabled', 'disabled');
		LoaderShow('.loader');
		var to 		   = $('#to').val();
		var toname 	   = $('#toname').val();
		var from 	   = $('#from').val();
		var fromname   = $('#fromname').val();
		var subject    = $('#subject').val();
		var message    = $('#message').val();
		var dataString = { to: to, toname: toname, from: from, fromname: fromname, subject: subject, message: message };
		$.ajax({
			type 	 : 'POST',
			dataType : "json",
			url  	 : site_url + 'ajax/SendMail.php',			        	
			data 	 : dataString,
			success: function(response) {
				LoaderHide('.loader');
				if( response.msg == 0 ) {
					$('#SendMessage').addClass('text-success');
					$('#SendMessage').html(response.text);
					setTimeout(function() {
						$('#sendmailModal').modal('hide');
					}, 2000);
				} else {
					$('#SendMessage').addClass('text-danger');
					$('#sendmail').removeAttr('disabled');
					$('#SendMessage').html(response.text);
				}				
			}
		});
	});
	// End of the script
});

$('#ApplyJob').on('shown.bs.modal', function() {
	$('#JobMessage').removeClass('text-danger').removeClass('text-success');	
	$('#JobMessage').html('');
	$('#SubmitJob').removeAttr('disabled');
});
// End of the script

$('#ApplyJob').on('hidden.bs.modal', function() {
	$('#JobMessage').removeClass('text-danger').removeClass('text-success');	
	$('#JobMessage').html('');
	$('#SubmitJob').removeAttr('disabled');
});
// End of the script

$('#sendmailModal').on('shown.bs.modal', function() {
	$('#SendMessage').removeClass('text-danger').removeClass('text-success');	
	$('#SendMessage').html('');
	$('#sendmail').removeAttr('disabled');
});
// End of the script

$('#sendmailModal').on('hidden.bs.modal', function() {
	$('#SendMessage').removeClass('text-danger').removeClass('text-success');	
	$('#SendMessage').html('');
	$('#sendmail').removeAttr('disabled');
});
// End of the script

function LoaderShow(element, delay = 0) {
	if ( delay == 0 ) {
		$(element).show().removeClass('hide');
	} else {
		setTimeout(function() {
			$(element).show().removeClass('hide');
		}, delay);
	}
}
// End of the script

function LoaderHide(element, delay = 0) {
	if ( delay == 0 ) {
		$(element).hide().addClass('hide');
	} else {
		setTimeout(function() {
			$(element).hide().addClass('hide');
		}, delay);
	}
}
// End of the script