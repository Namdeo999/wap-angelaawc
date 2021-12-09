function saveAdmin(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#adminForm")[0]);
    $.ajax({
        type: "POST",
        url: "save-admin",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#admin_err').html('');
                $('#admin_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#admin_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#admin_err').html('');
                $('#adminModal').modal('hide');
                window.location.reload();
            }
        }
        // error: function (xhr) {
        //     console.log(xhr.responseText);
        // }
    });
}

function editAdmin(admin_id){
    $.ajax({
        type: "get",
        url: "edit-admin/"+admin_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                $('#adminModal').modal('show');
                $('#admin_err').html('');
                $('#admin_err').removeClass('alert alert-danger');
                $("#adminForm").trigger( "reset" ); 
                $('#saveAdminBtn').addClass('hide');
                $('#updateAdminBtn').removeClass('hide');
                $('#admin_role').val(response.admin.admin_role);
                $('#name').val(response.admin.name);
                $('#email').val(response.admin.email);
                $('#updateAdminBtn').val(response.admin.id);
            }
        }
    });
}

function updateAdmin(admin_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#adminForm")[0]);
    $.ajax({
        type: "POST",
        url: "update-admin/"+admin_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#admin_err').html('');
                $('#admin_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#admin_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#admin_err').html('');
                $('#adminModal').modal('hide');
                window.location.reload();
            }
        }
        // error: function (xhr) {
        //     console.log(xhr.responseText);
        // }
    });
}

function deleteAdmin(admin_id) {
    $.ajax({
        type: "get",
        url: "delete-admin/"+admin_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}

//user operations
function saveUser(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#userForm")[0]);
    $.ajax({
        type: "POST",
        url: "save-user",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#user_err').html('');
                $('#user_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#user_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#user_err').html('');
                $('#userModal').modal('hide');
                window.location.reload();
            }
        }
        // error: function (xhr) {
        //     console.log(xhr.responseText);
        // }
    });
}

function editUser(user_id){
    $.ajax({
        type: "get",
        url: "edit-user/"+user_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                $('#userModal').modal('show');
                $('#user_err').html('');
                $('#user_err').removeClass('alert alert-danger');
                $("#userForm").trigger( "reset" ); 
                $('#saveUserBtn').addClass('hide');
                $('#updateUserBtn').removeClass('hide');
                $('#user_name').val(response.user.user_name);
                $('#email').val(response.user.email);
                $('#mobile').val(response.user.mobile);
                $('#updateUserBtn').val(response.user.id);
            }
        }
    });
}

function updateUser(user_id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#userForm")[0]);
    $.ajax({
        type: "POST",
        url: "update-user/"+user_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#user_err').html('');
                $('#user_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#user_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#user_err').html('');
                $('#userModal').modal('hide');
                window.location.reload();
            }
        }
        // error: function (xhr) {
        //     console.log(xhr.responseText);
        // }
    });
}

function deleteUser(user_id) {
    $.ajax({
        type: "get",
        url: "delete-user/"+user_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}

//template operations

function saveTemplate(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#templateForm")[0]);
    $.ajax({
        type: "POST",
        url: "save-template",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#template_err').html('');
                $('#template_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#template_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#template_err').html('');
                $('#templateModal').modal('hide');
                window.location.reload();
            }
        }
    });
}

function editTemplate(template_id){
    $.ajax({
        type: "get",
        url: "edit-template/"+template_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                $('#templateModal').modal('show');
                $('#template_err').html('');
                $('#template_err').removeClass('alert alert-danger');
                $("#templateForm").trigger( "reset" ); 
                $('#saveTemplateBtn').addClass('hide');
                $('#updateTemplateBtn').removeClass('hide');
                $('#template_name').val(response.template.template_name);
                $('#template_content').val(response.template.template_content);
                $('#updateTemplateBtn').val(response.template.id);
            }
        }
    });
}

function updateTemplate(template_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var formData = new FormData($("#templateForm")[0]);
    $.ajax({
        type: "POST",
        url: "update-template/"+template_id,
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false, 
        processData: false, 
        success: function (response) {
            if(response.status == 400)
            {
                $('#template_err').html('');
                $('#template_err').addClass('alert alert-danger');
                var count = 1;
                $.each(response.errors, function (key, err_value) { 
                    $('#template_err').append('<span>' + count++ +'. '+ err_value+'</span></br>');
                });

            }else{
                $('#template_err').html('');
                $('#templateModal').modal('hide');
                window.location.reload();
            }
        }
    });
}

function deleteTemplate(template_id) {
    $.ajax({
        type: "get",
        url: "delete-template/"+template_id,
        dataType: "json",
        success: function (response) {
            if(response.status == 200){
                window.location.reload();
            }
        }
    });
}