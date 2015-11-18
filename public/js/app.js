$(document).ready(function()
{
	$("#form_submit").click(function()
	{
		$("#target_form").submit();
	});

	$(".delete_group").click(function(event)
	{
		$("#btn_delete_group").prop('href', '../public/forum/group/' + event.target.id + '/delete');
	});

	$(".delete_category").click(function(event)
	{
		$("#btn_delete_category").prop('href', '../public/forum/category/' + event.target.id + '/delete');
	});

	$("#category_submit").click(function()
	{
		$("#category_form").submit();
	});

	$(".new_category").click(function(event)
	{
		var id = event.target.id;
		var pieces = id.split("-");

		$("#category_form").prop('action', '../public/forum/category/' + pieces[2] + '/new');
	});
});