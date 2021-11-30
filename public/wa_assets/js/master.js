// save country
function saveCountry(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#countryForm")[0]);
    $.ajax({
        type: "post",
        url: "save-country",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            //console.log(response);
            if(response.status === 400)
            {
                $('#country_err').html('');
                $('#country_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#country_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#country_err').html('');
                $('#countryModal').modal('hide');
                window.location.reload();

            }
        }
    });
}

// edit country
function editCountry(country_id){
    $.ajax({
        type: "get",
        url: "edit-country/"+country_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                $('#countryModal').modal('show');
                $('#country_err').html('');
                $('#country_err').removeClass('alert alert-danger');
                $("#countryForm").trigger( "reset" ); 
                $('#saveCountryBtn').addClass('hide');
                $('#updateCountryBtn').removeClass('hide');
                $('#country_name').val(response.country.country_name);
                //$('#country_id').val(response.country.id);
                $('#updateCountryBtn').val(response.country.id);
            }
        }
    });
}

function updateCountry(country_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#countryForm")[0]);
    $.ajax({
        type: "post",
        url: "update-country/"+country_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            //console.log(response);
            if(response.status === 400)
            {
                $('#country_err').html('');
                $('#country_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#country_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#country_err').html('');
                $('#countryModal').modal('hide');
                window.location.reload();
            }
        }
    });
}

function deleteCountry(country_id){
    $.ajax({
        type: "get",
        url: "delete-country/"+country_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}

/////////////////////// Manage State /////////////////////////////

function saveState(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#stateForm")[0]);
    $.ajax({
        type: "post",
        url: "save-state",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status === 400)
            {
                $('#state_err').html('');
                $('#state_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#state_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#state_err').html('');
                $('#stateModal').modal('hide');
                window.location.reload();

            }
        }
    });
}
function editState(state_id){
    $.ajax({
        type: "get",
        url: "edit-state/"+state_id,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if(response.status == 200){
                $('#stateModal').modal('show');
                $('#state_err').html('');
                $('#state_err').removeClass('alert alert-danger');
                $("#stateForm").trigger( "reset" ); 
                $('#saveStateBtn').addClass('hide');
                $('#updateStateBtn').removeClass('hide');
                $('#country_id').val(response.state.country_id);
                $('#state_name').val(response.state.state_name);
                $('#updateStateBtn').val(response.state.id);
            }
        }
    });
}

function updateState(state_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#stateForm")[0]);
    $.ajax({
        type: "post",
        url: "update-state/"+state_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status === 400)
            {
                $('#state_err').html('');
                $('#state_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#state_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#state_err').html('');
                $('#stateModal').modal('hide');
                window.location.reload();
            }
        }
    });
}
function deleteState(state_id){
    $.ajax({
        type: "get",
        url: "delete-state/"+state_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}

function getState(country_id){
    $.ajax({
        type: "get",
        url: "get-state/"+country_id,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if(response.status == 200){
                $('#state_id').html(response.html);
            }
        }
    });
}

/////////////// Manage City ////////////////

function saveCity(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#cityForm")[0]);
    $.ajax({
        type: "post",
        url: "save-city",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status === 400)
            {
                $('#city_err').html('');
                $('#city_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#city_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#city_err').html('');
                $('#cityModal').modal('hide');
                window.location.reload();
            }
        }
    });
}

function editCity(city_id){
    $.ajax({
        type: "get",
        url: "edit-city/"+city_id,
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if(response.status == 200){
                $('#cityModal').modal('show');
                $('#city_err').html('');
                $('#city_err').removeClass('alert alert-danger');
                $("#cityForm").trigger( "reset" ); 
                $('#saveCityBtn').addClass('hide');
                $('#updateCityBtn').removeClass('hide');
                $('#country_id').val(response.cities.country_id);
                $('#state_id').html(response.html);
                $('#city_name').val(response.cities.city_name);
                $('#updateCityBtn').val(response.cities.id);
            }
        }
    });
}
function updateCity(city_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData = new FormData($("#cityForm")[0]);
    $.ajax({
        type: "post",
        url: "update-city/"+city_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status === 400)
            {
                $('#city_err').html('');
                $('#city_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#city_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#city_err').html('');
                $('#cityModal').modal('hide');
                window.location.reload();
            }
        }
    });
}
function deleteCity(city_id){
    $.ajax({
        type: "get",
        url: "delete-city/"+city_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}

