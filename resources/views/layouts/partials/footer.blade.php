<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="https://mobilgroup.az" target="_blank">Mobil Group</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


  <!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src=" {{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src=" {{ asset('js/adminlte.js') }}"></script>
{{-- Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- IntlTelInput -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
{{-- Input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
{{-- bootstrapTable --}}
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

<script>

  $(".select2").select2();

  function deleteConfirmation(id,model) {
      swal.fire({
          title: "Delete?",
          text: "Please ensure and then confirm!",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: !0
      }).then(function (e) {

          if (e.value === true) {
              const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

              $.ajax({
                  type: 'POST',
                  url: `/dashboard/${model}/${id}`,
                  data: {_token: CSRF_TOKEN,_method:'delete'},
                  dataType: 'JSON',
                  success: function (results) {
                      if (results.success === 200) {
                          setTimeout(function(){
                              location.reload();
                          },1000);
                          swal.fire("Done!", "", "success");
                      } else {
                          swal.fire("Error!", "Something went wrong, please try again later", "error");
                      }
                  }
              });

          } else {
              e.dismiss;
          }

      }, function (dismiss) {
          return false;
      })
  }


  $('#company-submit-form').submit(function(e){
      e.preventDefault();
      handleRequest('company-submit-form','companies/','company','Add');
  });

  $('#company-edit-form').submit(function(e){
      e.preventDefault();
      const company_id = $('#company_id').val();
      handleRequest('company-edit-form','companies/'+company_id,'company','Edit');
  });

  $('#employee-submit-form').submit(function(e){
      e.preventDefault();
      handleRequest('employee-submit-form','employees/','employee','Add');
  });

  $('#employee-edit-form').submit(function(e){
      e.preventDefault();
      const employee_id = $('#employee_id').val();
      handleRequest('employee-edit-form','employees/'+employee_id,'employee','Edit');
  });

  function handleRequest(formName,url,errName,btnName){
      const form = $('#'+formName)[0];
      const formData = new FormData(form);
      if(errName === 'employee') formData.append('phone',phoneInput.getNumber());
      $.ajax({
          type: "POST",
          url: '/dashboard/'+url,
          processData: false,
          contentType: false,
          data: formData,
          beforeSend: function(){
              resetErrors(errName + "_err");
              handleButton(1,errName,btnName);
          },
          success: function (res) {
              handleButton(0,errName,btnName);
              if(res.success == 200){
                  setTimeout(function(){
                      location.href = window.location.origin +`/dashboard/${url.slice(0,url.indexOf('/'))}`;
                  },1000);
                  swal.fire("Done!", "", "success");
              }else{
                  $.each(res.errors, function (key, val) {
                      $("#"+ errName + "_" + key + "_err").text(val[0]);
                  });
                  swal.fire("Error!", 'Please fiil up all the fields', "error");
              }
          },
          error: function (e) {
              handleButton(0,errName,btnName);
              swal.fire("Error!", 'Something went wrong, please try again later', "error");
          }
      });
  }

  function resetErrors(name){
      const errors = document.getElementsByClassName(name);
      for (i = 0; i < errors.length; i++) {
          errors[i].innerHTML = "";
      }
  }
  
  function handleButton(type,model,name){
      if(type){
          $('#' + model + '-submit-btn').prop('disabled',true);
          $('#' + model + '-submit-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');
      }else{
          $('#' + model + '-submit-btn').prop('disabled',false);
          $('#' + model + '-submit-btn').html(name);   
      }
  }
</script>

<script>

function getIp(callback) {
    fetch("https://ipinfo.io/json?token=85a16d6fbd959b")
        .then((resp) => resp.json())
        .catch(() => {
            return {
                country: "az",
            };
        })
        .then((resp) => callback(resp.country));
  }

  const phoneInputField = document.getElementById("employee_phone");
  const phoneInput = window.intlTelInput(phoneInputField, {
    initialCountry: "auto",
    separateDialCode: true,
    preferredCountries: ['az','tr','us','ru'],
    geoIpLookup: getIp,
    utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  });

</script>