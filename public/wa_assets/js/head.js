$(document).ready(function () {

    $("#search").on('keyup', function(){
        searchIform();
    }); 
    $("#enable_mode").on('change', function(){
        const val = this.checked ? this.value : '';
        enableMode(val);
    }); 
    
    
   
});

function enableMode(val){
    if(val > 0){
        $("body").addClass("dark-mode");
    }else{
        $("body").removeClass("dark-mode");
    }
}

function searchIform() {
    //var value = $(this).val().toLowerCase();
    var value = $('#search').val().toLowerCase();
    $(".iform_row_filter ").each(function () {
        if ($(this).text().toLowerCase().search(value) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

