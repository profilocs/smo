//console.log(document.getElementById("titleData").childNodes[0].data);
document.getElementById("exampleInputTitle").value = document.getElementById("titleData").childNodes[0].data;
document.getElementById("exampleInputsubTitle").value = document.getElementById("subtitleData").childNodes[0].data;
document.getElementById("exampleInputPageTitle").value = document.title;
function showp (clName) {
	var bs = document.getElementsByClassName(clName);
	var i=0;
	while(bs[i]!=null)
	{
		bs[i].style.display = "inline";
		// $(bs[i]).fadeIn(500, function() { 
  //          $(bs[i]).toggleClass('hidden show');//'nav > ul').removeClass('show');
  //       });
		$(bs[i]).toggleClass('hidden show');//, 1000, "easeOutSine"
		i++;
	}
	//console.log(bs);
}
function hidep (clName) {
	var bs = document.getElementsByClassName(clName);
	var i=0;
	while(bs[i]!=null)
	{
		bs[i].style.display = "none";
		$(bs[i]).toggleClass('hidden show', 1000, "easeOutSine");
		i++;
	}
	//console.log(bs);
}
$(document).on("click", ".btn-para", function () {
	//console.log($(this).parent().nth-child(3).text());
	//console.log(this.parentNode.parentNode);
	//console.log($(this).parent().parent().children());
     var cont = this.parentNode.parentNode.childNodes[1].data;// $(this).data('id');
     $(".modal-body #data-seq").val( $(this).data('seq') );
     $(".modal-body #exampleInputContent1").val( cont );
     $(".modal-body #exampleInputTitle1").val( $(this).parent().parent().prev().text() );
     $(".modal-body #delInputContent1").text( cont );
     $(".modal-body #delInputTitle1").text( $(this).parent().parent().prev().text() );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
$(document).on("click", ".btn-table", function () {
	//console.log($(this).parent().nth-child(3).text());
	console.log(this.parentNode.parentNode.parentNode.childNodes[1].innerHTML);
	console.log(this.parentNode.parentNode.childNodes[1].getElementsByClassName("badge")[0].innerHTML);
     var descr = this.parentNode.parentNode.parentNode.childNodes[1].innerHTML;// $(this).data('id');
     $(".modal-body #data-fseq").val( $(this).data('seq') );
     $(".modal-body #exampleInputDescr1").val( descr );
     $(".modal-body #exampleInputCount1").val( this.parentNode.parentNode.childNodes[1].getElementsByClassName("badge")[0].innerHTML );
     $(".modal-body #delInputDescr1").text( descr );
     $(".modal-body #delInputCount1").text( $(this).parent().parent().prev().text() );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});